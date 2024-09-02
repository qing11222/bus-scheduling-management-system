<?php

// app/Models/GpsData.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GpsData extends Model
{
    protected $fillable = ['UserID', 'latitude', 'longitude', 'timestamp'];

}
