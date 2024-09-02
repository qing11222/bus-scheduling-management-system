<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Semester extends Model
{
    use HasFactory;
    protected $primaryKey = 'SemesterID'; // Specify the primary key
    protected $fillable = ['Name', 'Start_Date', 'End_Date'];

    public function schedules()
    {
        return $this->hasMany(Schedule::class, 'SemesterID');
    }
}
