<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Pjub;
use App\Models\Users;

class home extends Model
{
    use HasFactory;
    protected $table = "pjub";
    protected $primaryKey = 'pjub_id';
    
    public function postedBy(){
        return $this->belongsTo(Pjub ::class);

   }

   public function user()
    {
        return $this->hasMany(User::class);
    }

}


