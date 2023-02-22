<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TahunAkademiks extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table='tahunakademiks';
    protected $fillable=['tahunakademik','tglmulai','tglakhir','status'];
}
