<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{

    protected $fillable = [

        'role_name',
        'skills',
        'avg_salary_idr',
        'vacancy_count',
        'experience_required',
        'source'
    ];

}
