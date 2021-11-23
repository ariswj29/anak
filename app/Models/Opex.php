<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class opex extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $primaryKey = 'opex_id';
    protected $table = 'opex';

    protected $fillable = [
        'opex_id',
        'farm_id',
        'opex',
        'jumlah',
        'harga',
        'satuan',
        'subtotal',
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