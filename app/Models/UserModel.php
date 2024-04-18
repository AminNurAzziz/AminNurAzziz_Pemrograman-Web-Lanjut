<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable; // Import Authenticatable base class
use Illuminate\Notifications\Notifiable; // If you need notification features

class UserModel extends Authenticatable // Extend Authenticatable instead of Model
{
    use HasFactory, Notifiable; // Use Notifiable trait if you need notification features

    protected $table = 'm_user';
    public $timestamps = true;
    protected $primaryKey = 'user_id';

    protected $fillable = [
        'level_id',
        'username',
        'nama',
        'password',
        'profile_picture'
    ];

    public function level(): BelongsTo
    {
        return $this->belongsTo(LevelModel::class, 'level_id', 'level_id');
    }
}
