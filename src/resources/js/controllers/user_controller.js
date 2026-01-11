import { Controller } from "@hotwired/stimulus";

// Connects to data-controller="user"
export default class extends Controller {
    static targets = ["postData", "likeData"];

    toggleTag(event) {
        const clickedTab = event.currentTarget;
        const tabs = clickedTab.parentElement.children;

        // タブのアクティブ状態を切り替え
        Array.from(tabs).forEach((tab) => {
            tab.classList.remove("active");
        });
        clickedTab.classList.add("active");

        // 投稿データといいねデータの表示・非表示を切り替え
        if (clickedTab.textContent === "投稿") {
            this.postDataTarget.classList.add("active");
            this.likeDataTarget.classList.remove("active");
        } else {
            this.postDataTarget.classList.remove("active");
            this.likeDataTarget.classList.add("active");
        }
    }
}
