<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class transaksi extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $primaryKey = 'jenis_transaksi_id';
    protected $table = 'jenis_transaksi';

    protected $fillable = [
        'jenis_transaksi_id',
        'jenis_transaksi',
    ];
}