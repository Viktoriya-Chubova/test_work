<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class github_project extends Model
{
    protected $table = 'github_project';
    
    protected $fillable = [
        'id',
        'search_id',
        'name',
        'author',
        'stargazers',
        'watchers'
    ];
}
