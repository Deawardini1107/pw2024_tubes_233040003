<?php
namespace Models;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model {
    
    protected $fillable = ['place_id', 'user_id', 'start_date', 'end_date', 'status'];

    // Relasi ke Place
    public function place()
    {
        return $this->belongsTo(Place::class);
    }

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
