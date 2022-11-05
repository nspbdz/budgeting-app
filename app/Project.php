<?php

namespace App;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    // use HasFactory;
    // use HasRoles;

    protected $table = "project";
    protected $fillable = [
      "id",
      "projectcode",
      "subprojectcode",
      "nilaifs",
      "filenamefs",
      "pic",
      "fsyear",
      "targetlive",
      "budgetallocationyear",
      "budgetallocationtarget",
      "paymentmethode",
      "projectname",
      "initiativename",
      "budgetallocation",
      "isactive",
      "createdby",
      "updatedby",
    ];

    public function getProjectDetailApproval(){
        return $this->hasMany(ProjectDetailApproval::class,"projectcode");
    }
    public function getProjectDetailApprovalHistory(){
        return $this->hasMany(ProjectDetailApprovalHistory::class,"projectcode");
    }
    public function getProjectDetail(){
        return $this->hasMany(ProjectDetail::class,"projectcode");
    }
    public function getIO(){
        return $this->belongsTo(InternalOrder::class,"iocode");
    }
    public function getUser(){
        return $this->belongsTo(User::class,"createdby");
    }
    // public function ingredients()
    // {
    //     return $this->belongsToMany('App\InternalOrder')
    //     // ->withPivot('portion'); jika ingin menbamgil data dari bridge
    // }
    // return $this->hasMany(Comment::class);
}

//

