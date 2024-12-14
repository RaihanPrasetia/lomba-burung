<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Class_Criteria extends Model
{
    protected $table = 'class_criterias';
    protected $fillable = [
        'class_id',
        'criteria_id',
    ];

    public function classes()
    {
        return $this->belongsTo(Classes::class);
    }

    public function criteria()
    {
        return $this->belongsTo(Criteria::class);
    }
}
