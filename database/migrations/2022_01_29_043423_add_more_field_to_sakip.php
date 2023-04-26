<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMoreFieldToSakip extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sakip', function (Blueprint $table) {
            $table->string('slug')->after('nama');
            $table->integer('didownload')->default(0)->after('slug');
            $table->integer('dibaca')->default(0)->after('didownload');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sakip', function (Blueprint $table) {
            $table->dropColumn('slug');
            $table->dropColumn('didownload');
            $table->dropColumn('dibaca');
        });
    }
}
