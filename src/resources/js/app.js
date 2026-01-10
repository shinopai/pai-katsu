import "./bootstrap";
import "./libs";

// 無限スクロールの初期化
import { initInfiniteScroll } from "./infinite_scroll";

// DOMContentLoaded イベントで初期化を実行
document.addEventListener("DOMContentLoaded", () => {
    initInfiniteScroll();
});

// バリデーションエラーがある場合にフォームまでスクロール
window.addEventListener("load", () => {
    const commentForm = document.getElementById("xCommentForm");
    if (!commentForm) return;

    const errorMessage = commentForm.querySelector(".auth__error-message");
    if (errorMessage) {
        commentForm.scrollIntoView({ behavior: "smooth" });
    }
});
