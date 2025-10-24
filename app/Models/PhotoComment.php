<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhotoComment extends Model
{
    use HasFactory;

    protected $fillable = [
        'foto_id',
        'name',
        'email',
        'comment',
        'is_approved',
        'ip_address'
    ];

    public function foto()
    {
        return $this->belongsTo(Foto::class);
    }
}