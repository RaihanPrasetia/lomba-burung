<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'bird_name',
        'no_gantang',
        'contact_info',
        'status',
    ];

    public function class_participants()
    {
        return $this->hasMany(Class_Participants::class);
    }

    public function scores()
    {
        return $this->hasMany(Score::class);
    }
}
