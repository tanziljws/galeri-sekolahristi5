<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JurusanActivity extends Model
{
    use HasFactory;

    protected $fillable = [
        'jurusan',
        'title',
        'description',
        'image_path',
        'activity_type',
        'activity_date',
        'is_active'
    ];

    protected $casts = [
        'activity_date' => 'date',
        'is_active' => 'boolean'
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeByJurusan($query, $jurusan)
    {
        return $query->where('jurusan', $jurusan);
    }

    public function scopeLatest($query)
    {
        return $query->orderBy('activity_date', 'desc');
    }
}
