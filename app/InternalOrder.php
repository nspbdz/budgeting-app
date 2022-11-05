<?php

namespace App;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InternalOrder extends Model
{
    // use HasFactory;
    // use HasRoles;

    protected $table = "internalorder";
    protected $fillable = [
      "id",
    //   "iocode",
      "name",
      "isactive",
      "createdby",
      "updatedby",

    ];


    public function getProject(){
        return $this->belongsTo(Project::class,"projectid");
    }
    // return $this->hasMany(Comment::class);
}

//

