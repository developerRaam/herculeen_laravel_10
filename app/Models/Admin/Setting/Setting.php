<?php

namespace App\Models\Admin\Setting;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $table = 'settings';

    // Define the fillable attributes
    protected $fillable = [
        'code','key','value'
    ];
}
