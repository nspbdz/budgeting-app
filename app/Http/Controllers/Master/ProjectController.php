<?php

namespace App\Http\Controllers\Master;
use App\Http\Controllers\Controller;
use App\Project;
use App\User;
use App\ProjectDetailApproval;
use App\Divisi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DataTables;
use Auth;
use PDF;
use Response;

use Illuminate\Support\Facades\Hash;

class ProjectController extends Controller

{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {

        $title = ["Master Project", "Master Project", ""];
        $search = $request->search;
        $data = Project::get();
        // dd($data);

        $data = Project::
                 where(function($query) use ($search)
                {
                    if ($search) {
                      $query->where('projectcode', 'like', '%'.$search.'%')
                    //   ->orWhere('tgl_transaksi', 'like', '%'.$search.'%')
                    //   ->orWhere('keterangan_bl', 'like', '%'.$search.'%')
                      ->orWhere('projectname', 'like', '%'.$search.'%');
                    }
                })

                ->where('isactive',1)
                // ->groupBy('id')
                ->orderBy('id', 'DESC')
                ->get();

        // dd($data);
        if ($request->ajax()) {
          return Datatables::of($data)
                ->addIndexColumn()

                ->addColumn('action', function($row){
                    $btn = '<a class="edit btn btn-icon btn-info detail-menu-btn" href="' . route('project.edit', $row['id']) . '" data-toggle="tooltip" data-placement="top" title="Detail Data">
                    <i class="bi bi-pencil-square" aria-hidden="true" id="detailArea"></i></a>';
                    $btn .= '<a class="booton edit btn btn-icon btn-info detail-menu-btn"  data-id="' . $row->id . '" data-toggle="tooltip" data-placement="top" title="Detail Data">
                    <i class="bi-trash" aria-hidden="true" id="detailArea"></i></a>';
                    return $btn;
                  })

                ->rawColumns(['action'])
                ->make(true);
      }
      return view('project.index',['title' => $title,]);
    }
    public function store(Request $request) {
    // dd($request);

    $today = Carbon::today();
    // dd($this->changeDateFormat($today));
     try{
         if($request->id == null){

            $this->validate($request, [
                "pic_select" =>'required|not_in:0',
                "pembayaran_select" =>'required|not_in:0',
                'projectcode' => 'required',
                'nilaifs' => 'required',
                'subprojectcode' => 'required',
                "tahunfs_select" =>'required|not_in:0',
                "initiativename" => "required",
                "targetlive" => "required",
                "projectname" => "required",
                "tahunalokasianggaran_select" =>'required|not_in:0',
                "alokasianggaran" => "required",
                "targetalokasianggaran" => "required",
            ]);
        }else{
            $request->validate(
            [
                "pic_select" =>'required|not_in:0',
                'nilaifs' => 'required|mimes:pdf,xlsx,csv|max:2048',

                // 'projectname' => 'required|string|max:155',
            ],
            [
                // 'required' => 'Kolom :attribute tidak boleh kosong.',
                // 'unique' => 'Kolom :attribute sudah terdaftar.'
            ]);
        }
        if($request->id == null){

            
            $name = $request->file('nilaifs')->getClientOriginalName();
            $file_name = pathinfo($name, PATHINFO_FILENAME);
            // $path = $request->file('file')->store('public');

            $file = $request->file('nilaifs');
            $extension = $file->getClientOriginalExtension();
            $destination = storage_path('app/public');
            $uniqeName = uniqid() . '.' . $extension;
            $file->move($destination, $uniqeName);
            

            $newProject = Project::updateOrInsert([
            // ['id'               => $request->data_id],
                'id'   => $request->data_id,
            ],[
    
            // "name" => $file_name,
            // "filename" => $uniqeName,
                'projectcode'                => $request->projectcode,
                'projectname'                => $request->projectname,
                'budgetallocation'                => $request->alokasianggaran,
                'initiativename'       => $request->initiativename,
                "subprojectcode"       =>$request->subprojectcode,
                "nilaifs" => $file_name,
                "filenamefs" => $uniqeName,
                "pic" => $request->pic_select,
                "fsyear" => $request->tahunfs_select,
                "targetlive" => $request->targetlive,
                "budgetallocationyear" => $request->tahunalokasianggaran_select,
                "budgetallocationtarget" => $request->targetalokasianggaran,
                "paymentmethode" => $request->pembayaran_select,
                'isactive'            => 1,
                'createdby'           => Auth::id(),
                'created_at'          => $today,
                // 'created_at'  => $this->changeDateFormat($today),
            ]);
        }else{

            // dd($request);

            $newProject = Project::updateOrInsert([
               'id'           => $request->id
            ],[
                'projectcode'                => $request->projectcode,
                'projectname'                => $request->projectname,
                'budgetallocation'                => $request->alokasianggaran,
                'initiativename'       => $request->initiativename,
                "subprojectcode"       =>$request->subprojectcode,
                "pic" => $request->pic_select,
                "fsyear" => $request->tahunfs_select,
                "targetlive" => $request->targetlive,
                "budgetallocationyear" => $request->tahunalokasianggaran_select,
                "budgetallocationtarget" => $request->targetalokasianggaran,
                "paymentmethode" => $request->pembayaran_select,
                'updated_at'  => $today,
                'updatedby'   => Auth::id(),
                // 'updated_at'  => $this->changeDateFormat($today),
            ]);

            if(!empty($request->file())){
            //   dd($request);

                $name = $request->file('nilaifs')->getClientOriginalName();
                $file_name = pathinfo($name, PATHINFO_FILENAME);
                // $path = $request->file('file')->store('public');
    
                $file = $request->file('nilaifs');
                $extension = $file->getClientOriginalExtension();
                $destination = storage_path('app/public/uploads');
                $uniqeName = uniqid() . '.' . $extension;
                $file->move($destination, $uniqeName);
                $newProject = Project::updateOrInsert([
                    'id'           => $request->id
                 ],[
                     "nilaifs" => $file_name,
                     "filenamefs" => $uniqeName,
                 ]);
            }
          

        }

    }catch(Exception $e){
        $msg->sts = 0;
        $msg->msg = $e->getMessage();
        return redirect()->back()
          ->withErrors(['Divisi Gagal Disimpan. ' . $msg->msg])
          ->withInput();
      }
       if ($newProject) {
            return redirect()
                ->route('project.index')
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

    public function create() {
        $title = ["Master Project", "Master Project", "Tambah Data"];
        $user=User::where('isactive', '=', 1)->get();
        // $user=User::select('users.*')
        // ->where('isactive', '=', 1)
        // ->groupBy('users.id')
        // ->get();
        // dd($user);
        $pembayaran=["cash","transfer",];

        $tahunfs = collect(range(32, 0))->map(function ($item) {
            return (string) date('Y') - $item;
            });

        $tahunalokasianggaran = collect(range(32, 0))->map(function ($item) {
            return (string) date('Y') - $item;
            });
        // return view('project.form');
      return view('project.form',[ 'tahunalokasianggaran' => $tahunalokasianggaran,'user' => $user,'tahunfs' => $tahunfs,'pembayaran' => $pembayaran,'title' => $title,]);

    }

    public function show($id) {
        $divisi = $this->getUProjectById($id);
        return view('project.show', ['divisi' => $divisi, ]);
    }

    public function edit($id)
    {
        $title = ["Master Project", "Master Project", "Edit Data"];

        $projectById = $this->getUProjectById($id);
        // dd($projectById);
        $userByProjectId=User::where([
            ['id', '=', $projectById->pic],
            ['isactive', '=', 1]
        ])->first();
        
       
        $user=User::where('isactive', '=', 1)->get();
        // dd($user);
        // dd($user);
        // dd($userByProjectId->id);
        $tahunfs = collect(range(32, 0))->map(function ($item) {
            return (string) date('Y') - $item;
        });
        
        $tahunalokasianggaran = collect(range(32, 0))->map(function ($item) {
            return (string) date('Y') - $item;
        });
        $pembayaran=["cash","transfer",];
        // changeDateFormatShort
        $targetLive=$this->changeDateFormatShort($projectById->targetlive);
        $targetAlokasiAnggaran=$this->changeDateFormatShort($projectById->targetalokasiangaran);
        // targetalokasiangaran

        return view('project.form',[ 'userByProjectId' => $userByProjectId, 'targetAlokasiAnggaran' => $targetAlokasiAnggaran,'targetLive' => $targetLive,'pembayaran' => $pembayaran,'user' => $user,'tahunfs' => $tahunfs,'tahunalokasianggaran' => $tahunalokasianggaran,'title' => $title,'projectById' => $projectById, ]);
    }
    public function exportpdf()
    {
    	$project = Project::all();
        $headers = array(
            'Content-Type: application/pdf',
          );

    	$pdf = PDF::loadview('project.project_pdf',['project'=>$project]);
    	return $pdf->download('laporan-project.pdf', $headers);

        // $file= public_path(). "/download/info.pdf";

        // $headers = array(
        //           'Content-Type: application/pdf',
        //         );
    
        // return Response::download($file, 'filename.pdf', $headers);
    
    }

    public function status(Request $request) {
        // dd($request);
        $model = Project::find($request->id);
            $model['isactive'] = 0;
            $model->updatedby = Auth::id();
            $model->updated_at = Carbon::now();
            $model->save();

            $status  = 200;
            $header  = 'Success';
            $message = 'Project berhasil di Delete.';
        
        return response()->json([
            'status' => $status,
            'header' => $header,
            'message' => $message
        ]);
    }
    public function getUProjectById($id){
        $divisi = Project::find($id);

        return $divisi;
      }

      public function changeDateFormat($date){
        return date('d-m-Y H:i:s',strtotime($date));
      }
      public function changeDateFormatShort($date){
        return date('d-m-Y',strtotime($date));
      }

}
