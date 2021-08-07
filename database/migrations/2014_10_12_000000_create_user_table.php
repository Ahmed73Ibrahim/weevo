<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserTable extends Migration{

    //public $tableName="Users";

    public function up(){

         
        Schema::create('Users', function (Blueprint $table){
            $table->engine = 'InnoDB';
            $table->id();
            $table->string('name',100);
            $table->string('phone')->unique();
            $table->string('pass')->index();
            $table->boolean('type'); # person = 1 , company = 2 
            $table->string('im_path')->nullable();    #profile img path
            $table->string('c_rec')->nullable();  #commrecal record [ if commpany ]

            $table->unsignedBigInteger('city_id')->nullable(); 
            $table->integer('gover_id')->nullable(); 

            $table->foreign('city_id')->references('id')->on('Citys');  
            $table->foreign('gover_id')->references('gover_id')->on('Citys');  
            $table->string('api_token')->nullable();     
            $table->rememberToken();
            $table->timestamps();

        });
    }
     public function down() {  Schema::dropIfExists($this->tableName);  }
    
}
