<?php

namespace App;

use App\Notifications\AdminResetNotification;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class VisitorAdmin extends Authenticatable
{
    use Notifiable;
    //use SoftDeletes;

     protected $guard= 'system_admin';
    
    protected $fillable = ['name', 'email', 'mobile', 'password', 'image', 'status', 'role'];   

    protected $hidden = ['password','remember_token'];
}
