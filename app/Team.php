<?php

namespace App;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    // use HasFactory;
    // use HasRoles;

    protected $table = "team";
    protected $fillable = [
      "id",
      "name",
      "departementcode",
      "isactive",
      "isactive",
      "createdby",
      "updatedby",

    ];


    public function getDepartement(){
        return $this->belongsTo(Departement::class,"departementcode");
    }
    public function getUser(){
      return $this->belongsTo(User::class,"teamleader");
  }
    // return $this->hasMany(Comment::class);
}

//

