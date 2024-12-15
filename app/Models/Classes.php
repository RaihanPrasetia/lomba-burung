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
    protected $table = 'classes';

    protected $fillable = [
        'name',
        'competition_id',
    ];

    /**
     * Get the competition that owns the class.
     */
    public function competition()
    {
        return $this->belongsTo(Competition::class);
    }

    /**
     * Get the class_participant associated with the class.
     */
    public function class_participants()
    {
        return $this->hasMany(Class_Participants::class, 'class_id');
    }

    public function class_pesertas()
    {
        return $this->hasMany(ClassPeserta::class, 'class_id');
    }

    /**
     * Get the score associated with the class.
     */
    public function scores()
    {
        return $this->hasMany(Score::class);
    }

    public function class_criterias()
    {
        return $this->hasMany(Class_Criteria::class, 'class_id');
    }

    public function criterias()
    {
        return $this->belongsToMany(Criteria::class, 'class_criterias', 'class_id', 'criteria_id');
    }
}
