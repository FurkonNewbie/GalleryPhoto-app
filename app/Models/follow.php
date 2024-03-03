<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class follow extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'follow_id'
    ];

    protected $table = 'follow';

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function follower()
    {
        return $this->belongsTo(User::class, 'follow_id', 'id');
    }
}
