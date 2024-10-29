<?php

namespace App\Models\Api;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens; 

class Api extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $guard = 'api';
}
