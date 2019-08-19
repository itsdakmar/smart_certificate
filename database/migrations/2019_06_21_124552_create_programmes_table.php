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
            $table->string('slug');
            $table->string('programme_location')->nullable();
            $table->date('programme_start');
            $table->date('programme_end');
            $table->unsignedBigInteger('cert_committees');
            $table->unsignedBigInteger('cert_participants');
            $table->unsignedSmallInteger('status');
            $table->unsignedBigInteger('created_by');
            $table->timestamps();
            $table->foreign('cert_committees')->references('id')->on('certificate_configs');
            $table->foreign('cert_participants')->references('id')->on('certificate_configs');
            $table->foreign('created_by')->references('id')->on('users');
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
