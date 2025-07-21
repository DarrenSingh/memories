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

    public function getFullNameAttribute()
    {
        return trim("{$this->first_name} {$this->middle_name} {$this->last_name}");
    }

    public function getAgeAttribute()
    {
        return $this->date_of_birth ? now()->diffInYears($this->date_of_birth) : null;
    }

    public function getPhotoUrlAttribute()
    {
        return $this->photo ? asset('storage/' . $this->photo) : asset('images/default-photo.png');
    }
}
