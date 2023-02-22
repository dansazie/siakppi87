<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Pendidikan;
use App\Models\Provinsi;
use App\Models\Kabupaten;
use App\Models\Kecamatan;
use App\Models\Desa;
use App\Models\User;

class Asatidz extends Model
{
    use HasFactory;

    protected $fillable=[
        'nip',
        'nuptk',
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
        'pendidikan_id',
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
    public function pendidikan()
    {
        return $this->hasOne(Pendidikan::class,'id','pendidikan_id');
    }
    public function user()
    {
        return $this->hasOne(User::class,'id','user_id');
    }
}
