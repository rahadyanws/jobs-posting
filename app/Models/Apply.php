<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apply extends Model
{
    use HasFactory;
    protected $primaryKey = 'apply_id';
    public $incrementing = false;
    protected $keyType = 'string';

    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'apply_id',
        'vacancy_id',
        'candidate_id',
        'status',
    ];
}
