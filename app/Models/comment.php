<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class comment extends Model
{
    use HasFactory;

    public function user(){
        return $this->belongsTo(User::class, 'commenter_id');
    }

    public function post(){
        return $this->belongsTo(post::class);
    }

    public function replies(){
        return $this->hasMany(reply::class);
    }

}
