<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSurveisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('survei', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_opd');
            $table->string('nama');
            $table->foreignId('id_usia');
            $table->foreignId('id_waktu');
            $table->enum('jenis_kelamin', ['L', 'P'])->default('L');
            $table->foreignId('id_pendidikan');
            $table->foreignId('id_pekerjaan');
            $table->text('jenis_layanan');
            $table->integer('kesesuaian')->default(1);
            $table->integer('kemudahan')->default(1);
            $table->integer('kecepatan')->default(1);
            $table->integer('kewajaran')->default(1);
            $table->integer('hasil')->default(1);
            $table->integer('kompentensi')->default(1);
            $table->integer('perilaku')->default(1);
            $table->integer('kualitas')->default(1);
            $table->integer('penanganan')->default(1);
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
        Schema::dropIfExists('survei');
    }
}
