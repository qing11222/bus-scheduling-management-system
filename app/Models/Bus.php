<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bus extends Model
{
    use HasFactory;
  // Define the table name if not using default plural form
    protected $table = 'buses';
    protected $primaryKey = 'BusID';

  // Specify the fillable fields
    protected $fillable = ['NumberPlate', 'Capacity', 'DriverID'];


    public function schedules()
    {
        return $this->hasMany(Schedule::class, 'BusID');
    }
    public function driver()
    {
        return $this->belongsTo(Driver::class,'DriverID');
    }
    public function bookings()
    {
        return $this->hasMany(Booking::class, 'BusID');
    }

    public function seats()
    {
        return $this->hasMany(Seat::class, 'BusID');
    }

}
