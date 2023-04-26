<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMoreFieldToStunting extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('stunting', function (Blueprint $table) {
            $table->foreignId('id_balita');
            $table->integer('tahun');
            $table->integer('bulan');
            $table->integer('hari');
            $table->date('tgl_pengukuran');
            $table->string('berat');
            $table->string('tinggi');
            $table->string('lila');
            $table->string('bb_per_u');
            $table->string('zs_bb_per_u');
            $table->string('tb_per_u');
            $table->string('zs_tb_per_u');
            $table->string('bb_per_tb');
            $table->string('zs_bb_per_tb');
            $table->string('naik_berat_badan');
            $table->string('pmt_diterima');
            $table->string('jml_vit_a');
            $table->string('kpsp');
            $table->string('kia');
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
        Schema::table('stunting', function (Blueprint $table) {
            //
        });
    }
}
