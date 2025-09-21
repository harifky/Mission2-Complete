<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    protected $fillable = ['user_id','nim','tahun_masuk'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }

    public function mataKuliah()
    {
        return $this->belongsToMany(MataKuliah::class, 'enrollments', 'mahasiswa_id', 'mata_kuliah_id')->withTimestamps();
    }

    public function scopeWithCourses($query)
    {
        return $query->with('mataKuliah');
    }
}
