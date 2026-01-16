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

// Vue.js アプリケーションのマウント
// import { createApp } from "vue";
// import { defineCustomElement } from "vue";
// import LikeButton from "./components/LikeButton.vue";

// const app = createApp({});

// // 部分Vueとして登録
// app.component("like-button", LikeButton);
// app.mount("#app");

// Vue カスタムエレメントとして登録
import { defineCustomElement } from "vue";
import LikeButton from "./components/LikeButton.vue";

const LikeButtonElement = defineCustomElement(LikeButton, {
    shadowRoot: false,
});

if (!customElements.get("like-button")) {
    customElements.define("like-button", LikeButtonElement);
}
