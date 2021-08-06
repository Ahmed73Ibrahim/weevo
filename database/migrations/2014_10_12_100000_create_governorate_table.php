<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGovernorateTable extends Migration
{
    public function up()
    {
        Schema::create('Governorates', function (Blueprint $table) {
            $table->id();
            $table->string('gover_ar');
            $table->string('gover_en');
         });
    }

    public function down()
    {
        Schema::dropIfExists('Governorates');
    }
}
