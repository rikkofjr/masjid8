<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TableBendahara extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_kas_penerimaan', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->text('keterangan');
            $table->text('catatan')->nullable();
            $table->bigInteger('penerimaan');
            $table->string('penginput');
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::create('tb_kas_pengeluaran', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->text('keterangan');
            $table->text('catatan')->nullable();
            $table->bigInteger('pengeluaran');
            $table->string('penginput');
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
        Schema::dropIfExists('tb_kas_penerimaan');
        Schema::dropIfExists('tb_kas_pengeluaran');
    }
}
