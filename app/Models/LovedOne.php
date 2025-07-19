<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LovedOne extends Model
{

    protected $fillable = [
        'user_id',
        'photo',
        'first_name',
        'middle_name',
        'last_name',
        'description',
        'date_of_birth',
        'url',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function memories()
    {
        return $this->hasMany(Memory::class);
    }
}
