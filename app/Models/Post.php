<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
   Protected $fillable = ['title', 'body', 'user_id'];

   function getUser(){
    return  $this->belongsTo(User::class, 'user_id');
   }
}
