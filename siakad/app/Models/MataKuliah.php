<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MataKuliah extends Model
{
    protected $table = 'mata_kuliah';
    protected $fillable = ['kode_mk','nama_mk','dosen_id','sks'];

    public function dosen()
    {
        return $this->belongsTo(Dosen::class);
    }

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class, 'mata_kuliah_id');
    }

    public function mahasiswas()
    {
        return $this->belongsToMany(Mahasiswa::class, 'enrollments', 'mata_kuliah_id', 'mahasiswa_id')->withTimestamps();
    }
}
