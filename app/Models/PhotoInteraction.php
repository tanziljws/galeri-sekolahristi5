<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhotoInteraction extends Model
{
    use HasFactory;

    protected $fillable = [
        'foto_id',
        'ip_address',
        'type'
    ];

    public function foto()
    {
        return $this->belongsTo(Foto::class);
    }
}