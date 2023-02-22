<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;

    protected $fillable=[
        'kodetransaksi',
        'santri_id',
        'tgl_transaksi',
        'nominal',
        'petugas'
    ];
}
