<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\VisitorResetNotification;
use Illuminate\Notifications\Notifiable;

class VisitorRegistration extends Authenticatable
{
     use Notifiable;

    protected $hidden = ['password','remember_token'];

    protected $table = 'visitor_registration';

    protected $fillable = ['name', 'email', 'phome', 'address', 'password', 'image', 'status'];

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new VisitorResetNotification($token));
    }
}
