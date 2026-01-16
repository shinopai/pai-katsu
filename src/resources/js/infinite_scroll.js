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
                initLikeButtons(container);
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

// いいねボタン初期化
function initLikeButtons(root = document) {
    root.querySelectorAll(".post-card__like").forEach((btn) => {
        if (btn.dataset.initialized) return;

        btn.dataset.initialized = "true";
        btn.addEventListener("click", handleLike);
    });
}

// いいねボタン処理
function handleLike(event) {
    const button = event.currentTarget;
    const postId = button.dataset.postId;

    fetch(`/posts/${postId}/like`, {
        method: "POST",
        headers: {
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]')
                .content,
            Accept: "application/json",
        },
    })
        .then((res) => res.json())
        .then((data) => {
            button.classList.toggle("is-liked", data.liked);
            button.querySelector(".like-count").textContent = data.like_count;
        })
        .catch((err) => {
            console.error("Like failed", err);
        });
}
