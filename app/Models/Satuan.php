<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class satuan extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $primaryKey = 'satuan_id';
    protected $table = 'satuan';

    protected $fillable = [
        'satuan_id',
        'satuan',
    ];
}