<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Shop;

class Review extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'shop_id',
        'user_name',
        'ranting',
        'comment',
    ];

    // usersテーブルとのリレーション
    public function user() {
        return $this->belongsTo(User::class);
    }

    // shopsテーブルとのリレーション
    public function shop() {
        return $this->belongsTo(Shop::class);
    }

}
