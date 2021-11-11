<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kematian extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $primaryKey = 'kematian_id';
    protected $table = 'kematian';

    protected $fillable = [
        'kematian_id',
        'siklus_id',
        'tanggal',
        'jumlah_kematian',
        'penyebab',
    ];

    public function Siklus()
    {
        return $this->belongsTo(Siklus::class,'siklus_id');
    }
}
