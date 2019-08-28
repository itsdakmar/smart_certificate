<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterCertificateConfigsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('certificate_configs', function (Blueprint $table) {
            $table->unsignedSmallInteger('qr_x')->after('certificate_type');
            $table->unsignedSmallInteger('qr_y')->after('qr_x');
            $table->unsignedSmallInteger('qr_width')->after('qr_y');
            $table->unsignedSmallInteger('qr_height')->after('qr_width');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('certificate_configs', function (Blueprint $table) {
            //
        });
    }
}
