<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\SystemNotification;

class SystemManager extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
    ];

    // usersテーブルとのリレーション
    public function user() {
        return $this->belongsTo(User::class);
    }

    // system_notificationsテーブルとのリレーション
    public function systemNotifications() {
        return $this->hasMany(SystemNotification::class);
    }
}
