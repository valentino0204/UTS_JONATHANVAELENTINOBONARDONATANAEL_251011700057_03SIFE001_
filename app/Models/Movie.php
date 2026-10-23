<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    protected $fillable = [
        'title', 'genre', 'duration', 'release_years', 'description', 'poster',
    ];

    public function getPosterUrlAttribute(): ?string
    {
        return $this->poster && file_exists(public_path('posters/' . $this->poster))
            ? asset('posters/' . $this->poster)
            : null;
    }
}