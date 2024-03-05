<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\SystemManager;

class SystemNotification extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'system_manager_id',
        'date',
        'title',
        'message',
        'recipient_email'
    ];

    // system_managersテーブルとのリレーション
    public function systemManager() {
        return $this->belongsTo(SystemManager::class);
    }
}
