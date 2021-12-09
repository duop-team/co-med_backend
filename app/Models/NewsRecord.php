<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsRecord extends Model
{
    protected $fillable = ['title', 'longtitle', 'text', 'user_id'];

    use HasFactory;
}
