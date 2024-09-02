<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Checkin;

class Driver extends Model
{
    use HasFactory;
    protected $primaryKey = 'DriverID';
    protected $fillable = [
        'name',
        'email',
        'license_number',
        'phone',
    ];

    public function checkins()
    {
        return $this->hasMany(Checkin::class, 'DriverID');
    }
    

}
