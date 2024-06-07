<?php

namespace Models;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model {
    protected $table = 'ratings';
    
    public function user() {
        return $this->belongsTo(User::class);
    }

    public function place() {
        return $this->belongsTo(Place::class);
    }
}
