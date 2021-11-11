<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vitamin extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $primaryKey = 'vitamin_id';
    protected $table = 'vitamin';

    protected $fillable = [
        'vitamin_id',
        'siklus_id',
        'jenis_vitamin',
        'jumlah_vitamin',
        'tanggal',
    ];

    public function Siklus()
    {
        return $this->belongsTo(Siklus::class,'siklus_id');
    }
}
