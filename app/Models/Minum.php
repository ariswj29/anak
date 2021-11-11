<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Minum extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $primaryKey = 'minum_id';
    protected $table = 'minum';

    protected $fillable = [
        'minum_id',
        'siklus_id',
        'jumlah_minum',
        'tanggal',
    ];

    public function Siklus()
    {
        return $this->belongsTo(Siklus::class,'siklus_id');
    }
}
