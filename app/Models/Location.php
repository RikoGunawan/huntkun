<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    protected $fillable = [
        'role_id',
        'name',
        'image',
        'base_time',
        'reward',
    ];

    /**
     * Relasi ke role.
     */
    public function role()
    {
        return $this->belongsTo(Role::class);
    }
}
