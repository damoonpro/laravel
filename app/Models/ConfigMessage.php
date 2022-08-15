<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConfigMessage extends Model
{
    use HasFactory;

    protected $fillable = [
        'notification',
        'text',
        'help',
        'alias',
    ];
}
