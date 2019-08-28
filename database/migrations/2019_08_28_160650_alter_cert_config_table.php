<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterCertConfigTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('certificate_configs', function (Blueprint $table) {
            $table->unsignedSmallInteger('qr_x')->nullable()->unsigned(false)->after('certificate_type')->change();
            $table->unsignedSmallInteger('qr_y')->nullable()->unsigned(false)->after('qr_x')->change();
            $table->unsignedSmallInteger('qr_width')->nullable()->unsigned(false)->after('qr_y')->change();
            $table->unsignedSmallInteger('qr_height')->nullable()->unsigned(false)->after('qr_width')->change();
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
