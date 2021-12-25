<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Mitra;
use App\Models\User;

class Pjub extends Model
{
    use HasFactory;
    use SoftDeletes ;
    protected $primaryKey = 'pjub_id';
    protected $table = 'pjub';
    protected $fillable = [
        'pjub_id',
        'nama',
    ];

    public function mitras()
    {
        return $this->hasMany(Mitra::class);
    }
    public function user()
    {
        return $this->hasMany(User::class);
    }
}
