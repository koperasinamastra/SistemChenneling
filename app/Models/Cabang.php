<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Debitur;

class Cabang extends Model
{
    use HasFactory;

    protected $fillable = ['NamaCabang', 'alamatCabang', 'tlp'];
    
    public function debitur()
    {
    return $this->hasMany(Debitur::class,'cabang_id','id');
    }

}
