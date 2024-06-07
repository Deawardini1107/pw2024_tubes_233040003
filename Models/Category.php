<?php
namespace Models;
use Illuminate\Database\Eloquent\Model;

class Category extends Model {
    protected $table = 'categories';
    
    public function places()
    {
        return $this->hasMany(Place::class);
    }
}
