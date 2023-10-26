<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

//GithubProject
class GithubProject extends Model
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
