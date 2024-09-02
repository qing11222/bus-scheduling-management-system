<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $primaryKey = 'NotificationID';

    protected $fillable = [
        'AnnouncementID',
        'Message',
        'IsRead',
    ];

    /**
     * Get the announcement associated with the notification.
     */
    public function announcement()
    {
        return $this->belongsTo(Announcement::class, 'AnnouncementID');
    }

}
