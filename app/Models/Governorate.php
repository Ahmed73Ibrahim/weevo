<?php
namespace App\Models;
 use Illuminate\Notifications\Notifiable;
 use Illuminate\Foundation\Auth\User as Authenticatable;

class Governorate extends Authenticatable     
{
    use Notifiable;

    public $timestamps = false;


 }