<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kenaikan extends Model
{
    use HasFactory;

    public $table = 'kenaikans';

    protected $guarded = ['id'];

    // Jika Anda ingin menambahkan relasi
    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'id_siswa');
    }

    public function kelasAsal()
    {
        return $this->belongsTo(Kelas::class, 'kelas_asal');
    }

    public function kelasTujuan()
    {
        return $this->belongsTo(Kelas::class, 'kelas_tujuan');
    }
}
