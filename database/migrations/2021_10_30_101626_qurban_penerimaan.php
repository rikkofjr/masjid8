<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class QurbanPenerimaan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_qurban_penerimaan', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('amil');
            $table->string('jenis_hewan');
            $table->text('atas_nama');
            $table->text('nama_lain');
            $table->text('permintaan');
            $table->string('nomor_handphone');
            $table->string('disaksikan');
            $table->text('keterangan');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
