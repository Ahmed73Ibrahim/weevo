<?php
namespace App\Models;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    public $timestamps = false;

    protected $fillable=[
        'name',
        'phone',
        'pass',
        'type',
        'img_path', 
        'c_rec', 
        'address', 
        'location', 
        'remember_token',
        'created_at' /*,'updated_at'//'email_verified_at',*/];

    protected $hidden = ['pass','updated_at','created_at'];

    // public function messages() { return $this->hasMany(Message::class); }

    public function getJWTIdentifier(){ return $this->getKey(); }

    public function getJWTCustomClaims(){  return []; }
}