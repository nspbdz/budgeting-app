<?php

namespace App;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DepartmentHead extends Model
{

    protected $table = "departmenthead";
    protected $fillable = [
      "userid",
      "departmentheadid",
      "isactive",
    ];

   
    public function getUser(){
      return $this->belongsTo(User::class,"userid");
  }

    // return $this->hasMany(Comment::class);
}

//

