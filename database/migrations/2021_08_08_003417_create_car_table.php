<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Cars', function (Blueprint $table) {
            $table->id();   ## Car id 
            $table->string('make');
            $table->string('body_style');
            $table->string('model');
            $table->string('year');
         });
    }

    public function down()
    {
        Schema::dropIfExists('Cars');
    }
}
