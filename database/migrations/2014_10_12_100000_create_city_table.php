<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Cities', function (Blueprint $table) {
            $table->id()->index();
            $table->integer('gover_id')->index();
            $table->string('city_ar');
            $table->string('city_en');
        });
    }

    public function down()
    {
        Schema::dropIfExists('Cities');
    }
}
