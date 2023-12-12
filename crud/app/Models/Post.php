<?php

namespace App\Models;

use App\Casts\StatusPost;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description','status'];

    protected $casts = [
        'status' => StatusPost::class
    ];
}
