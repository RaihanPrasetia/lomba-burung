<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Criteria extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'weight',
        'type',
    ];

    /**
     * Get the classes associated with the competition.
     */
    public function scores()
    {
        return $this->hasMany(Score::class);
    }
    public function class_criterias()
    {
        return $this->hasMany(Class_Criteria::class, 'criteria_id');
    }
    public function classes()
    {
        return $this->belongsToMany(Classes::class, 'class_criterias', 'criteria_id', 'class_id');
    }
}
