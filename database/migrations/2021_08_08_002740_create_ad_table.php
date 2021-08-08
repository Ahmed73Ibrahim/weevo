<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdTable extends Migration
{
   
    public function up()
    {
        Schema::create('Ads', function (Blueprint $table) {
            $table->id();
            $table->string('title',100);
            $table->boolean('ad_type');  # free = 0 || paid = 1
            $table->integer('price');
            $table->double('distance');
            $table->string('car_img');
            $table->boolean('state');   # used = 0 || new = 1 
            $table->boolean('guarantee'); # no = 0 || yes = 1 
            $table->text('details')->nullable();
            $table->timestamps();   # Ad_Date 

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('Users');  

            $table->unsignedBigInteger('car_id');           # create car Table First 
            $table->foreign('car_id')->references('id')->on('Cars');   # create car Table First 

        });
    }
 
    public function down()
    {
        Schema::dropIfExists('Ads');
    }
}
