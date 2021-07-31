<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserTable extends Migration{

    public function up(){

        Schema::create('Users', function (Blueprint $table){
            $table->engine = 'InnoDB';
            $table->id();
            $table->string('first_name',30);
            $table->string('last_name',30);
            $table->string('phone')->unique();
            $table->integer('gender');
            $table->string('email')->unique();
            $table->string('password');

            $table->string('photo');
            $table->string('nid_back');
            $table->string('nid_front');

            $table->string('delivery_method');
            $table->string('vehicle_number');
            $table->string('vehicle_color');
            $table->string('vehicle_model');

            $table->string('state_id');
            $table->string('city_id');
            $table->string('street');
            $table->string('building_number');
            $table->string('floor');
            $table->string('apartment');

            $table->rememberToken();
            $table->timestamps();
        }); }

     public function down(){
       Schema::dropIfExists($this->tableName);}
}
