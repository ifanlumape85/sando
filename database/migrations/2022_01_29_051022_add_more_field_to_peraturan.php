<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMoreFieldToPeraturan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('peraturan', function (Blueprint $table) {
            $table->string('foto')->after('keterangan');
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
        Schema::table('peraturan', function (Blueprint $table) {
            $table->dropColumn('foto');
            $table->dropColumn('didownload');
            $table->dropColumn('dibaca');
        });
    }
}
