<?php

namespace App;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    // use HasFactory;
    // use HasRoles;

    protected $table = "role";
    protected $fillable = [
      "id",
      "name",
      "position",
    ];


    public function getUser(){
        return $this->belongsTo(User::class,"rolecode");
    }
    // return $this->hasMany(Comment::class);
}

//

