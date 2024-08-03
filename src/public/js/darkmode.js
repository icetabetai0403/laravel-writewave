document.addEventListener("DOMContentLoaded", function () {
    const darkModeToggle = document.getElementById("darkModeToggle");
    const body = document.body;

    // ローカルストレージからダークモード設定を取得
    const isDarkMode = localStorage.getItem("darkMode") === "true";

    // 初期状態の設定
    if (isDarkMode) {
        body.classList.add("dark-mode");
        darkModeToggle.checked = true;
    }

    // ダークモードの切り替え
    darkModeToggle.addEventListener("change", function () {
        if (this.checked) {
            body.classList.add("dark-mode");
            localStorage.setItem("darkMode", "true");
        } else {
            body.classList.remove("dark-mode");
            localStorage.setItem("darkMode", "false");
        }
    });
});
