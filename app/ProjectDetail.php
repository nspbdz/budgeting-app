<?php

namespace App;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectDetail extends Model
{
    // use HasFactory;
    // use HasRoles;

    protected $table = "projectdetail";
    protected $fillable = [
        "projectcode",
        "projectname",
        "initiativename",
        "vendorname",
        "jobdetail",
        "budgetallocation",
        //  "idinternalorder",
        "iocode",
         "noformrequest",
         "requestuploadfrom",
         "kontraknumber",
         "bastno",
         "sppno",
         "qtyupload",
         "totalupload",
         "note",
         "notaNo",
         "isactive",
         "crosscheckby",
         "crosscheckdate",
         "crosscheck",
         "lastapproval",
         "lastapprovalstatus",
         "lastapprovaldate",
         "lastapprovalnotes",
        "lastverifyupload",
         "lastverifystatus",
         "lastaverifieddate",
         "lastverifiednotes",
         "createdby",
        //  "createdon",
         "updatedby",
        //  "updatedon"

    ];

    // public function getIO(){
    //     return $this->hasMany(ProjectDetailApproval::class,"projectcode");
    // }
    public function getProjectDetailApproval(){
        return $this->hasMany(ProjectDetailApproval::class,"projectcode");
    }
    public function getIO(){
        return $this->belongsTo(InternalOrder::class,"iocode");
    }
    public function getProject(){
        return $this->belongsTo(Project::class,"projectcode");
    }
    public function getUser(){
        return $this->belongsTo(User::class,"createdby");
    }

}

