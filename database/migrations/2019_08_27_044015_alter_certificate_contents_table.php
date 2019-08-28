<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterCertificateContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('certificate_contents', function (Blueprint $table) {
            $table->unsignedSmallInteger('margin_left')->after('y');
            $table->unsignedSmallInteger('margin_right')->after('margin_left');

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
