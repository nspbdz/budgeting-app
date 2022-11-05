<?php

namespace App;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    // use HasFactory;
    // use HasRoles;

    protected $table = "asset";
    protected $fillable = [
      "id",
      "assetcode",
      "assetmasternumber",
      "jobname",
      "contractnumber",
      "contractvalue",
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

