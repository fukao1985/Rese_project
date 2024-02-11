<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'area_id',
        'genre_id',
        'comment',
        'url',
    ];

    // reservationsテーブルとのリレーション
    public function reservations() {
        return $this->hasMany(Reservation::class);
    }

    // favoritesテーブルとのリレーション
    public function favorites() {
        return $this->hasMany(Favorite::class);
    }

    // areasテーブルとのリレーション
    public function area() {
        return $this->belongsTo(Area::class);
    }

    // genresテーブルとのリレーション
    public function genre() {
        return $this->belongsTo(Genre::class);
    }

    // 検索機能の定義
    // public function scopeAreaSearch($query, $area_id)
    // {
    //     if (!empty($area_id)) {
    //     $query->where('area_id', $area_id);
    //     }
    // }

    // public function scopeGenreSearch($query, $genre_id)
    // {
    //     if (!empty($genre_id)) {
    //     $query->where('genre_id', $genre_id);
    //     }
    // }

    // public function scopeNameSearch($query, $name)
    // {
    //     if (!empty($name)) {
    //     $query->where('name', 'like', '%' . $name . '%');
    //     }
    // }

}
