<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vacancy extends Model
{
    use HasFactory;
    protected $primaryKey = 'vacancy_id';
    public $incrementing = false;
    protected $keyType = 'string';
    
    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'vacancy_id',
        'title',
        'description',
        'requirement',
        'status',
        'company_name',
    ];

    public function applies()
    {
        return $this->belongsToMany(Candidate::class, 'applies', 'vacancy_id', 'candidate_id');
    }
}
