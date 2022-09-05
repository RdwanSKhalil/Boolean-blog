<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class reply extends Model
{
    use HasFactory;

    public function user(){

        return $this->belongsTo(User::class);
    }

    public function post(){
        return $this->belongsTo(post::class);
    }

    public function comment(){
        return $this->belongsTo(comment::class);
    }

    public function reply(){
        return $this->belongsTo(reply::class);
    }

    public function replies(){
        return $this->hasMany(reply::class);
    }
}
