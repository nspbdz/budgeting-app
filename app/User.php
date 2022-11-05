<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable ;
// use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use   Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'email',
        'username'  ,
        'mobilephone',
        'position'  ,
        'namadepan'  ,
        'namabelakang',
        'nip'          ,
        'leaderteam'  ,
        'departmenthead'  ,
        'password',
        'accessid',
        'isteamleader',
        'isactive',
        'password',
    ];

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
    public function getProjectDetailApproval(){
        return $this->hasMany(ProjectDetailApproval::class,"userid");
    }
    public function getAccess(){
        return $this->belongsTo(Access::class,"accessid");
    }
    public function getLeader(){
        return $this->belongsTo(User::class,"leaderteam");
    }
    // public function leader()
    // {
    //     return $this->hasMany(TeamLeader::class);
    // }
    public function getLeaderTeam(){
        return $this->belongsTo(TeamLeader::class);
    }

}
