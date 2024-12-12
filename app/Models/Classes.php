<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'competition_id',
        'judge_id',
    ];

    /**
     * Get the competition that owns the class.
     */
    public function competition()
    {
        return $this->belongsTo(Competition::class);
    }

    /**
     * Get the judge associated with the class.
     */
    public function judge()
    {
        return $this->belongsTo(User::class, 'judge_id');
    }
    /**
     * Get the class_participant associated with the class.
     */
    public function class_participants()
    {
        return $this->hasMany(Class_Participants::class);
    }

    /**
     * Get the score associated with the class.
     */
    public function scores()
    {
        return $this->hasMany(Score::class);
    }
}
