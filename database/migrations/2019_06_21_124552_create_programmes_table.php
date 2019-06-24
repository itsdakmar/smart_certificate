<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProgrammesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('programmes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('programme_name');
            $table->date('programme_start');
            $table->date('programme_end');
            $table->unsignedBigInteger('certificate_conf');
            $table->unsignedSmallInteger('status');
            $table->bigInteger('created_by');
            $table->timestamps();
            $table->foreign('certificate_conf')->references('id')->on('certificate_configs');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('programmes');
    }
}
