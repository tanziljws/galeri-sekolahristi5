<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Foto extends Model
{
    protected $table = 'foto';
    
    protected $fillable = [
        'galery_id',
        'file',
        'judul'
    ];

    public function galery()
    {
        return $this->belongsTo(Galery::class);
    }

    public function interactions()
    {
        return $this->hasMany(PhotoInteraction::class, 'foto_id');
    }

    public function comments()
    {
        return $this->hasMany(PhotoComment::class, 'foto_id')->where('is_approved', true);
    }

    public function likesCount()
    {
        return $this->interactions()->where('type', 'like')->count();
    }

    public function dislikesCount()
    {
        return $this->interactions()->where('type', 'dislike')->count();
    }

    public function hasUserInteraction($ipAddress, $type = null)
    {
        $query = $this->interactions()->where('ip_address', $ipAddress);
        if ($type) {
            $query->where('type', $type);
        }
        return $query->exists();
    }
}
