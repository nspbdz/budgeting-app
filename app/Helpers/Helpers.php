<?php
namespace App\Helpers;
// use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Route;
use App\Role;
use App\User;
use App\Access;

class Helpers {

    public static function get_username($user_id) {
        $user = DB::table('users')->where('id', $user_id)->first();

        return (isset($user->email) ? $user->email : '');
    }

    // public static function isActiveRoute($route, $output = "active")
    // {

    //     if (Route::currentRouteName() == $route) return $output;
    // }

    public static function get_DashboardAccess($userAuth, $output = "dashboard") {
        // dd($userAuth);
        $dashboard = Access::get();
        // dd($dashboard);
        $dashboard = Access::where('id', $userAuth )->where('page', 'LIKE', "%dashboard%")->first();
        // dd($dashboard);
        $getDashboard = empty($dashboard)? "kosong" : "ada";
        // dd($getDashboard);
        if ( $getDashboard == "kosong") return $output;
    }

    public static function get_masterUserAccess($userAuth , $output = "masterUser") {
        $masterUser = Access::where('id', $userAuth )->where('page', 'LIKE', "%master user%")->first();
        // dd($masterUser);
        $getmasterUser = empty($masterUser)? "kosong" : "ada";
        // dd($getmasterUser);
        if ( $getmasterUser == "kosong") return $output;
    }

    public static function get_masterRoleAccess($userAuth , $output = "masterRole") {
        $masterRole = Access::where('id', $userAuth )->where('page', 'LIKE', "%master role%")->first();
        // dd($masterRole);
        $getmasterRole = empty($masterRole)? "kosong" : "ada";
        // dd($getmasterRole);
        if ( $getmasterRole == "kosong") return $output;

        // $masterRole = Role::where('id', $userAuth )->first();
        // $getMasterRole = empty($masterRole)? 0 : $masterRole->masterrole;
        // if ( $getMasterRole == 0) return $output;
    }

    public static function get_masterProjectAccess($userAuth , $output = "masterProject") {
         $masterProject = Access::where('id', $userAuth )->where('page', 'LIKE', "%master project%")->first();
        // dd($masterProject);
        $getmasterProject = empty($masterProject)? "kosong" : "ada";
        // dd($getmasterProject);
        if ( $getmasterProject == "kosong") return $output;


    }

    public static function get_masterDepartementAccess($userAuth , $output = "masterDepartement") {
         $masterDepartement = Access::where('id', $userAuth )->where('page', 'LIKE', "%master departement%")->first();
        // dd($masterDepartement);
        $getmasterDepartement = empty($masterDepartement)? "kosong" : "ada";
        // dd($getmasterDepartement);
        if ( $getmasterDepartement == "kosong") return $output;

    }

    public static function get_masterTeamAccess($userAuth , $output = "masterTeam") {
        $masterTeam = Access::where('id', $userAuth )->where('page', 'LIKE', "%master team%")->first();
        // dd($masterTeam);
        $getmasterTeam = empty($masterTeam)? "kosong" : "ada";
        // dd($getmasterTeam);
        if ( $getmasterTeam == "kosong") return $output;
   }

   public static function get_masterInternalOrderAccess($userAuth , $output = "masterInternalOrder") {

        $masterInternalOrder = Access::where('id', $userAuth )->where('page', 'LIKE', "%master internal order%")->first();
        // dd($masterInternalOrder);
        $getmasterInternalOrder = empty($masterInternalOrder)? "kosong" : "ada";
        // dd($getmasterInternalOrder);
        if ( $getmasterInternalOrder == "kosong") return $output;
    }

    public static function get_masterAssetAccess($userAuth , $output = "masterAsset") {


     $masterAsset = Access::where('id', $userAuth )->where('page', 'LIKE', "%master asset%")->first();
        // dd($masterAsset);
        $getmasterAsset = empty($masterAsset)? "kosong" : "ada";
        // dd($getmasterAsset);
        if ( $getmasterAsset == "kosong") return $output;
    }

    public static function get_inputprojectAccess($userAuth , $output = "inputProject") {

        $inputProject = Access::where('id', $userAuth )->where('page', 'LIKE', "%input project%")->first();
        // dd($inputProject);
        $getinputProject = empty($inputProject)? "kosong" : "ada";
        // dd($getinputProject);
        if ( $getinputProject == "kosong") return $output;
    }

    public static function get_crossCheckDataAccess($userAuth , $output = "crossCheckData") {

     $crossCheckData = Access::where('id', $userAuth )->where('page', 'LIKE', "%cross check data%")->first();
        // dd($crossCheckData);
        $getcrossCheckData = empty($crossCheckData)? "kosong" : "ada";
        // dd($getcrossCheckData);
        if ( $getcrossCheckData == "kosong") return $output;
    }

    public static function get_approvalAccess($userAuth , $output = "approvalAccess") {

         $requestApproval = Access::where('id', $userAuth )->where('page', 'LIKE', "%approval%")->first();
        // dd($requestApproval);
        $getrequestApproval = empty($requestApproval)? "kosong" : "ada";
        // dd($getrequestApproval);
        if ( $getrequestApproval == "kosong") return $output;

    }

    public static function get_reportingAccess($userAuth , $output = "reporting") {

         $reportingAccess = Access::where('id', $userAuth )->where('page', 'LIKE', "%reporting%")->first();
        // dd($reportingAccess);
        $getreportingAccess = empty($reportingAccess)? "kosong" : "ada";
        // dd($getreportingAccess);
        if ( $getreportingAccess == "kosong") return $output;

    }

    public static function get_verifikasilogbook($userAuth , $output = "verifikasiLogbook") {
        $verifikasiLogbook = Access::where('id', $userAuth )->where('page', 'LIKE', "%verifikasi upload%")->first();
        // dd($verifikasiLogbook);
        $getverifikasiLogbook = empty($verifikasiLogbook)? "kosong" : "ada";
        // dd($getverifikasiLogbook);
        if ( $getverifikasiLogbook == "kosong") return $output;

    }

    public static function get_reClass($userAuth , $output = "reClass") {
        $reClass = Access::where('id', $userAuth )->where('page', 'LIKE', "%re class%")->first();
        // dd($reClass);
        $getreClass = empty($reClass)? "kosong" : "ada";
        // dd($getreClass);
        if ( $getreClass == "kosong") return $output;

    }

    public static function isActiveRoute($route, $output = "active")
    {

        if (Route::currentRouteName() == $route) return $output;
    }
//     function isActive($path, $class = 'active')
// {
//     return Request::is($path) ? $class : '';
// }
}
