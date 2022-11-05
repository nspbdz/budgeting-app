<?php

namespace App\Http\Controllers\Master;
use App\Http\Controllers\Controller;
use App\Project;
use App\User;
use App\ProjectDetailApproval;
use App\Adp;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DataTables;
use Auth;
use PDF;

use Illuminate\Support\Facades\Hash;

class MasterADPController extends Controller

{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {


        $title = ["Master ADP", "Master ADP", ""];
        $search = $request->search;
        $data = Adp::get();
        // dd($data);

        $data = Adp::
                 where(function($query) use ($search)
                {
                    if ($search) {
                      $query->where('jobname', 'like', '%'.$search.'%')
                    //   ->orWhere('tgl_transaksi', 'like', '%'.$search.'%')
                    //   ->orWhere('keterangan_bl', 'like', '%'.$search.'%')
                      ->orWhere('contractnumber', 'like', '%'.$search.'%');
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

                // ->addColumn('created', function($row){
                // $data = !empty($row->created_at) ? $this->changeDateFormatShort($row->created_at) : "-";
                //     return $data;
                // })

                ->addColumn('action', function($row){

                    $btn = '<a class="edit btn btn-icon btn-info detail-menu-btn" href="' . route('adp.edit', $row['id']) . '" data-toggle="tooltip" data-placement="top" title="Detail Data">
                    <i class="bi bi-pencil-square" aria-hidden="true" id="detailArea"></i></a>';
                    $btn .= '<a class="booton edit btn btn-icon btn-info detail-menu-btn"  data-id="' . $row->id . '" data-toggle="tooltip" data-placement="top" title="Detail Data">
                    <i class="bi-trash" aria-hidden="true" id="detailArea"></i></a>';

                    return $btn;
                  })

                ->rawColumns(['action'])
                ->make(true);
      }
      return view('adp.index',['title' => $title,]);
    }
    public function store(Request $request) {
    // dd($request);
    $today = Carbon::today();
    // dd($this->changeDateFormat($today));
     try{
         if($request->id == null){
           

            $this->validate($request, [
                'namapekerjaan' => 'required',
                'nomorkontrak' => 'required',
                'nilaiadpakhirtahun' => 'required',
                'nilairealisasiadp' => 'required',
                'pic_select' => 'required|not_in:0',
                'formation_select' => 'required|not_in:0',
                

            ]);
        }else{
            $request->validate(
            [
                // 'projectname' => 'required|string|max:155',
            ],
            [
                // 'required' => 'Kolom :attribute tidak boleh kosong.',
                // 'unique' => 'Kolom :attribute sudah terdaftar.'
            ]);
        }
        if($request->id == null){
            $newDivisi = Adp::updateOrInsert([
                'id'   => $request->data_id,
            ],[
           
                'jobname'                => $request->namapekerjaan,
                'contractnumber'                => $request->nomorkontrak,
                'valueadplastyear'                => $request->nilaiadpakhirtahun,
                'adpformationyear'                => $request->formation_select,
                'valueadprealitation'                => $request->nilairealisasiadp,
                'pic'                => $request->pic_select,
                'isactive'            => 1,
                'createdby'           => Auth::id(),
                'created_at'          => $today,
                // 'created_at'  => $this->changeDateFormat($today),
            ]);
        }else{
            $newDivisi = Adp::updateOrInsert([
               'id'           => $request->id
            ],[
                'jobname'                => $request->namapekerjaan,
                'contractnumber'                => $request->nomorkontrak,
                'valueadplastyear'                => $request->nilaiadpakhirtahun,
                'adpformationyear'                => $request->formation_select,
                'valueadprealitation'                => $request->nilairealisasiadp,
                'pic'                => $request->pic_select,
                'updated_at'  => $today,
                'updatedby'   => Auth::id(),
                // 'updated_at'  => $this->changeDateFormat($today),
            ]);

        }

    }catch(Exception $e){
        $msg->sts = 0;
        $msg->msg = $e->getMessage();
        return redirect()->back()
          ->withErrors(['Divisi Gagal Disimpan. ' . $msg->msg])
          ->withInput();
      }
       if ($newDivisi) {
            return redirect()
                ->route('adp.index')
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
      $title = ["Master ADP", "Master ADP", "Tambah Data"];
      $pic=User::where('isactive', '=', 1)->get();
      $formationYears = collect(range(32, 0))->map(function ($item) {
        return (string) date('Y') - $item;
        });
      return view('adp.form',['pic' => $pic,'formationYears' => $formationYears,'title' => $title,]);

    }
    public function show($id) {
        $divisi = $this->getADPById($id);
        return view('adp.show', ['divisi' => $divisi, ]);
    }
    public function edit($id)
    {
        $title = ["Master ADP", "Master ADP", "Edit Data"];
        $pic=User::where('isactive', '=', 1)->get();
        // dd($pic);

        $adpById = $this->getADPById($id);
        // dd($adpById);

        $UserPic = User::
        where([
            ["id", "=",$adpById->pic],
            ["isactive", "=",1],
        ])
        ->first();

        // dd($UserPic);

        // if($UserPic->id == )
        $formationYears = collect(range(32, 0))->map(function ($item) {
            return (string) date('Y') - $item;
        });
        return view('adp.form',['UserPic' => $UserPic,'adpById' => $adpById,'pic' => $pic, 'formationYears' => $formationYears,'title' => $title, ]);
    }


    public function status(Request $request) {
        // dd($request);
        $model = Adp::find($request->id);
            $model['isactive'] = 0;
            $model->updatedby = Auth::id();
            $model->updated_at = Carbon::now();
            $model->save();

            $status  = 200;
            $header  = 'Success';
            $message = 'Adp berhasil di Delete.';
        
        return response()->json([
            'status' => $status,
            'header' => $header,
            'message' => $message
        ]);
    }

    public function exportpdf()
    {
    	// $team = team::all();
        $adp=Adp::select('users.*','adp.*',)
        ->leftjoin('users', 'adp.pic', '=', 'users.id')
        ->get();
        // dd($adp);

        
    	$pdf = PDF::loadview('adp.adp_pdf',['adp'=>$adp]);
    	return $pdf->download('laporan-internal-Order.pdf');
    }
    public function getADPById($id){
        $adp = Adp::find($id);

        return $adp;
      }

      public function changeDateFormat($date){
        return date('d-m-Y H:i:s',strtotime($date));
      }
      public function changeDateFormatShort($date){
        return date('d-m-Y',strtotime($date));
      }

}
