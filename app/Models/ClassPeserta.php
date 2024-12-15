<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClassPeserta extends Model
{
    protected $fillable = [
        'class_id',
        'participant_id'
    ];

    public function classes()
    {
        return $this->belongsTo(Classes::class);
    }

    public function participant()
    {
        return $this->belongsTo(Participant::class, 'participant_id');
    }
}
