<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Tingkat;
use App\Models\Jurusan;
use App\Models\TahunAkademiks;
use App\Models\Asatidz;
use App\Models\Santri;

class Rombel extends Model
{
    use HasFactory;

    protected $fillable=[
        'rombel',
        'tingkat_id',
        'jurusan_id',
        'tahunakademik_id',
        'asatidz_id',
        'status'
    ];

    public function tingkat(){
        return $this->hasOne(Tingkat::class,'id','tingkat_id');
    }
    public function jurusan(){
        return $this->hasOne(Jurusan::class,'id','jurusan_id');
    }
    public function tahunAkademik(){
        return $this->hasOne(TahunAkademiks::class,'id','tahunakademik_id');
    }
    public function waliKelas(){
        return $this->hasOne(Asatidz::class,'id','asatidz_id');
    }
    public function santris(){
        return $this->belongsToMany(Santri::class)->withPivot('status','tahun');
    }
}
