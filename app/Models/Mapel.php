<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Jurusan;

class Mapel extends Model
{
    use HasFactory;

    protected $fillable=['kodemapel','mapel','status','jurusan_id'];

    public function jurusan(){
        return $this->hasOne(Jurusan::class,'id','jurusan_id');
    }
}
