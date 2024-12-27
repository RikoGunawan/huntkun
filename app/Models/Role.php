<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'image'];

    // Relasi ke tools
    public function tools()
    {
        return $this->hasMany(Tool::class);
    }

    // Relasi ke locations
    public function locations()
    {
        return $this->hasMany(Location::class);
    }
}
