<?php
namespace Models;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model {
    protected $table = 'comments';
    
    public function user() {
        return $this->belongsTo(User::class);
    }

    public function place() {
        return $this->belongsTo(Place::class);
    }

    public function photos() {
        return $this->hasMany(Photo::class);
    }
}
