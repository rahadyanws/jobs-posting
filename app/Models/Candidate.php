<?php

namespace App\Models;

use App\Models\Vacancy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    use HasFactory;
    protected $primaryKey = 'candidate_id';
    public $incrementing = false;
    protected $keyType = 'string';
    
    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'candidate_id',
        'name',
        'email',
        'phone',
        'experience',
        'education'
    ];

    public function applies()
    {
        return $this->belongsToMany(Vacancy::class, 'applies', 'candidate_id', 'vacancy_id');
    }
}
