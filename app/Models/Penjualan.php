<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Penjualan extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $primaryKey = 'penjualan_id';
    protected $table = 'penjualan';

    protected $fillable = [
        'penjualan_id',
        'tanggal',
        'jumlah',
        'bobot_jual',
        'jumlah_nominal',
        'foto',
        'siklus_id',
    ];

    public function Siklus()
    {
        return $this->belongsTo(Siklus::class,'siklus_id');
    }
}
