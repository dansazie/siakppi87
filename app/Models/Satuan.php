<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Asatidz;

class Satuan extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable=[
        'satuan',
        'npsn',
        'nsm',
        'asatidz_id',
        'logo'
    ];

    public function mudir()
    {
        return $this->hasOne(Asatidz::class,'id','asatidz_id');
    }
}
