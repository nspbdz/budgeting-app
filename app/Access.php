<?php

namespace App;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Access extends Model
{
    // use HasFactory;
    // use HasRoles;

    protected $table = "access";
    protected $fillable = [
      "id",
      "roleid",
      "page",
    //   'page' => 'array',
      //   'shifts' => 'array',
    ];

 public function getRole(){
        return $this->belongsTo(Role::class,"roleid");
    }
    // public function getUser(){
    //     return $this->belongsTo(User::class,"rolecode");
    // }
    // return $this->hasMany(Comment::class);
}

//

