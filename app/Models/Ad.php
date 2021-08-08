<?php
namespace App\Models;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Ad extends Authenticatable  
{
    use Notifiable;

    public $timestamps = false;

    protected $fillable=[
        'title',
        'ad_type',
        'price',
        'distance',
        'car_img', 
        'state', 
        'guarantee', 
        'details', 
        'user_id',
        'car_id',
        'created_at'];

}