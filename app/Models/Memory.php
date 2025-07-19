<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Memory extends Model
{

    protected $fillable = [
        'loved_one_id',
        'photo_upload',
        'content',
        'likes',
        'is_anonymous',
        'submitter_name',
        'submitter_email',
        'submission_date',
    ];

    public function lovedOne()
    {
        return $this->belongsTo(LovedOne::class);
    }
}
