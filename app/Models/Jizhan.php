<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class jizhan extends Model
{
    use Notifiable;

    protected $table = 'jizhan';

    protected $fillable = [
        'bh', 'name', 'region','lon','lat','add'
    ];


   
}
