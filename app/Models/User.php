<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'hak_akses',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function Mitra()
    {
        return $this->belongsTo(Mitra::class,'mitra_id');
    }

    public function isAdmin()
    {
        return $this->hak_akses == 'administrator';
    }

    public function isMitra()
    {
        return $this->hak_akses == 'mitra';
    
    }    

    public function isPjub()
    {
        return $this->hak_akses == 'pjub';
    
    }    

    public function adminlte_image()
    {
        return 'https://picsum.photos/300/300';
    }

    public function adminlte_profile_url()
    {
        return 'profile';
    }
}

