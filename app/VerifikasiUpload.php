<?php

namespace App;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VerifikasiUpload extends Model
{
    // use HasFactory;
    // use HasRoles;

    protected $table = "verifikasiupload";
    protected $fillable = [
      "id",
      "verifikasiuploadcode",
      'name',
      'filename',
      "projectdetailcode",
      "isactive",
      "createdby",
      "updatedby",
    //   "isactive",

    ];


    // return $this->hasMany(Comment::class);
}

//

