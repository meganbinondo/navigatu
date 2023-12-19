<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'appointment';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'appointment_no';


    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $foreignKey = 'id';    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'area',
        'details',
        'event_date', 
        'start_time', 
        'end_time'
    ];

    protected $hidden = [
        'status',
    ];
}