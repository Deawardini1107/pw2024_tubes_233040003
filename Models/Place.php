<?php
namespace Models;

use Illuminate\Database\Eloquent\Model;

class Place extends Model {
    protected $table = 'places';
    
    protected $fillable = [
        'name',
        'description',
        'city',
        'photos',
        'admin_id',
        'category_id',
    ];
    
    public function comments() {
        return $this->hasMany(Comment::class);
    }

    public function ratings() {
        return $this->hasMany(Rating::class);
    }

    public function category() {
        return $this->belongsTo(Category::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
    

    
}
