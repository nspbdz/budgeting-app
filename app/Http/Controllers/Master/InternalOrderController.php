<?php

namespace App\Http\Controllers\Master;
use App\Http\Controllers\Controller;

use App\Project;
use App\User;
use App\ProjectDetailApproval;
use App\Divisi;
use App\InternalOrder;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DataTables;
use Auth;
use PDF;

use Illuminate\Support\Facades\Hash;


class InternalOrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {


        $title = ["Internal Order", "Internal Order", ""];
        $search = $request->search;
        $data = Internalorder::with('getProject')->get();
        // dd($data);

        $data = Internalorder::with('getProject')
                 ->where(function($query) use ($search)
                {
                    if ($search) {
                      $query->where('name', 'like', '%'.$search.'%')
                    //   ->orWhere('tgl_transaksi', 'like', '%'.$search.'%')
                    //   ->orWhere('keterangan_bl', 'like', '%'.$search.'%')
                      ->orWhere('name', 'like', '%'.$search.'%');
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

                    $btn = '<a class="edit btn btn-icon btn-info detail-menu-btn" href="' . route('internalorder.edit', $row['id']) . '" data-toggle="tooltip" data-placement="top" title="Detail Data">
                    <i class="bi bi-pencil-square" aria-hidden="true" id="detailArea"></i></a>';
                    $btn .= '<a class="booton edit btn btn-icon btn-info detail-menu-btn"  data-id="' . $row->id . '" data-toggle="tooltip" data-placement="top" title="Detail Data">
                    <i class="bi-trash" aria-hidden="true" id="detailArea"></i></a>';
                   
                    return $btn;
                  })


                ->rawColumns(['action'])
                ->make(true);
      }
      return view('internalorders.index',['title' => $title,]);
}
    public function store(Request $request) {
    // dd($request);
    $today = Carbon::today();
    // dd($today);
     try{
         if($request->id == null){
            $this->validate($request, [
                // '' => 'required',
                "projectCode_select" =>'required|not_in:0',
                'namaio' => 'required|unique:internalorder,name',

            ]);
        }else{
            $request->validate(
            [
                "projectCode_select" =>'required|not_in:0',

                // 'name' => 'required|string|max:155',
            ],
            [
                // 'required' => 'Kolom :attribute tidak boleh kosong.',
                // 'unique' => 'Kolom :attribute sudah terdaftar.'
            ]);
        }
        if($request->id == null){
            $newIO = InternalOrder::updateOrInsert([
                'id'   => $request->data_id,
            ],[
                
                'projectid'       => $request->projectCode_select,
                'name'       => $request->namaio,
                'isactive'       => 1,
                'createdby'  => Auth::id(),
                'created_at'  => $today,

            ]);

        }else{

            $dataIO=InternalOrder::where('id', '=', $request->id)->first();
            // $dataIO = InternalOrder::where('id', '=', $dataProjectIO->iocode)->first();

            $newIO = InternalOrder::updateOrInsert([
               'id'                   => $dataIO->id
            ],[
                'projectid'       => $request->projectCode_select,
                'name'       => $request->namaio,
                'updated_at'  => $today,
                'updatedby'  => Auth::id(),
                // 'updated_at'  => $this->changeDateFormat($today),

            ]);
        }

    }catch(Exception $e){
        $msg->sts = 0;  
        $msg->msg = $e->getMessage();
        return redirect()->back()
          ->withErrors(['internal Order Gagal Disimpan. ' . $msg->msg])
          ->withInput();
      }
       if ($newIO) {
            return redirect()
                ->route('internalorder.index')
                ->with([
                    'success' => 'New internal Order has been created successfully'
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
        $title = ["internal Order", "internal Order", "Create Data"];
        $projectCode = Project::where('isactive', '=', 1)->get();
        $tahunfs = collect(range(32, 0))->map(function ($item) {
            return (string) date('Y') - $item;
            });
        return view('internalorders.form',['tahunfs' => $tahunfs,'projectCode' => $projectCode,'title' => $title, ]);
    }

    public function show($id) {
        $internalOrder = $this->getIOById($id);
        return view('internalorders.show', ['internalOrder' => $internalOrder, ]);
    }

    public function edit($id)
    {
        $title = ["internal Order", "internal Order", "Edit Data"];
        $IOById = $this->getIOById($id);
        // $ProjectByIO=Project::where("id", "=",$IOById->projectid)->first();
        $ProjectByIO=Project::where([
            ["id", "=",$IOById->projectid],
            ["isactive", "=",1]
        ])->first();
            // dd($ProjectByIO);
        $project = Project::where('isactive', '=', 1)->get();
            // dd($project);
        return view('internalorders.form',['ProjectByIO' => $ProjectByIO,'IOById' => $IOById,'project' => $project,'title' => $title ]);
    }

    public function status(Request $request) {
        // dd($request);
        $model = InternalOrder::find($request->id);
            $model['isactive'] = 0;
            $model->updatedby = Auth::id();
            $model->updated_at = Carbon::now();
            $model->save();

            $status  = 200;
            $header  = 'Success';
            $message = 'Internal Order berhasil di Delete.';
        
        return response()->json([
            'status' => $status,
            'header' => $header,
            'message' => $message
        ]);
    }
    public function exportpdf()
    {
    	// $team = team::all();
        $InternalOrder=InternalOrder::select('project.*','project.id AS idUser','internalorder.projectid','internalorder.name As internalordername', 'internalorder.*',)
        ->leftjoin('project', 'internalorder.projectid', '=', 'project.id')
        ->get();
        // dd($InternalOrder);

        
    	$pdf = PDF::loadview('internalorders.internalorder_pdf',['InternalOrder'=>$InternalOrder]);
    	return $pdf->download('laporan-internal-Order.pdf');
    }
  
    public function getIOById($id){
        // $internalOrder = InternalOrder::find($id);
        $projectIO = InternalOrder::find($id);

        return $projectIO;
      }

      public function changeDateFormat($date){
        return date('d-m-Y H:i:s',strtotime($date));
      }
      public function changeDateFormatShort($date){
        return date('d-m-Y',strtotime($date));
      }

}
