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
        'first_name',
        'last_name',
        'phone',
        'email',
        'password',
        'gender',
        'photo',                ///
        'nid_back' ,        ///
        'nid_front',
        'delivery_method',         // 1 = car || 2 = 'motorbike',  3 = 'bicycle',  4=  'truck', 'none'
        'vehicle_number',
        'vehicle_color' ,
        'vehicle_model' ,
        'state_id'   ,
        'city_id',
        'street',
        'building_number',
        'floor' ,
        'apartment',
        'remember_token',
        'created_at'/*,'updated_at'//'email_verified_at',*/];

    protected $hidden = ['password','updated_at','created_at'];

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }

    public function messages()
{
  return $this->hasMany(Message::class);
}

    // Rest omitted for brevity

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
}



