<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;


class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'userName',
        'about',
        'email',
        'contact',
        'profileType',
        'avatar',
        'role',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function posts()
    {
        return $this->hasMany('App\Post');
    }

    public function userRole()
    {
        return $this->hasOne('App\Role');
    }

    //Check if admin
    public function isAdmin()
    {
        if ($this->userRole == null) {
            return false;
        }
        return $this->userRole->name == 'admin';
    }

    //User skills
    public function skills()
    {
        return $this->hasMany('App\UserSkill');
    }

    public function messagesNew()
    {
        return $this->hasMany('App\Message')->where('archived', '=', '0');
    }

    public function messagesArchived()
    {
        return $this->hasMany('App\Message')->where('archived', '=', '1');
    }

    public function fromUser($id)
    {
        $user = self::find($id);
        return $user;
    }

    public function fromUserWithChats($id){
        $user = self::find($id);
        $avatar = $user->avatar ?? 'data/img/Ellipse.png';
        $data[$user->id] = ['name' => $user->name, 'id' => $user->id, 'avatar' => $avatar];
        return $data;
    }
}
