<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExternalBus extends Model
{
    use HasFactory;

    protected $table = 'external_buses';
    protected $primaryKey = 'ExternalBusID';
    public $timestamps = true;

    protected $fillable = [
        'NumberPlate',
        'Capacity',
        'Zone',
    ];

    public function seats()
    {
        return $this->hasMany(Seat::class, 'ExternalBusID', 'ExternalBusID');
    }
    public function departureDate()
    {
        return $this->hasOne(DepartureDate::class, 'ExternalBusID');
    }
}
