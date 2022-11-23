<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Cabang;

class Debitur extends Model
{
    use HasFactory;
    protected $fillable = [
            'no_pengajuan',
            'nama_debitur',
            'cabang_id',
            'noktp',
            'alamat',
            'tlp',
            'email',
            'foto_ktp',
            'foto_kk',
            'foto_pasangan',
            'tempat_lahir',
            'tgl_lahir',
            'ibu_kandung',
            'nama_pasangan',
            'tgl_lahir_pasangan',
            'pendidikan',
            'status_kawin',
            'jumlah_tunjangan',
            'no_npwp',
            'alamat_skrng',
            'status_tinggal',
            'Jenis_pekerjaan',
            'nama_perusahaan',
            'tlp_perusahaan',
            'lama_bekerja',
            'penghasilan_bersih'
    ];

    public function cabang()
    {
    return $this->belongsTo(Cabang::class,'cabang_id','id');
    }
    
}
