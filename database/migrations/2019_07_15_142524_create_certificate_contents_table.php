<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCertificateContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('certificate_contents', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('config_id');
            $table->string('content');
            $table->unsignedSmallInteger('x');
            $table->unsignedSmallInteger('y');
            $table->timestamps();
            $table->foreign('config_id')->references('id')->on('certificate_configs');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('certificate_contents');
    }
}
