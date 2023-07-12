<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Provinsi;
use App\Models\Kabupaten;
use App\Models\Kecamatan;
use App\Models\Desa;
use App\Models\Tingkat;
use App\Models\Rombel;
use App\Models\User;
use App\Models\Pemasukan;
use App\Models\Pembayaran;

class Santri extends Model
{
    use HasFactory;

    protected $fillable=[
        'nis',
        'nisn',
        'nik',
        'namalengkap',
        'tmplahir',
        'tgllahir',
        'kelamin',
        'alamat',
        'provinsi_id',
        'kabupaten_id',
        'kecamatan_id',
        'desa_id',
        'tingkat_id',
        'user_id',
        'photo',
        'status'
    ];

    public function provinsi()
    {
        return $this->hasOne(Provinsi::class,'id','provinsi_id');
    }
    public function kabupaten()
    {
        return $this->hasOne(Kabupaten::class,'id','kabupaten_id');
    }
    public function kecamatan()
    {
        return $this->hasOne(Kecamatan::class,'id','kecamatan_id');
    }
    public function desa()
    {
        return $this->hasOne(Desa::class,'id','desa_id');
    }
    public function tingkat()
    {
        return $this->hasOne(Tingkat::class,'id','tingkat_id');
    }

    public function rombels()
    {
        return $this->belongsToMany(Rombel::class)->withPivot('status','tahun');
    }

    public function rombel()
    {
        return $this->belongsToMany(Rombel::class)->where('rombel_santri.status', 'Aktif');
    }

    public function pemasukans(){
        return $this->belongsToMany(Pemasukan::class)->withPivot('status','tahunakademik_id')->where('pemasukan_santri.status','Aktif');
    }

    public function pembayarans(){
        return $this->hasMany(Pembayaran::class);
    }

    public function user()
    {
        return $this->hasOne(User::class,'id','user_id');
    }
}
