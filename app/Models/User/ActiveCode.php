<?php

namespace App\Models\User;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActiveCode extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'code',
        'expired_at',
    ];

    protected $casts = [
        'expired_at' => 'datetime',
    ];

    public static function generateForUser(User $user){
        $code = $user->activeCodes()->create([
            'code' => self::codeGenerator(),
            'expired_at' => now()->addMinutes(2),
        ]);

        return $code;
    }

    public static function checkCode(User $user, int $code){
        if($result = $user->activeCodes()->where('expired_at', '>', now())
            ->whereCode($code)
            ->first()){
            self::cleanUserActiveCodes($user);
        }

        return !! $result;
    }

    protected static function codeGenerator(){
        do{
            $code = mt_rand(100000, 999999);
        }while(self::existsCode($code));

        return $code;
    }

    protected static function existsCode(int $code){
        return !! ActiveCode::whereCode($code)->first();
    }


    public function user(){
        return $this->belongsTo(User::class);
    }

    private static function cleanUserActiveCodes(User $user){
        $user->activeCodes()->delete();
    }
}
