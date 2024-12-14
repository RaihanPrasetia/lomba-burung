<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Competition extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'name',
        'pdf_link',
        'status',
        'date',
    ];

    /**
     * Get the classes associated with the competition.
     */
    public function classes()
    {
        return $this->hasMany(Classes::class, 'competition_id');
    }
}
