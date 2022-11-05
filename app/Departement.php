<?php

namespace App;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departement extends Model
{
    // use HasFactory;
    // use HasRoles;

    protected $table = "departement";
    protected $fillable = [
      "id",
      "departementcode",
      "name",
      "departmenthead",
      "isactive",
      "createdby",
      "updatedby",

    ];


    public function getDeptartmentHead(){
        return $this->belongsTo(User::class,"departmenthead");
    }
    public function getProject(){
      return $this->belongsTo(Project::class,"departmentcode");
  }
    public function getDepartement(){
      return $this->belongsTo(Departement::class,"departmentcode");
  }
    // return $this->hasMany(Comment::class);
}

//

