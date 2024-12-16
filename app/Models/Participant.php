<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    protected $fillable = [
        'name',
        'bird_name',
        'no_gantang',
        'contact_info',
        'status',
    ];

    public function scores()
    {
        return $this->hasMany(Score::class);
    }

    public function class_pesertas()
    {
        return $this->hasMany(ClassPeserta::class, 'participant_id');
    }
}
