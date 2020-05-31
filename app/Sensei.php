<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Sensei extends Authenticatable
{
    use Notifiable;

    protected $table = 'mentor_info';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name','last_name', 'status', 'pic_url', 'phone_number', 'dept', 'bio', 'created', 'email',
    ];


}
