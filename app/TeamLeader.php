<?php

namespace App;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeamLeader extends Model
{
    // use HasFactory;
    // use HasRoles;

    protected $table = "teamleader";
    protected $fillable = [
      "userid",
      "teamleaderid",
      "isactive",
    ];


   

    public function user()
    {
        return $this->hasMany(User::class);
    }
    // return $this->hasMany(Comment::class);
}

//

