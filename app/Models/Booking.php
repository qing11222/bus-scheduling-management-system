<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $table = 'bookings';
    protected $primaryKey = 'BookingID';
    public $timestamps = true;

    protected $fillable = ['UserID', 'ExternalBusID', 'SeatNumber', 'BookingDate', 'departure_date'];

    public function user()
    {
        return $this->belongsTo(User::class, 'UserID', 'id');
    }
    


}
