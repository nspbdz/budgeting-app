<?php

namespace App;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Adp extends Model
{
    // use HasFactory;
    // use HasRoles;

    protected $table = "adp";
    protected $fillable = [
      "id",
      'jobname',
      'contractnumber',
      'valueadplastyear',
      'adpformationyear',
      'valueadprealitation',
      'pic',
      "isactive",
      "createdby",
      "updatedby",

    ];


    // public function getUser(){
    //     return $this->belongsTo(User::class,"createdby");
    // }
    // return $this->hasMany(Comment::class);
}

//

