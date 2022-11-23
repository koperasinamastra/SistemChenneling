<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Cabang;

class Debitur extends Model
{
    use HasFactory;
    protected $fillable = ['nama_debitur','alamat','email','tlp','plafond','cabang' ];

    public function cabang()
    {
    return $this->belongsTo(Cabang::class,'cabang_id','id');
    }
    
}
