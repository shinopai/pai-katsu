import { Controller } from "@hotwired/stimulus";

// Connects to data-controller="header"
export default class extends Controller {
    operateMenu() {
        document.querySelector(".header__dropdown").classList.toggle("active");
    }
}
