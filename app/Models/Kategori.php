<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kategori extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $primaryKey = 'kategori_id';
    protected $table = 'kategori';

    protected $fillable = [
        'kategori_id',
        'kategori',
    ];
}