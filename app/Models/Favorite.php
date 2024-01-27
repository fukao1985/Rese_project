<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    use HasFactory;

    // usersテーブルとのリレーション
    public function user() {
        return $this->belongsTo(User::class);
    }

    // shopsテーブルとのリレーション
    public function shop() {
        return $this->belongsTo(Shop::class);
    }

}
