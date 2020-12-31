<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable,followable;

    protected $fillable = [
        'name', 'email', 'password',
    ];


    protected $hidden = [
        'password', 'remember_token',
    ];


    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getAvatar(){
        return " https://i.pravatar.cc/200?u=".$this->email;
    }

    public function timeline(){
        $ids = $this->follows()->pluck('id'); //takip edilen kisilerin unique idleri
        $ids->push($this->id);//ids arrayine pushla
        return  Tweet::whereIn('user_id',$ids)->latest()->get(); // Tweet modelinde user_id ids olanlari dondur
    }

    public function tweets(){
        return $this->hasMany(Tweet::class)->latest();
    }


    public function getRouteKeyName()
    {
        return 'name';
    }

    public function path($append = ''){
        $path = route('profile',$this->name);
        return $path;
    }



}