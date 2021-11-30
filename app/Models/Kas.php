<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class kas extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $primaryKey = 'id';
    protected $table = 'kas';

    protected $fillable = [
        'id',
        'siklus_id',
        'tanggal',
        'nama',
        'vol',
        'satuan_id',
        'harga_satuan',
        'kategori_id',
        'jenis_kategori_id',
        'saldo',
        'keterangan',
    ];

    // public function User()
    // {
    //    return $this->belongsTo(User::class,'id');
    // }
    // public function Farm()
    // {
    //     return $this->belongsTo(Mitra::class,'mitra_id');
    // }
    // public function Siklus()
    // {
    //     return $this->hasOne('app\models\Siklus', 'siklus_id');
    // }

    // function total_rows() {
    //     return $this->db->get('farm')->num_rows();
    //   }
}