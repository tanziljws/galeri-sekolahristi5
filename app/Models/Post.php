<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'judul',
        'kategori_id',
        'isi',
        'petugas_id',
        'status',
        'tanggal_jadwal'
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    public function petugas()
    {
        return $this->belongsTo(Petugas::class);
    }

    public function galeries()
    {
        return $this->hasMany(Galery::class);
    }

    /**
     * Check if this post is an upcoming event/news
     */
    public function isUpcoming()
    {
        return $this->tanggal_jadwal && $this->tanggal_jadwal > now()->toDateString();
    }

    /**
     * Get formatted scheduled date
     */
    public function getFormattedTanggalJadwalAttribute()
    {
        if (!$this->tanggal_jadwal) {
            return null;
        }
        
        return \Carbon\Carbon::parse($this->tanggal_jadwal)->locale('id')->isoFormat('dddd, D MMMM Y');
    }
}
