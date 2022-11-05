<?php

namespace App\Http\Controllers;
use App\Project;
use App\ProjectDetail;
use App\ProjectDetailApproval;
use Carbon\Carbon;


use Illuminate\Http\Request;
use DataTables;
use Auth;


class CrossCheckDataController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        return view('crosscheckdatas.index');

    }
    public function getReporting(Request $request)
    {
        $title = ["Report", "Report", ""];

        $search = $request->search;
        $data = ProjectDetail::
        with("getProject")
        ->get();
        // dd($data);
        $result  = null;
        $j= 0;

        $datatl[$j]['tl']  = 0;
        $datadh[$j]['dh']  = 0;
        $datapnp[$j]['pnp']  = 0;
        $slideStatus="";
        // dd($slideStatus);
        foreach($data  as $item){

            if ($item->crosscheck == 1) {
                $slideStatus = '<div class="custom-control custom-switch">
                <input  type="checkbox" class="custom-control-input switchStatus" data-toogle="active" data-id="' . $item->id . '" id="switchMenu' . $item->id . '" checked>
                <label class="custom-control-label" for="switchMenu' . $item->id . '"></label>
                </div>';
              }elseif ($item->crosscheck == 0) {
                $slideStatus = '<div class="custom-control custom-switch">
                <input type="checkbox" class="custom-control-input switchStatus" data-toogle="inactive" data-id="' . $item->id . '" id="switchMenu' . $item->id . '">
                <label class="custom-control-label" for="switchMenu' . $item->id . '"></label>
                </div>';
              }else{
                    $slideStatus = '<div class="custom-control custom-switch">
                    <input type="checkbox" class="custom-control-input switchStatus" data-toogle="inactive" data-id="' . $item->id . '" id="switchMenu' . $item->id . '">
                    <label class="custom-control-label" for="switchMenu' . $item->id . '"></label>
                    </div>';
              }

            // untuk tl
            $roletl = ProjectDetailApproval::select('userid','featuretype','approvalstatus')
            ->where('projectdetailid', '=', $item->id)
            ->where('featuretype', '=', 1)
            ->get();

            if( $roletl == null){
             $datatl[$j]['tl'] ="";
            }
             $datatl[$j]['tl'] = $roletl;
            //  dh
             $roledh = ProjectDetailApproval::select('userid','featuretype','approvalstatus')
             ->where('projectdetailid', '=', $item->id)
             ->where('featuretype', '=', 2)
             ->get();
             if( $roledh == null){
              $datadh[$j]['dh'] ="";
             }
              $datadh[$j]['dh'] = $roledh;

            //   pnp
              $rolepnp = ProjectDetailApproval::select('userid','featuretype','approvalstatus')
              ->where('projectdetailid', '=', $item->id)
              ->where('featuretype', '=', 3)
              ->get();
              if( $rolepnp == null){
               $datapnp[$j]['pnp'] ="";
              }
               $datapnp[$j]['pnp'] = $rolepnp;


            // print_r($data2);
            $j++;

        }
        return [
            'status' => 200,
            'datatl' => $datatl,
            'datadh' => $datadh,
            'datapnp' => $datapnp,
            'data' => $data,
            // 'action' => $action,
            'slideStatus' => $slideStatus
        ];
    }


    public function filter(Request $request)
    {
        $search=$request->title;
    }
    public function status(Request $request) {

        $model = ProjectDetail::find($request->id);
        if ($model->crosscheck == null || $model->crosscheck == 0 ) {
            $model->crosscheck = "1";
            $model->crosscheckby = Auth::id();
            $model->crosscheckdate = Carbon::now();
            $model->save();

            $status  = 200;
            $header  = 'Success';
            $message = 'Menu berhasil di aktifkan.';

        } else {
            $model->crosscheck = "0";
            $model->crosscheckby = Auth::id();
            $model->crosscheckdate = Carbon::now();
            $model->save();

            $status  = 200;
            $header  = 'Success';
            $message = 'Menu berhasil di non-aktifkan.';
        }
        return response()->json([
            'status' => $status,
            'header' => $header,
            'message' => $message
        ]);
    }




}
