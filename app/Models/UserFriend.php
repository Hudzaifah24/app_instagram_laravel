<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserFriend extends Model
{
    use HasFactory;

    protected $table = 'user_friends';

    protected $fillable = [
        'friend_id',
        'user_id',
        'status',
    ];
}
