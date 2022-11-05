<?php

namespace App;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectDetailApproval extends Model
{
    // use HasFactory;
    // use HasRoles;

    protected $table = "projectdetailapproval";
    protected $fillable = [
        "id",
        "projectdetailid",
        "userid",
        "featuretype",
        "approvaltype",
        "approvalstatus",
        "approvaldate",
        "notes"

    ];
    public function getUser(){
        return $this->belongsTo(User::class, 'userid');
    }
}

