<?php

namespace App\Http\Controllers\Master;
use App\Http\Controllers\Controller;

use App\Project;
use App\User;
use App\ProjectDetailApproval;
use App\Asset;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DataTables;
use Auth;
use PDF;

use Illuminate\Support\Facades\Hash;


class AssetController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {


        $title = ["Asset", "Asset", ""];
        $search = $request->search;
        // dd($search);
        $data = Asset::get();
        // dd($data);
        // print_r($search);


        $data = Asset::
                 where(function($query) use ($search)
                {
                    if ($search) {
                      $query->where('projectname', 'like', '%'.$search.'%')
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

                    $btn = '<a class="edit btn btn-icon btn-info detail-menu-btn" href="' . route('asset.edit', $row['id']) . '" data-toggle="tooltip" data-placement="top" title="Detail Data">
                    <i class="bi bi-pencil-square" aria-hidden="true" id="detailArea"></i></a>';
                    // $btn .= '<a class="edit btn btn-icon btn-info detail-menu-btn" href="' . route('asset.show', $row['id']) . '" data-toggle="tooltip" data-placement="top" title="Detail Data">
                    //                        <i class="bi-trash" aria-hidden="true" id="detailArea"></i></a>';
                    $btn .= '<a class="booton edit btn btn-icon btn-info detail-menu-btn"  data-id="' . $row->id . '" data-toggle="tooltip" data-placement="top" title="Detail Data">
                    <i class="bi-trash" aria-hidden="true" id="detailArea"></i></a>';

                     return $btn;
                  })


                ->rawColumns(['action'])
                ->make(true);
      }
      return view('asset.index',['title' => $title,]);
    }
    public function store(Request $request) {
    // dd($request);
    $today = Carbon::today();
    // dd($today);
     try{
         if($request->id == null){

            $this->validate($request, [
                "project_select" =>'required|not_in:0',
                "masterasset" => "required",
                "projectname" => "required",
                "jobname" => "required",
                "contractnumber" => "required",
                "contractvalue" => "required",
            ]);
        }else{
            $request->validate(
            [
                "project_select" =>'required|not_in:0',
                // 'name' => 'required|string|max:155',
            ],
            [
                // 'required' => 'Kolom :attribute tidak boleh kosong.',
                // 'unique' => 'Kolom :attribute sudah terdaftar.'
            ]);
        }
        if($request->id == null){
            $newAsset = Asset::updateOrInsert([
                'id'   => $request->data_id,
            ],[
                 // "project_select" => "1"
                // "masterasset" => "asdasdas"
                // "projectname" => "asdasds"
                // "jobname" => "aasdasda"
                // "contractnumber" => "12313"
                // "contractvalue" => "1232132"
                "projectcode" => $request->project_select,
                "masterasset" => $request->masterasset,
                "projectname" => $request->projectname,
                "masterasset" => $request->masterasset,
                "jobname" => $request->jobname,
                "contractnumber" => $request->contractnumber,
                "contractvalue" => $request->contractvalue,
                'isactive'       => 1,
                'createdby'  => Auth::id(),
                'created_at'  => $today,
                // 'created_at'  => $this->changeDateFormat($today),

            ]);
        }else{
            $newAsset = Asset::updateOrInsert([
               'id'                   => $request->id
            ],[

                // "id" => "1"
                // "masterasset" => "111update"
                // "projectname" => "techupdate"
                // "jobname" => "teknologiupdate"
                // "contractnumber" => "202099"
                // "contractvalue" => "1901199"
                "projectcode" => $request->project_select,
                "masterasset" => $request->masterasset,
                "projectname" => $request->projectname,
                "jobname" => $request->jobname,
                "contractnumber" => $request->contractnumber,
                "contractvalue" => $request->contractvalue,
                // 'name'       => $request->name,
                'updated_at'  => $today,
                'updatedby'  => Auth::id(),
                // 'updated_at'  => $this->changeDateFormat($today),

            ]);

        }

    }catch(Exception $e){
        $msg->sts = 0;
        $msg->msg = $e->getMessage();
        return redirect()->back()
          ->withErrors(['Asset Gagal Disimpan. ' . $msg->msg])
          ->withInput();
      }
       if ($newAsset) {
            return redirect()
                ->route('asset.index')
                ->with([
                    'success' => 'New Asset has been created successfully'
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
        $title = ["Asset", "Asset", "Edit Data"];
        // $asset = $this->getAssetById($id);
        // $projectById = Project::find($asset->projectcode);

        $projectCode = Project::where('isactive', '=', 1)->get();

        return view('asset.form',['title' => $title,'projectCode' => $projectCode, ]);

    }

    public function show($id) {
        $asset = $this->getAssetById($id);
        return view('asset.show', ['Asset' => $asset, ]);
    }

    public function edit($id)
    {
        $title = ["Asset", "Asset", "Edit Data"];
        $assetById = $this->getAssetById($id);
        $project_select=Project::where('isactive', '=', 1)->get();

        $projectById=Project::where([
            ["id", "=",$assetById->projectcode],
            ["isactive", "=",1]
        ])->first();
        // dd($projectById);

        // dd($assetById);
        return view('asset.form',['title' => $title,'assetById' => $assetById,'projectById' => $projectById,'project_select' => $project_select, ]);
    }


    public function status(Request $request) {
        // dd($request);
        $model = Asset::find($request->id);
            $model['isactive'] = 0;
            $model->updatedby = Auth::id();
            $model->updated_at = Carbon::now();
            $model->save();

            $status  = 200;
            $header  = 'Success';
            $message = 'Asset berhasil di Delete.';
        
        return response()->json([
            'status' => $status,
            'header' => $header,
            'message' => $message
        ]);
    }

    public function exportpdf()
    {
    	// $team = team::all();
        $Asset=Asset::select('project.*','project.projectcode AS code','asset.projectcode','asset.*',)
        ->leftjoin('project', 'asset.projectcode', '=', 'project.id')
        ->get();
        // dd($Asset);

        
    	$pdf = PDF::loadview('asset.asset_pdf',['Asset'=>$Asset]);
    	return $pdf->download('laporan-internal-Order.pdf');
    }

    public function getAssetById($id){
        $asset = Asset::find($id);

        return $asset;
      }

      public function changeDateFormat($date){
        return date('d-m-Y H:i:s',strtotime($date));
      }
      public function changeDateFormatShort($date){
        return date('d-m-Y',strtotime($date));
      }

}
