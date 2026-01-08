export function initInfiniteScroll() {
    const container = document.getElementById("xTopPosts");
    if (!container) return;

    const loadUrl = container.dataset.loadUrl;
    if (!loadUrl) return;

    let isLoading = false;
    let observer;

    const observe = () => {
        const trigger = container.querySelector(".top__load-trigger");
        if (!trigger) return;

        if (observer) observer.disconnect();

        observer = new IntersectionObserver(async (entries) => {
            const entry = entries[0];
            if (!entry.isIntersecting) return;
            if (isLoading) return;

            const cursor = trigger.dataset.nextCursor;
            if (!cursor) {
                observer.disconnect();
                return;
            }

            isLoading = true;

            try {
                const res = await fetch(
                    `${loadUrl}?cursor=${encodeURIComponent(cursor)}`,
                    {
                        headers: {
                            "X-Requested-With": "XMLHttpRequest",
                        },
                    }
                );

                if (!res.ok) throw new Error("Failed to load");

                const html = await res.text();

                // 古い trigger を先に消す（超重要）
                trigger.remove();

                // 新しい投稿 + 新しい trigger を追加
                container.insertAdjacentHTML("beforeend", html);
            } catch (e) {
                console.error(e);
            } finally {
                isLoading = false;
                observe(); // 新しい trigger を監視
            }
        });

        observer.observe(trigger);
    };

    observe();
}
