<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterCertContents2Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('certificate_contents', function (Blueprint $table) {
            $table->unsignedBigInteger('font_style')->nullable()->after('font_size');
            $table->foreign('font_style')->references('id')->on('fonts');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('certificate_contents', function (Blueprint $table) {
            //
        });
    }
}
