<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Room extends Model
{

    use HasFactory;

    // Specify the table name if it doesn't follow Laravel's naming convention
    protected $table = 'room';

    // Specify the primary key if it is not 'id'
    protected $primaryKey = 'roomId';

    // Specify fillable fields for mass assignment
    protected $fillable = [
        'roomType',
        'places',
        'beds',
        'roomStatus',
        'roomDesc',
        'price',
    ];



}


