<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Petugas extends Model
{
    protected $table = 'petugas';
    
    protected $fillable = [
        'username',
        'password',
        'email'
    ];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
