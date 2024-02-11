    document.addEventListener('DOMContentLoaded', function() {
        let menuOpen = false;

    // メニューの開閉
    document.getElementById('button').addEventListener('click', function () {
        menuOpen = !menuOpen;
        updateMenuState();
    });

    document.getElementById('xmark').addEventListener('click', function (event) {
        event.stopPropagation();
        menuOpen = !menuOpen;
        updateMenuState();
    });

    // メニューの状態更新
    function updateMenuState() {
        const bars = document.getElementById('bars');
        const xmark = document.getElementById('xmark');
        const menu = document.getElementById('menu');

        bars.classList.toggle('hidden', menuOpen);
        xmark.classList.toggle('hidden', !menuOpen);
        menu.classList.toggle('translate-x-full', !menuOpen);
    }

    // 検索フォームのEnterキー処理
    document.getElementById("name").addEventListener("keypress", function(e) {
        if (e.key === "Enter") {
            e.preventDefault();
            e.stopPropagation(); // 追加
            console.log("Enter key pressed"); // コンソールにログを出力
            document.getElementById("search_form").submit();
        }
    });
});