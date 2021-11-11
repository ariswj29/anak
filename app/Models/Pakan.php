<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pakan extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $primaryKey = 'pakan_id';
    protected $table = 'pakan';

    protected $fillable = [
        'pakan_id',
        'siklus_id',
        'jenis_pakan',
        'jumlah_pakan',
        'pakan_digunakan',
        'tanggal',
    ];

    public function Siklus()
    {
        return $this->belongsTo(Siklus::class,'siklus_id');
    }
}
