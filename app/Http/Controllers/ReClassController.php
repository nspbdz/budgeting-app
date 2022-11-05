<?php

namespace App\Http\Controllers;
use App\Project;
use App\ProjectDetail;
use App\ProjectDetailApproval;


use Illuminate\Http\Request;
use DataTables;
use Auth;


class ReClassController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        return view('reclass.index');

    }
    public function getReClass(Request $request)
    {
        $title = ["Reclass", "Reclass", ""];

        $search = $request->search;
        $data = ProjectDetail::
        with("getProject")
        ->get();


        $result  = null;
        $j= 0;

        $datatl[$j]['tl']  = 0;
        $datadh[$j]['dh']  = 0;
        $datapnp[$j]['pnp']  = 0;
        foreach($data  as $item){   

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
        // dd($datatl);
        // dd($datadh);
        return [
            'status' => 200,
            'datatl' => $datatl,
            'datadh' => $datadh,
            'datapnp' => $datapnp,
            'data' => $data
        ];
    }


    public function filter(Request $request)
    {
        $search=$request->title;
    }
    public function status(Request $request) {

        $model = ProjectDetailApproval::find($request->id);
        if ($model->isactive == "1") {
            $model->isactive = "0";
            $model->notes =$request->input;
            // $model->updatedby = Auth::id();
            // $model->modifiedon = Carbon::now();
            $model->save();

            $status  = 200;
            $header  = 'Success';
            $message = 'Menu berhasil di non-aktifkan.';
        } else {
            $model->isactive = "0";
            // $model->updatedby = Auth::id();
            // $model->modifiedon = Carbon::now();
            $model->save();

            $status  = 200;
            $header  = 'Success';
            $message = 'Menu berhasil di aktifkan.';
        }
        return response()->json([
            'status' => $status,
            'header' => $header,
            'message' => $message
        ]);
    }




}
