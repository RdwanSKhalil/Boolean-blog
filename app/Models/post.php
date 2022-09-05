<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class post extends Model
{
    use HasFactory;

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function comments(){
        return $this->hasMany(comment::class);
    }

    public function replies(){
        return $this->hasMany(reply::class);
    }

    public function recentComments(){
        return $this->hasMany(comment::class)->orderBy('created_at', 'desc');
    }

    protected $dates = [
        'created_at',
        'updated_at'
    ];
}
