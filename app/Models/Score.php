<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    protected $fillable = [
        'class_id',
        'participant_id',
        'judge_id',
        'criteria_id',
        'score',
        'comments'
    ];

    public function participant()
    {
        return $this->belongsTo(Participant::class);
    }
    public function class()
    {
        return $this->belongsTo(Classes::class);
    }
    public function judge()
    {
        return $this->belongsTo(User::class);
    }
    public function criteria()
    {
        return $this->belongsTo(Criteria::class);
    }
}
