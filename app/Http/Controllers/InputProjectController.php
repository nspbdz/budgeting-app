<?php

namespace App\Http\Controllers;

use App\Project;
use App\ProjectDetail;
use PDF;

use App\InternalOrder;
use App\Exports\InputProjectExport;
use Maatwebsite\Eootxcel\Facades\Excel;
use App\User;
use App\ProjectDetailApproval;
use App\Divisi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DataTables;
use Auth;
use Illuminate\Support\Facades\Hash;

class InputProjectController extends Controller

{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function cetak_pdf()
    {
    	$pegawai = ProjectDetail::all();

    	$pdf = PDF::loadview('inputprojects.projectpdf',['pegawai'=>$pegawai]);
    	return $pdf->download('project-inputan-pdf');
    }

    public function export_excel()
	{
		return Excel::download(new InputProjectExport, 'InputProjectExport.xlsx');
	}

    public function index(Request $request)
    {


        $title = ["Master Project", "Master Project", ""];
        $search = $request->search;
        // $data = ProjectDetail::with('getProjectDetail')->get();

        // dd($data);

        $data = ProjectDetail::
                    where(function($query) use ($search)
                {
                    if ($search) {
                      $query->where('projectcode', 'like', '%'.$search.'%')
                    //   ->orWhere('tgl_transaksi', 'like', '%'.$search.'%')
                    //   ->orWhere('keterangan_bl', 'like', '%'.$search.'%')
                      ->orWhere('name', 'like', '%'.$search.'%');
                    }
                })

                // ->where('jenis_transaksi',1)
                // ->groupBy('id')
                ->orderBy('id', 'DESC')
                ->get();

        // dd($data);
        if ($request->ajax()) {
          return Datatables::of($data)
                ->addIndexColumn()

                ->addColumn('action', function($row){

                    $btn = '<a class="edit btn btn-icon btn-info detail-menu-btn" style="padding:5px; margin-left:5px;" href="' . route('inputproject.edit', $row['id']) . '" data-toggle="tooltip" data-placement="top" title="Detail Data">
                    <i class="bi bi-pencil-square" aria-hidden="true" id="detailArea"></i></a>';
                    $btn .= '<a class="edit btn btn-icon btn-info detail-menu-btn" style="padding:5px; margin-left:5px;" href="' . route('inputproject.show', $row['id']) . '" data-toggle="tooltip" data-placement="top" title="Detail Data">
                                           <i class="bi-trash" aria-hidden="true" id="detailArea"></i></a>';

                    $btn .= '<a class="edit btn btn-icon btn-info detail-menu-btn" style="padding:5px; margin-left:5px;" href="' . route('inputproject.show', $row['id']) . '" data-toggle="tooltip" data-placement="top" title="Detail Data">
                                           <i class="bi-eye" aria-hidden="true" id="detailArea"></i></a>';
                    return $btn;
                  })
                ->addColumn('lastStatus', function($row){
                    // dd($row->id);
                    $approval=ProjectDetailApproval::where('projectdetailid', '=',$row->lastapprovalstatus)->get();
                    // dd(count($approval));
                    $status="";
                    if(count($approval)==0){
                        $status="waiting Pm-Tl";
                    }else if(count($approval)==1){
                        // dd($approval[0]->userid);
                        $userNow=User::with('getAccess','getAccess.getRole')
                        ->where('id','=', $approval[0]->userid)->first();
                        // dd($userNow->getAccess->getRole['name']);
                         if($userNow->getAccess->getRole['name']=="pm-tl"){
                            $status="waiting Pm-Dh";
                        }else if($userNow->getAccess->getRole['name']=="pm-dh"){
                            $status="waiting Pnp-Tl";
                        }else{
                            $status="Approve";
                          }
                    }else if(count($approval) > 1){
                        // dd("asdsa");
                        foreach($approval as $item){
                            // dd($item['userid']);

                            $userNow=User::with('getAccess','getAccess.getRole')
                            ->where('id','=', $item['userid'])->first();

                            if($userNow->getAccess->getRole['name']=="pm-dh"){
                                $status="waiting Pnp-Tl";
                            }
                            if($userNow->getAccess->getRole['name']=="pm-tl"){
                                $status="waiting pm-dh";
                            }
                            if($userNow->getAccess->getRole['name']=="pnp-tl"){
                                $status="approve";
                            }
                            // dd($userNow);
                        }
                    }
                    return $status;

                })

                ->rawColumns(['action','lastStatus'])
                ->make(true);
      }
      return view('inputprojects.index',['title' => $title,]);
    }


    public function create() {
      $title = ["Master Project", "Master Project", "Tambah Data"];
      $projectCode = Project::get();
      $ioCode = InternalOrder::get();
        // return view('project.form');
      return view('inputprojects.form',['title' => $title,'projectCode' => $projectCode,'ioCode' => $ioCode,]);

    }

    public function show($id) {
        $inputProject = $this->getInputProjectById($id);
        // dd($inputProject);
        return view('inputprojects.show', ['inputProject' => $inputProject, ]);
    }
    public function history($id) {
        $inputProject = Project::with('getProjectDetail','getIO')->find($id);

        $inputProject = $this->getInputProjectById($id);
        // dd(inputProject);
        return view('inputprojects.history', ['inputProject' => $inputProject, ]);
    }

    public function edit($id)
    {
        $title = ["Master Project", "Master Project", "Edit Data"];

        // $inputProject = $this->getInputProjectById($id);
        $inputProject = ProjectDetail::find($id);

        $projectById = Project::find($inputProject->projectcode);
        $ioById = InternalOrder::find($inputProject->iocode);

        // dd($inputProject);
        return view('inputprojects.form',['title' => $title,'inputProject' => $inputProject,'projectById' => $projectById,'ioById' => $ioById, ]);
    }

    public function store(Request $request) {
        // dd($request);
        $today = Carbon::today();
        // dd($this->changeDateFormat($today));
         try{

            if($request->idProject == "buat"){

                $this->validate($request, [
                    'project_select' => 'required|not_in:0',
                    'io_select' => 'required|not_in:0',
                    'nama' => 'required',
                    'namainisiatif' => 'required',
                    "vendorname" => 'required',
                    "jobdetail" => "required",
                    "kontraknumber" => "required",
                    "budgetallocation" => "required",
                    'bastno' => 'required',
                    'sppno' => 'required',
                    'qtyupload' => 'required',
                    'totalupload' => 'required',
                    'noformrequest' => 'required',
                    'note' => 'required',
                    'requestuploadfrom' => 'required',
                    'notano' => 'required',
                    'file' => 'required|mimes:png,jpg,jpeg,csv,txt,xlx,xls,xlsx,pdf|max:2048'
                    // 'file'          => 'required',
                    //  'extension'      => 'required|in:doc,csv,xlsx,xls,docx,ppt,odt,ods,odp',
                    // 'file' => 'required|mimes:csv,txt,xlx,xls,xlsx,pdf|max:2048',

                ]);
            }else{
                $request->validate(
                [
                    // 'nama' => 'required|string|max:155',
                ],
                [
                    // 'required' => 'Kolom :attribute tidak boleh kosong.',
                    'unique' => 'Kolom :attribute sudah terdaftar.'
                ]);
            }
            if($request->idProject == "buat"){
                $name = $request->file('file')->getClientOriginalName();
                $file_name = pathinfo($name, PATHINFO_FILENAME);
                $path = $request->file('file')->store('public/files');
                // $temp = File::firstOrCreate(array('files_name' => $file_name,'path' => $path));
                // dd($file_name);

                $newInputProject = ProjectDetail::updateOrInsert([
                    'id'           => $request->data_id
                 ],[
                    "file" => $file_name,
                    "projectcode"     =>$request->project_select,
                    "iocode"     =>$request->io_select,
                    "projectname"     =>$request->nama,
                    "initiativename"     =>$request->namainisiatif,
                    "vendorname" => $request->vendorname,
                    "jobdetail" => $request->jobdetail,
                    "kontraknumber" => $request->kontraknumber,
                    "budgetallocation" => $request->budgetallocation,
                    "bastno"     =>$request->bastno,
                    "sppno"   =>$request->sppno,
                    "qtyupload"   =>$request->qtyupload,
                    "totalupload"   =>$request->totalupload,
                    "noformrequest"   =>$request->noformrequest,
                    "note" =>$request->note,
                    "requestuploadfrom"   =>$request->requestuploadfrom,
                    "notano"   =>$request->notano,
                    "isactive"     =>1,

                    // "masterasset"   =>$request->masterasset,
                    // "updated_at"  => $today,
                    "createdby"   => Auth::id(),
                ]);

            }else{

                $name = $request->file('file')->getClientOriginalName();
                $file_name = pathinfo($name, PATHINFO_FILENAME);
                $path = $request->file('file')->store('public/files');
                $newInputProject = ProjectDetail::updateOrInsert([
                    'id'           => $request->idDetail
                 ],[
                    "file" => $file_name,

                    // "vendorname" => $request->vendorname,
                    // "jobdetail" => $request->jobdetail,
                    // "kontraknumber" => $request->kontraknumber,
                    // "budgetallocation" => $request->budgetallocation,
                    // "bastno"     =>$request->bastno,
                    // "sppno"   =>$request->sppno,
                    // "qtyupload"   =>$request->qtyupload,
                    // "totalupload"   =>$request->totalupload,
                    // "noformrequest"   =>$request->noformrequest,
                    // "note" =>$request->note,
                    // "requestuploadfrom"   =>$request->requestuploadfrom,
                    // "notano"   =>$request->notano,
                    // "masterasset"   =>$request->masterasset,
                    "updated_at"  => $today,
                    "updatedby"   => Auth::id(),
                    // "isactive"     =>1,
                     // 'updated_at'  => $this->changeDateFormat($today),
                 ]);

            }
            // if($request->idProject == "buat"){
            //     // $CodeProjectId = Project::where('projectcode', '=', $request->projectcode)->first();
            //     // dd($CodeProjectId->id);

            //     $newInputProject = ProjectDetail::updateOrInsert([
            //         'id'           => $request->data_id
            //      ],[
            //         "projectcode"     =>$request->project_select,
            //         "iocode"     =>$request->io_select,
            //         "projectname"     =>$request->nama,
            //         "initiativename"     =>$request->namainisiatif,
            //         "bastno"     =>$request->bastno,
            //         "sppno"   =>$request->sppno,
            //         "projectid"   =>$CodeProjectId->id,
            //         "qtyupload"   =>$request->qtyupload,
            //         "totalupload"   =>$request->totalupload,
            //         "noformrequest"   =>$request->noformrequest,
            //         "note" =>$request->note,
            //         "requestuploadfrom"   =>$request->requestuploadfrom,
            //         "notano"   =>$request->notano,
            //         // "updated_at"  => $today,
            //         // "updatedby"   => Auth::id(),
            //      ]);

            // }

                // dd($CodeProjectId);

        }catch(Exception $e){
            $msg->sts = 0;
            $msg->msg = $e->getMessage();
            return redirect()->back()
              ->withErrors(['Divisi Gagal Disimpan. ' . $msg->msg])
              ->withInput();
          }
           if ($newInputProject) {
                return redirect()
                    ->route('inputproject.index')
                    ->with([
                        'success' => 'New Divisi has been created successfully'
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
    public function getInputProjectById($id){
        $inputProject = ProjectDetail::with('getIO','getProject')->find($id);
        // $data = Project::with('getProjectDetail')->get();


        return $inputProject;
      }

      public function changeDateFormat($date){
        return date('d-m-Y H:i:s',strtotime($date));
      }
      public function changeDateFormatShort($date){
        return date('d-m-Y',strtotime($date));
      }

}

// request
             // "namaPekerjaan" => "galang dana update"
            //  "namainisiatif" => "galang dana update"
            // "code"   =>$request->code,
            // "bastno"
            // "sppno"
            // "code"
            // "qtyupload"
            // "internalOrder"
            // "totalupload"
            // "noformrequest"
            // "note"
            // "requestuploadfrom"
            // "notano"
