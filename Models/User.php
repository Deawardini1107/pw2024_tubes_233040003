<?php

namespace Models;
use Illuminate\Database\Eloquent\Model;

class User extends Model {
    protected $table = 'users';
    
    public function comments() {
        return $this->hasMany(Comment::class);
    }

    public function ratings() {
        return $this->hasMany(Rating::class);
    }

    public function places()
    {
        return $this->hasMany(Place::class, 'id');
    }
}
