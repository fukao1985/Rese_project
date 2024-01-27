<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    use HasFactory;

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

}
