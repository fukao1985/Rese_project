document.addEventListener('DOMContentLoaded', function () {
    const dateInput = document.getElementById('date');
    const timeSelect = document.getElementById('time');
    const numberSelect = document.getElementById('number');

    // dateの変更を監視
    dateInput.addEventListener('change', function () {
        const date = dateInput.value;
        document.getElementById('displayDate').textContent = date;
    });

    // timeの変更を監視
    timeSelect.addEventListener('change', function () {
        const time = timeSelect.value;
        document.getElementById('displayTime').textContent = time;
    });

    // numberの変更を監視
    numberSelect.addEventListener('change', function () {
        const number = numberSelect.value;
        document.getElementById('displayNumber').textContent = number;
    });
});
