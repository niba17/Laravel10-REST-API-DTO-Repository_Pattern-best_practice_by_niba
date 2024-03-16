<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Client extends Authenticatable
{
    use HasApiTokens, HasFactory, HasUuids, Notifiable, Sluggable;

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'identifier'
            ]
        ];
    }

    protected $primaryKey = 'uuid';
    public $incrementing = false;
    protected $fillable = [
        'identifier',
        'password',
        'slug',
    ];

    protected $hidden = [];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
}
