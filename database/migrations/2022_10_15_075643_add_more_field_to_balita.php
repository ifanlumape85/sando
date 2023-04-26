<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMoreFieldToBalita extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('balita', function (Blueprint $table) {
            $table->foreignId('id_puskesmas')->nullable()->after('id');
            $table->foreignId('id_desa')->nullable()->after('id');
            $table->string('posyandu');
            $table->string('rt');
            $table->string('rw');
            $table->string('alamat');
            $table->string('nik');
            $table->string('nama');
            $table->enum('jk', ['P', 'L']);
            $table->date('tgl_lahir');
            $table->integer('bb_lahir');
            $table->integer('tb_lahir');
            $table->string('nama_orang_tua');
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
        Schema::table('balita', function (Blueprint $table) {
            //
        });
    }
}
