<?php

namespace App\Http\Controllers\Master;
use App\Http\Controllers\Controller;

use App\Project;
use App\ProjectDetailApproval;
use App\Departement;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DataTables;
use Auth;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\DepartmentsExport;
use PDF;


class DepartementController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {


        $title = ["Departement", "Departement", ""];
        $search = $request->search;
        $data = Departement::get();
        // dd($data);

        $data = Departement::
                 where(function($query) use ($search)
                {
                    if ($search) {
                      $query->where('departementcode', 'like', '%'.$search.'%')
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

                // ->addColumn('created', function($row){
                // $data = !empty($row->created_at) ? $this->changeDateFormatShort($row->created_at) : "-";
                //     return $data;
                // })
                ->addColumn('userdepartment', function($row){
                    // $dataPage[]=$row->getAccess->roleid;
                    $dataPage[]=$row->getDeptartmentHead->namadepan;
                    // $roleName=User::whereIn('id', $dataPage)->get();
                    return $dataPage;

                  })

                ->addColumn('action', function($row){

                    $btn = '<a class="edit btn btn-icon btn-info detail-menu-btn" href="' . route('department.edit', $row['id']) . '" data-toggle="tooltip" data-placement="top" title="Detail Data">
                    <i class="bi bi-pencil-square" aria-hidden="true" id="detailArea"></i></a>';
                    // $btn .= ' <button class="booton" data-id="/member/' . $row->id . '">Delete</button>';
                    $btn .= '<a class="booton edit btn btn-icon btn-info detail-menu-btn"  data-id="' . $row->id . '" data-toggle="tooltip" data-placement="top" title="Detail Data">
                    <i class="bi-trash" aria-hidden="true" id="detailArea"></i></a>';

                    return $btn;
                  })


                ->rawColumns(['action','userdepartment'])
                ->make(true);
      }
      return view('department.index',['title' => $title,]);
    }
    public function store(Request $request) {
    // dd($request);
  
    $today = Carbon::today();
     try{
         if($request->id == null){


            $this->validate($request, [
                'code' => 'required',
                'name' => 'required',
                "departmentHead_select" =>'required|not_in:0',

                
            ]);
        }else{
            $request->validate(
            [
                "departmentHead_select" =>'required|not_in:0',

                // 'name' => 'required|string|max:155',
            ],
            [
                // 'required' => 'Kolom :attribute tidak boleh kosong.',
                // 'unique' => 'Kolom :attribute sudah terdaftar.'
            ]);
        }
        if($request->id == null){
            $newDepartement = Departement::updateOrInsert([
                'id'   => $request->data_id
            ],[
                'departementcode'       => $request->code,
                'name'       => $request->name,
                'departmenthead'       => $request->departmentHead_select,
                'isactive'       => 1,
                'createdby'  => Auth::id(),
                'created_at'  => $today,
                // 'created_at'  => $this->changeDateFormat($today),

            ]);
        }else{
            $newDepartement = Departement::updateOrInsert([
               'id'                   => $request->id
            ],[
                'departementcode'       => $request->code,
                'departmenthead'       => $request->departmentHead_select,
                'name'       => $request->name,
                'updated_at'  => $today,
                'updatedby'  => Auth::id(),
                // 'updated_at'  => $this->changeDateFormat($today),

            ]);

        }

    }catch(Exception $e){
        $msg->sts = 0;
        $msg->msg = $e->getMessage();
        return redirect()->back()
          ->withErrors(['Departement Gagal Disimpan. ' . $msg->msg])
          ->withInput();
      }
       if ($newDepartement) {
            return redirect()
                ->route('department.index')
                ->with([
                    'success' => 'New Departement has been created successfully'
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
        $title = ["Departement", "Departement", "Edit Data"];
        $departmentHead=User::where("departementid", "=", 1)->get();
        // dd($departmenthead);
        return view('department.form',['departmentHead' => $departmentHead,'title' => $title, ]);

    }

    public function exportpdf()
    {
    	$department = Departement::all();
    	$data = Departement::with('getDeptartmentHead')->get();
        // dd($data);
 
    	$pdf = PDF::loadview('department.departement_pdf',['department'=>$department]);
    	return $pdf->download('laporan-department.pdf');
    }

    public function show($id) {
        $departement = $this->getDepartementById($id);
        return view('department.show', ['departement' => $departement, ]);
    }

    public function edit($id)
    {
        $title = ["Departement", "Departement", "Edit Data"];
        $departementById = $this->getDepartementById($id);
        // dd($departementById);
        $departmentHeadById=User::where
        ([
            ["id", "=", $departementById->departmenthead],
            ['isactive', '=', 1]
        ])->first();
        // dd($departmentHeadById);
        $userDepartment= User::where('isactive', '=', 1)->get();

        // dd($departmentHeadById);
        
        return view('department.form',['userDepartment' => $userDepartment,'title' => $title,'departementById' => $departementById,'departmentHeadById' => $departmentHeadById, ]);
    }

    public function status(Request $request) {
        // dd($request);
        $model = Departement::find($request->id);
            $model['isactive'] = 0;
            $model->updatedby = Auth::id();
            $model->updated_at = Carbon::now();
            $model->save();

            $status  = 200;
            $header  = 'Success';
            $message = 'Department berhasil di Delete.';
        
        return response()->json([
            'status' => $status,
            'header' => $header,
            'message' => $message
        ]);
    }

   
    public function export() 
    {
        return Excel::download(new DepartmentsExport, 'Departments.xlsx');
    }

    public function getDepartementById($id){
        $departement = Departement::find($id);
    
        return $departement;
      }

      public function changeDateFormat($date){
        return date('d-m-Y H:i:s',strtotime($date));
      }
      public function changeDateFormatShort($date){
        return date('d-m-Y',strtotime($date));
      }

}
