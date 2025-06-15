<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;       // ⬅️ Tambahkan ini jika belum ada
use App\Models\Kategori;   // ⬅️ Tambahkan ini agar tidak error

class Berita extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul',
        'isi',
        'gambar',
        'kategori_id',
        'user_id',
        'status',
    ];

    /**
     * Relasi ke model User (penulis berita)
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Relasi ke model Kategori
     */
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }
}
