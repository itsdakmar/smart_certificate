<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCertificateConfigsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('certificate_configs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('orientation');
            $table->string('original');
            $table->string('converted')->nullable();
            $table->unsignedSmallInteger('show_director')->default(0);
            $table->unsignedInteger('convert_status')->nullable();
            $table->unsignedInteger('certificate_type')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('certificate_configs');
    }
}
