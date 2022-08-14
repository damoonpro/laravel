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

    public static function codeGenerator(){
        do{
            $code = mt_rand(10000000, 99999999);
        }while(self::exsitsCode($code));

        return $code;
    }

    protected static function exsitsCode(int $code){
        return !! KavenegarSMS::whereLocalId($code)->first();
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
