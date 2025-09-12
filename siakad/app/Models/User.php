<?php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Mahasiswa;
use App\Models\Dosen;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = ['username','password','full_name','role'];
    protected $hidden = ['password'];

    // relations
    public function mahasiswa()
    {
        return $this->hasOne(Mahasiswa::class);
    }

    public function dosen()
    {
        return $this->hasOne(Dosen::class);
    }
}
