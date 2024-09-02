<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stop extends Model
{
    use HasFactory;
    protected $primaryKey = 'StopID';


    protected $fillable = [
        'Name', 'Location','Latitude','Longitude','picture',
    ];

    public function schedule()
    {
        return $this->belongsToMany(Schedule::class, 'stop_schedule', 'StopID', 'ScheduleID');
    }
}
