<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Satuan;

class Tingkat extends Model
{
    use HasFactory;

    protected $fillable=['tingkat', 'satuan_id'];

    public function satuan(){
        return $this->belongsTo(Satuan::class,'satuan_id','id');
    }
}
