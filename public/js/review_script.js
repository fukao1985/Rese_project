// 星をクリックして評価点数を決める処理
document.addEventListener('DOMContentLoaded', function () {
    const stars = document.querySelectorAll('.rating-star');

    stars.forEach((star, index) => {
        star.addEventListener('click', function () {
            console.log("Star clicked!"); // デバッグ用
            const value = this.getAttribute('data-value');
            document.getElementById('ranting').value = value;

            stars.forEach((s, i) => {
                if (i <= index) {
                    s.classList.remove('text-gray-300');
                    s.classList.add('text-yellow-500');
                } else {
                    s.classList.remove('text-yellow-500');
                    s.classList.add('text-gray-300');
                }
            });
        });
    });
});

// 文字カウント
const textarea = document.getElementById('comment');
const charCount = document.getElementById('charCount');

updateCharCount();

textarea.addEventListener('input', updateCharCount);

function updateCharCount() {
    const count = textarea.value.length;
    const countText = count + '/400 (最高文字数)';
    charCount.textContent = countText;
}

// 画像を送信フォームに追加する処理
document.addEventListener('DOMContentLoaded', function () {
    const dropArea = document.getElementById('drop_area');
    const fileInput = document.getElementById('review_image');

    // ファインダーを開くための関数
    function openFileSelector() {
        fileInput.click();
    }

    // ファイルが選択された際の処理
    fileInput.addEventListener('change', function () {
        const file = fileInput.files[0];
        if (file && file.type.startsWith('image/')) {
            // 拡張子を確認
            const extension = file.name.split('.').pop().toLowerCase();
            if (extension === 'jpeg' || extension === 'jpg' || extension === 'png') {
                console.log('画像が選択されました:', file);
                alert('画像のアップロードが成功しました。');

                // 選択された画像を表示する
                const reader = new FileReader();
                reader.onload = function (e) {
                    const img = document.getElementById('uploaded_image');
                    img.src = e.target.result;
                    img.classList.remove('hidden');
                }
                reader.readAsDataURL(file);
            } else {
                alert('アップロードできる画像ファイルはJPEGまたはPNG形式のみです。');
            }
        }
    });

    // 選択したファイルをドロップエリアから削除
    dropArea.addEventListener('click', function () {
        const img = document.getElementById('uploaded_image');
        img.src = '';
        img.classList.add('hidden');
        fileInput.value = '';
    });

    // ドラッグアンドドロップ処理
    dropArea.addEventListener('dragover', function (e) {
        e.preventDefault();
        dropArea.classList.add('bg-blue-300');
    });

    dropArea.addEventListener('dragleave', function () {
        dropArea.classList.remove('bg-blue-300');
    });

    dropArea.addEventListener('drop', function (e) {
        e.preventDefault();
        dropArea.classList.remove('bg-blue-300');
        const file = e.dataTransfer.files[0];
        if (file && file.type.startsWith('image/')) {
            // 拡張子を確認
            const extension = file.name.split('.').pop().toLowerCase();
            if (extension === 'jpeg' || extension === 'jpg' || extension === 'png') {
                console.log('画像が選択されました:', file);
                alert('画像のアップロードが成功しました。');

                // 選択された画像を表示する
                const reader = new FileReader();
                reader.onload = function (e) {
                    const img = document.getElementById('uploaded_image');
                    img.src = e.target.result;
                    img.classList.remove('hidden');
                }
                reader.readAsDataURL(file);
            } else {
                alert('アップロードできる画像ファイルはJPEGまたはPNG形式のみです。');
            }
        }
    });

    dropArea.addEventListener('click', openFileSelector);
})