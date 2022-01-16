<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Receptionist extends Model
{
    protected $table = 'receptionist_appointment';

    protected $fillable = ['phone', 'approval_of', 'date_time', 'purpose', 'request_detail', 'appointment_id'];
}
