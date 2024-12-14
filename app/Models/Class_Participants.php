<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Class_Participants extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'class_participants';
    protected $fillable = [
        'class_id',
        'participant_id',
        'judge_id'
    ];

    /**
     * Get the competition that owns the class.
     */
    public function classes()
    {
        return $this->belongsTo(Classes::class);
    }

    /**
     * Get the judge associated with the class.
     */
    public function participant()
    {
        return $this->belongsTo(Participant::class, 'participant_id');
    }

    public function judge()
    {
        return $this->belongsTo(User::class, 'judge_id');
    }
}
