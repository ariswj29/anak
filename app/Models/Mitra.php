<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Pjub;
use App\Models\User;

class Mitra extends Model
{


    
    use HasFactory;
    use SoftDeletes;
    protected $primaryKey = 'mitra_id';
    protected $table = 'mitra';

    protected $fillable = [
        'mitra_id',
        'pjub_id',
        'nama',
        'nik',
        'tempat_lahir',
        'tanggal_lahir',
        'alamat',
        'no_hp',
        'email',
    ];

    
    public function User()
    {
        return $this->belongsTo(User::class,'id');
    }
    
    public function Pjub()
    {
        // var_dump($this->belongsTo(Pjub::class,'pjub_id'));
        // die;
        return $this->belongsTo(Pjub::class,'pjub_id');
    }
//     public function lowest()
// {
//     return $this->prices->min('price');
// }
}




