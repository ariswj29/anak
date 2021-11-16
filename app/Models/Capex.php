<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class capex extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $primaryKey = 'capex_id';
    protected $table = 'capex';

    protected $fillable = [
        'capex_id',
        'farm_id',
        'capex',
        'jumlah',
        'harga',
        'satuan',
        'subtotal',
    ];

    public function User()
    {
       return $this->belongsTo(User::class,'id');
    }
    public function Farm()
    {
        return $this->belongsTo(Mitra::class,'mitra_id');
    }
    public function Siklus()
    {
        return $this->hasOne('app\models\Siklus', 'siklus_id');
    }

    // function total_rows() {
    //     return $this->db->get('farm')->num_rows();
    //   }
}