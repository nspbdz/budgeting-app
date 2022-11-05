<?php

namespace App;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectDetailApprovalHistory extends Model
{
    // use HasFactory;
    // use HasRoles;

    protected $table = "projectdetailapprovalhistory";
    protected $fillable = [
        "id",
        "projectcode",
        "projectdetailid",
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

