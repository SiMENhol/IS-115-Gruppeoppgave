<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Booking extends Model
{
    protected $table = 'reservation';
    use HasFactory;

    protected $fillable = [
        'reservationId',
        'userId',
        'roomId',
        'checkInDato',
        'checkOutDato',
        'reservationStatus',
        'groupBookingId',
        'price'
    ];

    public function room(): BelongsTo
    {
        return $this->belongsTo(Room::class, 'roomId', 'roomId');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'userId', 'id');
    }
}
