<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CsvUploadRequest;
use App\Models\Shop;
use App\Models\Area;
use App\Models\Genre;

class CsvController extends Controller
{
    // 店舗情報作成(CSVファイルアップロード)ページ表示
    public function csvFile() {
        return view('system_manager.csv_upload');
    }

    // 店舗情報作成(CSVファイルアップロード)
    public function csvUpload(CsvUploadRequest $request) {

        $csvFile = $request->file('csv_file');
        $data = file_get_contents($csvFile->getRealPath());

        $rows = explode("\n", $data);

        // CSVファイルの内容をデータベースに保存
        foreach ($rows as $row) {
            // 空行があった場合はスキップする
            if (empty(trim($row))) {
                continue;
            }

            $values = str_getcsv($row);
            $shopName = $values[0];
            $areaName = $values[1];
            $genreName = $values[2];
            $shopDescription = $values[3];
            $shopImageUrl = $values[4];

            // 各項目をバリデーション
            if (strlen($shopName) > 50) {
                $errors[] = '店舗名は50文字以内で入力してください。';
            }

            if (!in_array($areaName, ['東京都', '大阪府', '福岡県'])) {
                $errors[] = '地域は「東京都」「大阪府」「福岡県」のいずれかを入力してください。';
            }

            if (!in_array($genreName, ['寿司', '焼肉', 'イタリアン', '居酒屋', 'ラーメン'])) {
                $errors[] = 'ジャンルは「寿司」「焼肉」「イタリアン」「居酒屋」「ラーメン」のいずれかを入力してください。';
            }

            if (strlen($shopDescription) > 400) {
                $errors[] = '店舗名は400文字以内で入力してください。';
            }

            $extension = pathinfo($shopImageUrl, PATHINFO_EXTENSION);
            if (!in_array(strtolower($extension), ['jpeg', 'jpg', 'png'])) {
                $errors[] = '画像URLはjpegまたはpngの拡張子である必要があります。';
            }

            if (!empty($errors)) {
            return redirect()->back()->withErrors($errors)->withInput();
            }

            $area = Area::where('area', $areaName)->first();
            $genre = Genre::where('genre', $genreName)->first();

            if (!$area || $genre) {
                $errors[] = '地域またはジャンルが見つかりませんでした。';
                return redirect()->back()->withErrors($errors)->withInput();
            }

            $shop = Shop::create([
                'area_id' => $areaId,
                'genre_id' => $genreId,
                'name' => $shopName,
                'comment' => $shopDescription,
                'url' => $shopImageUrl,
            ]);
        }

        $script = "<script>alert('店舗情報が作成されました');</script>";

        return redirect()->back()->with('script', $script);
    }
}
