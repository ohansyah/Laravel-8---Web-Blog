<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $attributes = [ 
        'image' => 'https://via.placeholder.com/250x250.png/000000?text=image' 
    ]; 
}
