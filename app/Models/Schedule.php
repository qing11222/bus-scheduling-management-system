<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;
    protected $table = 'schedules';
    protected $primaryKey = 'ScheduleID';
    protected $fillable = [
        'date', 'Time', 'BusID','SemesterID','RouteID',
    ];

    public function bus()
    {
        return $this->belongsTo(Bus::class, 'BusID');
    }

    public function routes()
    {
        return $this->belongsTo(Route::class, 'RouteID');
    }

    public function stops()
    {
        return $this->belongsToMany(Stop::class, 'stop_schedule', 'ScheduleID', 'StopID');
    }
    public function semester()
    {
        return $this->belongsTo(Semester::class, 'SemesterID');
    }


}
