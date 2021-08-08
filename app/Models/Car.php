<?php
namespace App\Models;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Car extends Authenticatable  
{
    use Notifiable;

    public $timestamps = false;

    protected $fillable=[
         'car_id',
        'created_at'];

}