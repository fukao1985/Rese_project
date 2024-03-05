<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Reservation;
use App\Models\Favorite;
use App\Models\Area;
use App\Models\Genre;
use App\Models\Review;
use App\Models\Representative;

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

    // reviewsテーブルとのリレーション
    public function reviews() {
        return $this->hasMany(Review::class);
    }

    // representativesテーブルとのリレーション
    public function representative() {
        return $this->hasOne(Representative::class);
    }
}
