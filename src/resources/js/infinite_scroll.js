export function initInfiniteScroll() {
    const postsContainer = document.getElementById("xTopPosts");
    if (!postsContainer) return;

    let isLoading = false;
    let observer = null;

    const observe = () => {
        const trigger = document.getElementById("xLoadTrigger");
        if (!trigger) return;

        if (observer) observer.disconnect();

        observer = new IntersectionObserver(async (entries) => {
            const entry = entries[0];
            if (!entry.isIntersecting || isLoading) return;

            const currentTrigger = entry.target;
            const cursor = currentTrigger.dataset.nextCursor;

            if (!cursor) {
                observer.disconnect();
                return;
            }

            // ★ 同じ trigger で二度発火させない
            observer.unobserve(currentTrigger);
            isLoading = true;

            try {
                const res = await fetch(
                    `/posts/load?cursor=${encodeURIComponent(cursor)}`
                );
                if (!res.ok) throw new Error("Failed to load posts");

                const html = await res.text();

                currentTrigger.remove();
                postsContainer.insertAdjacentHTML("beforeend", html);
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
