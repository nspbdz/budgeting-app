<?php

namespace App\Http\Controllers;
use App\Project;
use App\User;
use App\ProjectDetail;
use App\InternalOrder;

use App\ProjectDetailApproval;
use App\ProjectDetailApprovalHistory;


use Illuminate\Http\Request;
use DataTables;
use Auth;
use Carbon\Carbon;


class ApprovalController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        return view('approval.index');

    }
    public function getApproval(Request $request)
    {
        $title = ["Report", "Report", ""];

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
            $roletl = ProjectDetailApproval::select('userid','approvaltype','approvalstatus')
            ->where('projectdetailid', '=', $item->id)
            ->where('approvaltype', '=', "pm-tl")
            ->get();
            if( $roletl == null){
             $datatl[$j]['tl'] ="";
            }
             $datatl[$j]['tl'] = $roletl;
            //  dh
             $roledh = ProjectDetailApproval::select('userid','approvaltype','approvalstatus')
             ->where('projectdetailid', '=', $item->id)
            ->where('approvaltype', '=', "pm-dh")
             ->get();
             if( $roledh == null){
              $datadh[$j]['dh'] ="";
             }
              $datadh[$j]['dh'] = $roledh;

            //   pnp
              $rolepnp = ProjectDetailApproval::select('userid','approvaltype','approvalstatus')
              ->where('projectdetailid', '=', $item->id)
              ->where('approvaltype', '=', "pnp-tl")
              ->get();
              if( $rolepnp == null){
               $datapnp[$j]['pnp'] ="";
              }
               $datapnp[$j]['pnp'] = $rolepnp;


            // print_r($data2);
            $j++;

        }
        // dd($result2);
        return [
            'status' => 200,
            'datatl' => $datatl,
            'datadh' => $datadh,
            'datapnp' => $datapnp,
            'data' => $data
        ];

    }

    public function downloads($file){
        try{
            $dataFile=VerifikasiUpload::where('projectdetailcode', "=", $file)->first();
            dd($dataFile);
            // return response()->download(storage_path("app/public/WAkU4CSVZSRNHoqABOd79Dq6rN2QYvgNAV9QhqC8.txt"));
            return response()->download(storage_path("app/public/{$dataFile->filename}"));
        }
        catch (\Exception $e){
            return $e->getMessage();

        }

    }

    public function show($id) {
        // dd(Auth::id());
        $approval = $this->getApprovalById($id);
        // dd($approval->lastapprovalstatus);
        $projectById = Project::find($approval->projectcode);
        $ioById = InternalOrder::find($approval->iocode);

        $userNow=User::with('getAccess','getAccess.getRole')
        ->where('id','=', Auth::id())
        // where('id','=', 5)
        ->first();
        // dd($userNow->getAccess->getRole['name']);
        // dd($userNow);

        $approvalStatusBtn = ProjectDetailApproval::
        where( 'projectdetailid', "=", $id,)
        ->where('approvaltype', 'like', "%{$userNow->getAccess->getRole['name']}%")
        // ->whereNotNull('approvalstatusPmTl')
        ->get()
        ->toArray();


        $approvalStatusPmDh = ProjectDetailApproval::
        where( 'projectdetailid', "=", $id,)
        ->where('approvaltype', 'like', "%pm-tl%")
        // ->whereNotNull('approvalstatusPmDh')
        ->first();
        // ->toArray();
        // dd($approvalStatusPmDh);


    //   pnp
        $approvalStatusPnpPmTl = ProjectDetailApproval::
        where( 'projectdetailid', "=", $id,)
        ->where('approvaltype', 'like', "%pm-tl%")
        // ->where('crosscheck', '=', 1)
        ->get()
        ->toArray();
        // dd(count($approvalStatusPnpPmTl));

        $approvalStatusPnpPmDh = ProjectDetailApproval::
        where( 'projectdetailid', "=", $id,)
        ->where('approvaltype', 'like', "%pm-dh%")
        // ->where('crosscheck', '=', 1)
        ->get()
        ->toArray();
        // dd(count($approvalStatusPnpPmDh));
    //   pnp

        $pnpNavigation = $approval->crosscheckby;
        //perlu if bagian  approvalStatusPnpPmDh  approvalStatusPnpPmTl
        // dd($pnpNavigation);

        $approvalStatusReject=$approval->lastapprovalstatus;
        // dd($approval->lastapprovalstatus);


        return view('approval.show', [ 'approvalStatusReject' => $approvalStatusReject,'approvalStatusPnpPmTl' => $approvalStatusPnpPmTl,'approvalStatusPnpPmDh' => $approvalStatusPnpPmDh,'approvalStatusPmDh' => $approvalStatusPmDh,'approvalStatusBtn' => $approvalStatusBtn,'pnpNavigation' => $pnpNavigation,'userNow' => $userNow,'approval' => $approval,'projectById' => $projectById,'ioById' => $ioById,  ]);
    }

    public function pm($id) {
        // dd(Auth::id());
        $pmId=$id;
        $approval = $this->getApprovalById($pmId);

        $userNow=User::
        where('id','=', Auth::id())
        // where('id','=', 5)
        ->first();

        $approvalStatusBtn = ProjectDetailApproval::
        where( 'projectdetailid', "=", $id,)
        ->where('approvaltype', 'like', "%{$userNow->getAccess->getRole['name']}%")
        // ->whereNotNull('approvalstatusPmTl')
        ->get()
        ->toArray();

        $approvalStatusPmDh = ProjectDetailApproval::
        where( 'projectdetailid', "=", $id,)
        ->where('approvaltype', 'like', "%pm-tl%")
        // ->whereNotNull('approvalstatusPmDh')
        ->first();
        // ->toArray();
        // dd($approvalStatusPmDh);
        // dd(count($approvalStatusPmDh));
        return view('approval.pm', ['userNow' => $userNow,'pmId' => $pmId,'approval' => $approval,'approvalStatusPmDh' => $approvalStatusPmDh,'approvalStatusBtn' => $approvalStatusBtn, ]);

    }
    public function pnp($id) {
        $pnpId=$id;
        $approval = $this->getApprovalById($pnpId);

        $userNow=User::
        where('id','=', Auth::id())
        ->first();

        $statusPnpPmTl = ProjectDetailApproval::
        where( 'projectdetailid', "=", $id,)
        ->where('approvaltype', 'like', "%pm-tl%")
        // ->where('crosscheck', '=', 1)
        ->get()
        ->toArray();

        $statusPnpPmDh = ProjectDetailApproval::
        where( 'projectdetailid', "=", $id,)
        ->where('approvaltype', 'like', "%pm-dh%")
        // ->where('crosscheck', '=', 1)
        ->get()
        ->toArray();

        $approvalStatusBtn = ProjectDetailApproval::
        where( 'projectdetailid', "=", $id,)
        ->where('approvaltype', 'like', "%{$userNow->getAccess->getRole['name']}%")
        // ->whereNotNull('approvalstatusPmTl')
        ->get()
        ->toArray();
        // dd(count($statusPnpPmTl));
        // dd($statusPnpPmDh);


        return view('approval.pnp', ['userNow' => $userNow,'pnpId' => $pnpId,'approval' => $approval, 'approvalStatusBtn' => $approvalStatusBtn, 'statusPnpPmTl' => $statusPnpPmTl,'statusPnpPmDh' => $statusPnpPmDh, ]);

    }
    public function getPm(Request $request, $id) {

        $title = ["Report", "Report", ""];

        $data = ProjectDetail::
        with('getUser')
        ->where("id", "=", $id)
        ->first();
        // dd($data);

        $result  = null;
        $j= 0;

        $datatl[$j]['tl']  = 0;
        $datadh[$j]['dh']  = 0;

            // untuk tl
            $roletl = ProjectDetailApproval::select('userid','projectdetailid','approvaltype','approvalstatus','approvaldate')
            ->where('projectdetailid', '=', $data->id)
            ->where('approvaltype', '=', "pm-tl")
            ->get();
            if( $roletl == null){
             $datatl[$j]['tl'] ="";
            }
             $datatl[$j]['tl'] = $roletl;
            //  dh
             $roledh = ProjectDetailApproval::select('userid','projectdetailid','approvaltype','approvalstatus','approvaldate')
             ->where('projectdetailid', '=', $data->id)
             ->where('approvaltype', '=', "pm-dh")
             ->get();
             if( $roledh == null){
              $datadh[$j]['dh'] ="";
             }
              $datadh[$j]['dh'] = $roledh;

            $j++;

        return [
            'status' => 200,
            'datatl' => $datatl,
            'datadh' => $datadh,
            'data' => $data
        ];
    }

    public function getPnp(Request $request, $id) {
         $title = ["Report", "Report", ""];
        $data = ProjectDetail::
        with('getUser')
        ->where("id", "=", $id)
        ->first();
        // dd($data);

        $result  = null;
        $j= 0;

        $datapnp[$j]['pnp']  = 0;

            //   pnp
              $rolepnp = ProjectDetailApproval::select('userid','projectdetailid','approvaltype','approvalstatus','approvaldate')
              ->where('projectdetailid', '=', $data->id)
             ->where('approvaltype', '=', "pnp-tl")
              ->get();
              if( $rolepnp == null){
               $datapnp[$j]['pnp'] ="";
              }
               $datapnp[$j]['pnp'] = $rolepnp;
            $j++;

        return [
            'status' => 200,
            'datapnp' => $datapnp,
            'data' => $data
        ];
    }




    public function approve(Request $request) {
        // dd($request);
        $dataProject = ProjectDetail::with('getUser')
        ->find($request->id);
        $today = Carbon::today();

        $userNow=User::with('getAccess','getAccess.getRole')
        ->where('id','=', Auth::id())
        ->first();
        // dd($userNow);
        if($request->input == null){

        $temp = ProjectDetailApproval::firstOrCreate([
            'projectdetailid' => $request->id,
            'approvaltype' => $userNow->getAccess->getRole['name'],
            'userid' => $userNow->id,
            'approvalstatus' => 1
        ]);

        ProjectDetailApprovalHistory::insert([
            'projectdetailid' => $request->id,
            'approvaltype' => $userNow->approvaltype,
            'userid' => $userNow->id,
            'approvalstatus' => 1
        ]);
        $lastProjectDetail = ProjectDetail::updateOrInsert([
            'id'                   => $request->id
         ],[
            'lastapprovalby' =>Auth::id(),
             'lastapprovalstatus'       => 1,
             'updated_at'  => Carbon::today(),
             'lastapprovaldate'  => Carbon::today(),
             'updatedby'  => Auth::id(),
             // 'updated_at'  => $this->changeDateFormat($today),

         ]);
            $status  = 200;
            $header  = 'Success di Approve';
            $message = ' berhasil.';

        }else{
        $temp = ProjectDetailApproval::firstOrCreate([
            'projectdetailid' => $request->id,
            'approvaltype' => $userNow->approvaltype,
            'userid' => $userNow->id,
            'notes' => $request->input,
            'approvalstatus' => 0
        ]);

        ProjectDetailApprovalHistory::insert([
            'projectdetailid' => $request->id,
            'approvaltype' => $userNow->approvaltype,
            'userid' => $userNow->id,
            'notes' => $request->input,
            'approvalstatus' => 0
        ]);
        $lastProjectDetail = ProjectDetail::updateOrInsert([
            'id'                   => $request->id
         ],[
            'lastapprovalby' => Auth::id(),
             'lastapprovalstatus'       => 1,
             'updated_at'  => Carbon::today(),
             'lastapprovaldate'  => Carbon::today(),
             'updatedby'  => Auth::id(),
            'lastapprovalnotes' => $request->input,

             // 'updated_at'  => $this->changeDateFormat($today),

         ]);
         dd($lastProjectDetail);
        $status  = 200;
        $header  = 'Success di Reject';
        $message = ' berhasil.';

    }
        return response()->json([
            'status' => 200,
            'header' => $header,
            'message' => $message

        ]);
    }

    public function getApprovalById($id){
        $inputProject = ProjectDetail::with('getIO')->find($id);
        return $inputProject;
    }

    public function updateApproval(Request $request) {
        // dd($request);
        $model = ProjectDetailApproval::find($request->id);
        if ($model->approvalstatus == "1") { 
            $model->approvalstatus = "0";
            $model->notes =$request->input;
            // $model->updatedby = Auth::id();
            // $model->modifiedon = Carbon::now();
            $model->save();

            $status  = 200;
            $header  = 'Success';
            $message = ' berhasil';
        } else {
            $model->approvalstatus = "0";
            // $model->updatedby = Auth::id();
            // $model->modifiedon = Carbon::now();
            $model->save();

            $status  = 200;
            $header  = 'Success';
            $message = ' berhasil.';
        }
        return response()->json([
            'status' => $status,
            'header' => $header,
            'message' => $message
        ]);
    }

}
