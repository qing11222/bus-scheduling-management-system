<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Events\NewAnnouncementEvent;

class Announcement extends Model
{
    use HasFactory;
    protected $primaryKey = 'AnnouncementID';

    protected $fillable = [
        'Title', 'Description', 'DatePosted', 'RouteID',
    ];

    public function route()
    {
        return $this->belongsTo(Route::class, 'RouteID');
    }
   

}
