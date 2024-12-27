<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tool extends Model
{
    use HasFactory;

    protected $fillable = [
        'role_id',
        'name',
        'icon',
        'modifier',
    ];

    /**
     * Relasi ke role.
     */
    public function role()
    {
        return $this->belongsTo(Role::class);
    }
}
