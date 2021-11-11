<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Berat extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $primaryKey = 'berat_id';
    protected $table = 'berat';

    protected $fillable = [
        'berat_id',
        'siklus_id',
        'rata_rata_berat',
        'tanggal',
    ];

    public function siklus()
    {
        return $this->belongsTo(Siklus::class,'siklus_id');
    }
}
