<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class search extends Model
{
    protected $table = 'search';
    
    protected $fillable = [
        'id',
        'search_text'
    ];
}
