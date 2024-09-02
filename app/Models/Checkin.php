<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Checkin extends Model
{
    use HasFactory;

    protected $fillable = ['UserID', 'checkin_time', 'checkout_time'];

    public function user()
    {
        return $this->belongsTo(User::class, 'id');
    }
}
