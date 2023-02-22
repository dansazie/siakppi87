<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\TahunAkademiks;
use App\Models\Tingkat;
use App\Models\Santri;

class Pemasukan extends Model
{
    use HasFactory;

    protected $fillable=[
        'kode',
        'namapemasukan',
        'deskripsi',
        'nominal',
        'is_pemasukansantri',
        'tingkat_id',
        'tahunakademik_id',
        'tglmulai',
        'tglakhir',
        'status'
    ];

    public function tingkats(){
        return $this->belongsToMany(Tingkat::class)->withPivot('status','tahunakademik_id');
    }

    public function santris(){
        return $this->belongsToMany(Santri::class)->withPivot('status','tahunakademik_id');
    }

    public function tahunAkademik(){
        return $this->hasOne(TahunAkademiks::class,'id','tahunakademik_id');
    }

}
