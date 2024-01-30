    document.addEventListener('DOMContentLoaded', function() {
        let menuOpen = false;

    document.getElementById('button').addEventListener('click', function () {
        menuOpen = !menuOpen;
        updateMenuState();
    });

    document.getElementById('xmark').addEventListener('click', function() {
        menuOpen = !menuOpen;
        updateMenuState();
    });

    function updateMenuState() {
        const bars = document.getElementById('bars');
        const xmark = document.getElementById('xmark');
        const menu = document.getElementById('menu');

        bars.classList.toggle('hidden', menuOpen);
        xmark.classList.toggle('hidden', !menuOpen);
        menu.classList.toggle('translate-x-full', !menuOpen);
    }
});