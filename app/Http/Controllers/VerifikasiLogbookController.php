<?php

namespace App\Http\Controllers;
use App\Project;
use App\User;
use App\ProjectDetail;
use App\InternalOrder;
use App\VerifikasiUpload;
use Illuminate\Support\Facades\Storage;
use Response;
use App\ProjectDetailApproval;
use App\ProjectDetailApprovalHistory;


use Illuminate\Http\Request;
use DataTables;
use Auth;


class VerifikasiLogbookController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        return view('verifikasilogbook.index');

    }
    public function getVerifikasi(Request $request)
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
        // dd($result2);
        return [
            'status' => 200,
            'datatl' => $datatl,
            'datadh' => $datadh,
            'datapnp' => $datapnp,
            'data' => $data
        ];

    }

    public function file($id)
    {
        //  dd($id);
        $dataFile=VerifikasiUpload::where('projectdetailcode', "=", $id)->first();
        $approval = $this->getVerifikasiById($id);

        $data="file";
        return view('verifikasilogbook.file', ['approval' => $approval,'id' => $id,'data' => $data,'dataFile' => $dataFile,]);
    }
    // public function download(){
    //     try{


    //         //  return response()->download(storage_path('app\files\4s65JnpiOeRBbfzCNG1PZaqKuwcWO93UBonZwLKK.xlsx'));

    //         // return storage::disk('local')->download('public/upload/4s65JnpiOeRBbfzCNG1PZaqKuwcWO93UBonZwLKK.xlsx');
    //         // return storage::disk('local')->download('storage/app/public/files/6U3OKh9PCxx2Z7Q1udHg5skZBqTNfYP8CiQuwzjx.txt');
    //         // $path = storage_path('public/' . $filename);

    //         // return response()->download(storage_path('app\WAkU4CSVZSRNHoqABOd79Dq6rN2QYvgNAV9QhqC8.txt'));
    //         return response()->download(storage_path("app/public/WAkU4CSVZSRNHoqABOd79Dq6rN2QYvgNAV9QhqC8.txt"));
    //         // return response()->download(storage_path("app/public/{$filename}"));
    //     }
    //     catch (\Exception $e){
    //         return $e->getMessage();

    //     }

    // }
    public function downloads($file){
        try{
            $dataFile=VerifikasiUpload::where('projectdetailcode', "=", $file)->first();
            // dd($dataFile);
            // return response()->download(storage_path("app/public/WAkU4CSVZSRNHoqABOd79Dq6rN2QYvgNAV9QhqC8.txt"));
            return response()->download(storage_path("app/public/{$dataFile->filename}"));
        }
        catch (\Exception $e){
            return $e->getMessage();

        }

    }
    public function tampilkanfile($file){
        try{
            $dataFile=VerifikasiUpload::where('projectdetailcode', "=", $file)->first();
            // dd($dataFile);
            // return response()->download(storage_path("app/public/WAkU4CSVZSRNHoqABOd79Dq6rN2QYvgNAV9QhqC8.txt"));
            // return response()->file(storage_path("app/public/{$dataFile->filename}"));
            return Response::make(file_get_contents("app/public/{$dataFile->filename}"), 200, [
                // 'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'inline; filename="'.$filename.'"'
            ]);
        }
        catch (\Exception $e){
            return $e->getMessage();

        }

    }

    public function show($id) {
        // dd($id);
        // dd(Auth::id());
        $approval = $this->getVerifikasiById($id);
        $projectById = Project::find($approval->projectcode);
        $ioById = InternalOrder::find($approval->iocode);

        $userNow=User::
        where('id','=', Auth::id())
        // where('id','=', 5)
        ->first();

        $userApproveAs="";

        if($userNow->featuretype == 1 || $userNow->featuretype == 2){
        $userApproveAs=1;
        }else{
            $userApproveAs=3;
        }
        // dd($userApproveAs);

        $statusTl = ProjectDetailApproval::
        where( 'projectdetailid', "=", $id,)
        ->where( 'featuretype', "=", $userNow->featuretype)
        ->whereNotNull('approvalstatus')
        ->get()
        ->toArray();
        // dd($statusTl);

        $statusPnp = ProjectDetailApproval::
        where( 'projectdetailid', "=", $id,)
        ->where( 'featuretype', "=", $userNow->featuretype)
        // ->whereNotNull('approvalstatus')
        ->get()
        ->toArray();

        // dd($statusPnp);

        return view('verifikasilogbook.show', ['userNow' => $userNow,'approval' => $approval,'projectById' => $projectById,'ioById' => $ioById,'statusTl' => $statusTl,'statusPnp' => $statusPnp,'userApproveAs'=> $userApproveAs ]);
    }
    public function pm($id) {
        // dd(Auth::id());
        $pmId=$id;
        $approval = $this->getVerifikasiById($pmId);

        $userNow=User::
        where('id','=', Auth::id())
        // where('id','=', 5)
        ->first();

        $approvalStatus = ProjectDetailApproval::
        where( 'projectdetailid', "=", $id,)
        ->where('approvaltype', 'like', "%{$userNow->getAccess->getRole['name']}%")
        // ->whereNotNull('approvalstatus')
        ->get()
        ->toArray();
        // dd($approvalStatus);

        return view('verifikasilogbook.pm', ['userNow' => $userNow,'pmId' => $pmId,'approval' => $approval,'approvalStatus' => $approvalStatus, ]);

    }
    public function pnp($id) {
        $pnpId=$id;
        $approval = $this->getVerifikasiById($pnpId);

        $userNow=User::
        where('id','=', Auth::id())
        ->first();

        $statusPnp = ProjectDetailApproval::
        where( 'projectdetailid', "=", $id,)
        ->where('approvaltype', 'like', "%{$userNow->getAccess->getRole['name']}%")
        // ->whereNotNull('approvalstatus')
        ->get()
        ->toArray();

        return view('verifikasilogbook.pnp', ['userNow' => $userNow,'pnpId' => $pnpId,'approval' => $approval, 'statusPnp' => $statusPnp, ]);

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



    public function upload($id) {
        $projectDetailId = ProjectDetail::find($id);
        $dataProject = ProjectDetail::with('getUser')
        ->find($id);

        return view('verifikasilogbook.upload', ['projectDetailId' => $projectDetailId,'dataProject' => $dataProject,]);
    }
    public function update($id) {
        $projectDetailId = ProjectDetail::find($id);
        $dataProject = ProjectDetail::with('getUser')
        ->find($id);
        $file=VerifikasiUpload::find($projectDetailId->id);

        return view('verifikasilogbook.upload', ['file' => $file,'projectDetailId' => $projectDetailId,'dataProject' => $dataProject,]);
    }



    public function getVerifikasiById($id){
        $inputProject = ProjectDetail::with('getIO')->find($id);
        return $inputProject;
    }



    public function store(Request $request )
    {
        // dd($id);
        // dd($request);
        try{

         if($request->id == null){


                $this->validate($request, [

                    // 'file' => 'required|mimes:png,jpg,jpeg,csv,txt,xlx,xls,xlsx,pdf|max:2048'
                    // 'file'          => 'required',
                    // 'file' => 'required|mimes:csv,txt,xlx,xls,xlsx,pdf|max:2048',

                ]);
            }else{
                $request->validate(
                [
                    'file' => 'required|mimes:png,jpg,jpeg,csv,txt,xlx,xls,xlsx,pdf|max:2048'

                    // 'nama' => 'required|string|max:155',
                ],
                [
                    // 'required' => 'Kolom :attribute tidak boleh kosong.',
                    // 'unique' => 'Kolom :attribute sudah terdaftar.'
                ]);
            }
                if($request->id == null){

                    $name = $request->file('file')->getClientOriginalName();
                    $file_name = pathinfo($name, PATHINFO_FILENAME);
                    // $path = $request->file('file')->store('public');

                    $file = $request->file('file');
                    $extension = $file->getClientOriginalExtension();
                    $destination = storage_path('app/public');
                    $uniqeName = uniqid() . '.' . $extension;
                    $file->move($destination, $uniqeName);
                    // dd($filename);
                    // $temp = File::firstOrCreate(array('files_name' => $file_name,'path' => $path));
                    // dd($file_name);

                    $newInputProject = VerifikasiUpload::updateOrInsert([
                        'id'           => $request->id
                     ],[
                        "name" => $file_name,
                        "filename" => $uniqeName,
                        "projectdetailcode" => $request->projectdetailid,
                        "createdby"   => Auth::id(),
                        "isactive" =>1,
                    ]);

                // $name = $request->file('file')->getClientOriginalName();
                // // dd($name);
                // $file_name = pathinfo($name, PATHINFO_FILENAME);
                // $path = $request->file('file')->store('public');
                    // dd($file_name);
                // $destination = storage_path('app/public');
                // // $file = request()->file('thumb');
                // // $extension = file->getClientOriginalExtension();
                // // $destination = 'images/';
                // // $filename = uniqid() . '.' . $extension;
                // // $file->move($destination, $filename);
                // dd($destination);

                // $temp = File::firstOrCreate(array('files_name' => $file_name,'path' => $path));
                // dd($file_name);

                // $newInputProject = VerifikasiUpload::updateOrInsert([
                //     'id'           => $request->data_id
                //  ],[
                //     "name" => $file_name,
                //     "filename" => $name,
                //     "projectdetailcode" => $request->projectdetailid,
                //     "createdby"   => Auth::id(),
                //     "isactive" =>1,
                // ]);

            }else{
                dd($request);

                $name = $request->file('file')->getClientOriginalName();
                $file_name = pathinfo($name, PATHINFO_FILENAME);
                // $path = $request->file('file')->store('public');

                $file = $request->file('file');
                $extension = $file->getClientOriginalExtension();
                $destination = storage_path('app/public');
                $uniqeName = uniqid() . '.' . $extension;
                $file->move($destination, $uniqeName);
                // dd($filename);
                // $temp = File::firstOrCreate(array('files_name' => $file_name,'path' => $path));
                // dd($file_name);

                $newInputProject = VerifikasiUpload::updateOrInsert([
                    'id'           => $request->id
                 ],[
                    "name" => $file_name,
                    "filename" => $uniqeName,
                    "projectdetailcode" => $request->projectdetailid,
                    "createdby"   => Auth::id(),
                    "isactive" =>1,
                ]);
            }


        }catch(Exception $e){
            $msg->sts = 0;
            $msg->msg = $e->getMessage();
            return redirect()->back()
              ->withErrors(['File Gagal Disimpan. ' . $msg->msg])
              ->withInput();
          }
           if ($newInputProject) {
                return redirect()
                    ->route('verifikasilogbook.index')
                    ->with([
                        'success' => 'New File has been created successfully'
                    ]);
            } else {
                return redirect()
                    ->back()
                    ->withInput()
                    ->with([
                        'error' => 'Some problem occurred, please try again'
                    ]);
            }


    }
}
