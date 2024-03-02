<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // reservationsテーブルとのリレーション
    public function reservations() {
        return $this->hasMany(Reservation::class);
    }

    // favoritesテーブルとのリレーション
    public function favorites() {
        return $this->hasMany(Favorite::class);
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
