<?php

namespace App\Http\Controllers\Master;
use App\Http\Controllers\Controller;

use App\Project;
use App\User;
use App\Departement;
use App\TeamLeader;

use App\ProjectDetailApproval;
use App\Team;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DataTables;
use PDF;
use Auth;
use Illuminate\Support\Facades\Hash;


class TeamController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {


        $title = ["Team", "Team", ""];
        $search = $request->search;
        $data = Team::get();
        // dd($data);

          $data = Team::
                 with('getDepartement','getUser')
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

                // ->addColumn('created', function($row){
                // $data = !empty($row->created_at) ? $this->changeDateFormatShort($row->created_at) : "-";
                //     return $data;
                // })

                ->addColumn('action', function($row){

                    $btn = '<a class="edit btn btn-icon btn-info detail-menu-btn" href="' . route('team.edit', $row['id']) . '" data-toggle="tooltip" data-placement="top" title="Detail Data">
                    <i class="bi bi-pencil-square" aria-hidden="true" id="detailArea"></i></a>';
                    // $btn .= '<a class="edit btn btn-icon btn-info detail-menu-btn" href="' . route('team.show', $row['id']) . '" data-toggle="tooltip" data-placement="top" title="Detail Data">
                    //                        <i class="bi-trash" aria-hidden="true" id="detailArea"></i></a>';
                    $btn .= '<a class="booton edit btn btn-icon btn-info detail-menu-btn"  data-id="' . $row->id . '" data-toggle="tooltip" data-placement="top" title="Detail Data">
                    <i class="bi-trash" aria-hidden="true" id="detailArea"></i></a>';
                       
                    // $btn .= '<a class="edit btn btn-icon btn-info detail-menu-btn" href="' . route('team.show', $row['id']) . '" data-toggle="tooltip" data-placement="top" title="Detail Data">
                    //                        <i class="bi-eye" aria-hidden="true" id="detailArea"></i></a>';
                    return $btn;
                  })


                ->rawColumns(['action'])
                ->make(true);
      }
      return view('team.index',['title' => $title,]);
    }
    public function store(Request $request) {
    // dd($request);
    // "data_id" => null
    // "name" => "asdasd"
    // "departement_select" => "1"
    // "teamLeader_select" => "1"
    $today = Carbon::today();
    // dd($today);
    // dd($this->changeDateFormat($today));
     try{
         if($request->id == null){
            $this->validate($request, [
                
                'teamLeader_select' => 'required|not_in:0',
                'departement_select' => 'required|not_in:0',
                // 'role_select' => 'required|not_in:0',
                'name' => 'required',
            ]);
        }else{
            $request->validate(
            [
                'teamLeader_select' => 'required|not_in:0',
                'departement_select' => 'required|not_in:0',
                // 'name' => 'required|string|max:155',
            ],
            [
                // 'required' => 'Kolom :attribute tidak boleh kosong.',
                // 'unique' => 'Kolom :attribute sudah terdaftar.'
            ]);
        }
        if($request->id == null){
            $newTeam = Team::updateOrInsert([
                'id'   => $request->data_id,
            ],[
                'name'       => $request->name,
                'teamleader'       => $request->teamLeader_select,
                'departementCode'       => $request->departement_select,
                'isactive'       => 1,
                'createdby'  => Auth::id(),
                'created_at'  => $today,
                // 'created_at'  => $this->changeDateFormat($today),

            ]);
        }else{
            $newTeam = Team::updateOrInsert([
               'id'                   => $request->id
            ],[
                'name'       => $request->name,
                'teamleader'       => $request->teamLeader_select,
                'departementCode'       => $request->departement_select,

                // 'departementCode'       => $request->departement_select,
                'updated_at'  => $today,
                'updatedby'  => Auth::id(),
                // 'updated_at'  => $this->changeDateFormat($today),

            ]);

        }

    }catch(Exception $e){
        $msg->sts = 0;
        $msg->msg = $e->getMessage();
        return redirect()->back()
          ->withErrors(['Team Gagal Disimpan. ' . $msg->msg])
          ->withInput();
      }
       if ($newTeam) {
            return redirect()
                ->route('team.index')
                ->with([
                    'success' => 'New Team has been created successfully'
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
        $title = ["Team", "Team", "Edit Data"];
        

        $teamLeader=TeamLeader::select('users.namadepan','users.id AS idUser','teamleader.teamleaderid', 'teamleader.*',)
        ->leftjoin('users', 'teamleader.teamleaderid', '=', 'users.id')
        // ->groupBy('teamleader.teamleaderid')
        ->groupBy('teamleader.teamleaderid','users.namadepan','users.id','teamleader.teamleaderid','teamleader.id')
        ->get();
        // dd($userTeamLead);

        $departement= Departement::where('isactive', '=', 1)->get();
        // $teamLeader= User::where('isactive', '=', 1)->get();
        return view('team.form',['teamLeader' => $teamLeader, 'title' => $title, 'departement' => $departement ]);

    }

    public function show($id) {
        $team = $this->getTeamById($id);
        $departement= Departement::get();

        return view('team.show', ['team' => $team, ]);
    }

    public function edit($id)
    {
        // teamLeader_select
        // departement_select
        $title = ["Team", "Team", "Edit Data"];
        $teamById = $this->getTeamById($id);
      
        $teamDepartementById = Departement::where([
            ["id", "=",$teamById->departementcode],
            ["isactive", "=",1]
        ])->first();

        // $teamLeaderDepartement = User::where("id", "=",$teamById->teamleader)->get();
        $teamLeaderById 
        = Departement::where([
            ["id", "=",$teamById->teamleader],
            ["isactive", "=",1]
        ])->first();

        $teamLeader=User::where("isactive", "=",1)->get();
        // dd($teamLeader);
        $userDepartment= Departement::where("isactive", "=",1)->get();


        return view('team.form',['teamLeaderById' => $teamLeaderById,'teamLeader' => $teamLeader,'userDepartment' => $userDepartment,'title' => $title,'teamDepartementById' => $teamDepartementById,'teamById'=> $teamById ]);
    }

    public function status(Request $request) {
        // dd($request);
        $model = Team::find($request->id);
            $model['isactive'] = 0;
            $model->updatedby = Auth::id();
            $model->updated_at = Carbon::now();
            $model->save();

            $status  = 200;
            $header  = 'Success';
            $message = 'Team berhasil di Delete.';
        
        return response()->json([
            'status' => $status,
            'header' => $header,
            'message' => $message
        ]);
    }
    public function exportpdf()
    {
    	// $team = team::all();
        $team=Team::select('departement.name As deptname','departement.id AS idUser','team.departementcode','team.name As teamname', 'team.*',)
        ->leftjoin('departement', 'team.departementcode', '=', 'departement.id')
        ->get();
        // dd($userTeamLead);

        
    	$pdf = PDF::loadview('team.team_pdf',['team'=>$team]);
    	return $pdf->download('laporan-team.pdf');
    }
  
    public function getTeamById($id){
        $team = Team::find($id);

        return $team;
      }

      public function changeDateFormat($date){
        return date('d-m-Y H:i:s',strtotime($date));
      }
      public function changeDateFormatShort($date){
        return date('d-m-Y',strtotime($date));
      }

}
