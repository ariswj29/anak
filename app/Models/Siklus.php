<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Siklus extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $primaryKey = 'siklus_id';
    protected $table = 'siklus';
    protected $date = 'tanggal';

    protected $fillable = [
        'siklus_id',
        'farm_id',
        'nama_siklus',
        'tanggal',
        'jenis_ternak',
        'jumlah_ternak',
        'harga_satuan_doc',
        'supplier',
    ];

    public function Farm()
    {
        return $this->belongsTo(Farm::class,'farm_id');
    }
    public function Pakan()
    {
        return $this->hasOne('app\models\Pakan', 'pakan_id');
    }
    public function Pjub()
    {
        return $this->hasOne('app\models\Pjub', 'pjub_id');
    }
    public function Berat()
    {
        return $this->hasOne('app\models\Berat', 'berat_id');
    }
    public function Kematian()
    {
        return $this->hasOne('app\models\Kematian', 'kematian_id');
    }
    public function getTotalPriceAttribute() {
        return $this->berat * $this->pakan * $this->Kematian;
    }
}
