<?php

namespace Models;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model {

    protected $table = 'photos';
    
    public function comment() {
        return $this->belongsTo(Comment::class);
    }
}
