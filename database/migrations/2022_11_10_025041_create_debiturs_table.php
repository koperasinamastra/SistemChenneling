<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('debiturs', function (Blueprint $table) {
            $table->id();
            $table->string('no_pengajuan');
            $table->string('nama_debitur');
            $table->string('noktp');
            $table->string('alamat');
            $table->string('tlp');
            $table->string('email');
            $table->string('foto_ktp');
            $table->string('foto_kk');
            $table->string('foto_pasangan');
            $table->string('tempat_lahir');
            $table->dateTime('tgl_lahir', $precision = 0);
            $table->string('ibu_kandung');
            $table->string('nama_pasangan');
            $table->dateTime('tgl_lahir_pasangan',$precision = 0);
            $table->string('pendidikan');
            $table->string('status_kawin');
            $table->string('jumlah_tunjangan');
            $table->string('no_npwp');
            $table->string('alamat_skrng');
            $table->string('status_tinggal');
            $table->string('Jenis_pekerjaan');
            $table->string('nama_perusahaan');
            $table->string('tlp_perusahaan');
            $table->string('lama_bekerja');
            $table->string('penghasilan_bersih');
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
        Schema::dropIfExists('debiturs');
    }
};
