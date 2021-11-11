<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kas extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $primaryKey = 'kas_id';
    protected $table = 'kas';

    protected $fillable = [
        'kas_id',
        'siklus_id',
        'tanggal',
        'jenis_transaksi',
        'kategori',
        'nominal',
        'catatan',
    ];

    public function Siklus()
    {
        return $this->belongsTo(Siklus::class,'siklus_id');
    }
}
