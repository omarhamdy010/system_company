<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable  implements JWTSubject
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'phone',
        'email',
        'password',
        'image',
    ];
    protected $appends=['image_path'];

    public function getImagePathAttribute(){
        return asset('uploads/user/'.$this->image);
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function attendance(){
        return $this->hasMany(Attendance::class);
    }
    public function getIsAttendanceAttribute()
    {
        return (boolean)$this->attendance()->where(['type' => 'presence',
            'history'=> Carbon::now()->format('Y-m-d')
        ])->first();
    }
    public function getIsLeaveAttribute()
    {
        return (boolean)$this->attendance()->where(['type' => 'leave',
            'history'=> Carbon::now()->format('Y-m-d')
        ])->first();
    }
    public function getJWTIdentifier() {
        return $this->getKey();
    }

    public function getJWTCustomClaims() {
        return [];
    }
}
