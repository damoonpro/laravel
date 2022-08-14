<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KavenegarSMS extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'kavenegar_messages';
    
    protected $fillable = [
        'user_id',
        'message_id',
        'local_id',
        'message',
        'status',
        'status_text',
        'from',
        'to',
        'price',
        'send_at'
    ];
}
