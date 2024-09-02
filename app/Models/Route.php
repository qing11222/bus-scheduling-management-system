<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Route extends Model
{
    use HasFactory;
    protected $table = 'routes';
    protected $primaryKey = 'RouteID';

    protected $fillable = [
        'Origin','Destination', 'Description',
    ];

    public function schedules()
    {
        return $this->hasMany(Schedule::class, 'RouteID');
    }

    public function announcements()
    {
        return $this->hasMany(Announcement::class, 'RouteID');
    }



}
