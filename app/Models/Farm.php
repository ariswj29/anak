<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class farm extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $primaryKey = 'farm_id';
    protected $table = 'farm';

    protected $fillable = [
        'farm_id',
        'mitra_id',
        'nama_farm',
        'alamat_farm',
        'mata_uang',
        'satuan_berat',
        'kapasitas_rak_telur',
        'kapasitas_kandang_doc',
        'kapasitas_kandang_grower',
    ];

    public function User()
    {
       return $this->belongsTo(User::class,'id');
    }
    public function Mitra()
    {
        return $this->belongsTo(Mitra::class,'mitra_id');
    }
    public function Siklus()
    {
        return $this->hasOne('app\models\Siklus', 'siklus_id');
    }

    function total_rows() {
        return $this->db->get('farm')->num_rows();
      }
}