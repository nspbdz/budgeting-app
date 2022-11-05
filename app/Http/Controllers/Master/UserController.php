<?php

namespace App\Http\Controllers\Master;
use App\Http\Controllers\Controller;

use App\Project;
use App\Role;
use App\Access;
use App\User;
use App\DepartmentHead;
use App\Departement;
use App\TeamLeader;
use App\ProjectDetailApproval;
use Carbon\Carbon;
use PDF;

use Illuminate\Http\Request;
use DataTables;
use Auth;
use Illuminate\Support\Facades\Hash;
use App\Rules\MatchOldPassword;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        // dd($request);
        $title = ["Report", "Report", ""];
        $search = $request->search;
        // $data = User::with('getAccess')->get();

        $data = User::with('getAccess.getRole')
                 ->where(function($query) use ($search)
                {
                    if ($search) {
                      $query->where('namadepan', 'like', '%'.$search.'%')
                      ->orWhere('namabelakang', 'like', '%'.$search.'%')
                      ->orWhere('username', 'like', '%'.$search.'%')
                      ->orWhere('jabatan', 'like', '%'.$search.'%');
                    }
                })

                ->where('isactive',1)
                // ->groupBy('id')
                ->orderBy('id', 'DESC')
                ->get();

        // dd($data->isactive);
        if ($request->ajax()) {
          return Datatables::of($data)
                ->addIndexColumn()

                ->addColumn('action', function($row){

                    $btn = '<a class="edit btn btn-icon btn-info detail-menu-btn" href="' . route('user.edit', $row['id']) . '" data-toggle="tooltip" data-placement="top" title="Detail Data">
                    <i class="bi bi-pencil-square" aria-hidden="true" id="detailArea"></i></a>';
                    $btn .= '<a class="booton edit btn btn-icon btn-info detail-menu-btn"  data-id="' . $row->id . '" data-toggle="tooltip" data-placement="top" title="Detail Data">
                    <i class="bi-trash" aria-hidden="true" id="detailArea"></i></a>';
                    return $btn;
                  })

                  ->addColumn('status', function ($row) {
                    if ($row->isactive == 1) {
                      $slideStatus = '<div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input switchStatus" data-toogle="active" data-id="' . $row->id . '" id="switchMenu' . $row->id . '" checked>
                                                <label class="custom-control-label" for="switchMenu' . $row->id . '"></label>
                                                </div>';
                    } else {
                        $slideStatus = '<div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input switchStatus" data-toogle="inactive" data-id="' . $row->id . '" id="switchMenu' . $row->id . '">
                                                <label class="custom-control-label" for="switchMenu' . $row->id . '"></label>
                                                </div>';
                    }
                    return $slideStatus;
                })
                ->addColumn('roled', function($row){
                    $dataPage[]=$row->getAccess->roleid;
                   return $dataPage;
                  })
                  ->addColumn('teamlead', function($row){
                    //   punya leaderteam 
                    $dataLeaderTeam[]=$row->teamleaderid;
                    $data[]="";
                    foreach($dataLeaderTeam as $items){
                        $data[]= $items;
                    }

                    //  sebagai leaderteam 
                    $dataIsLeader[]=$row->isteamleader;
                    $data2[]="";
                    foreach($dataIsLeader as $itemsIsLead){
                        $data2[]= $itemsIsLead;
                    }

                    $userTeamLead=User::where('id', "=", $data[1])->select('namadepan')->first();
                    // dd($userTeamLead->namadepan);
                    $leader="-";
                    if($userTeamLead == null && $data2[1]==1){
                        $leader="team lead";
                    
                    }else if(!empty($userTeamLead)){
                    $leader=$userTeamLead->namadepan;
                    }

                    return $leader;
                  })

                  ->addColumn('dephead', function($row){
                    //   punya leaderteam 
                    $dataDepHead[]=$row->departmenthead;
                    $data[]="";
                    foreach($dataDepHead as $items){
                        $data[]= $items;
                    }

                    $userDepHead=User::where('id', "=", $data[1])->select('namadepan')->first();
                    $depHead="-";

                     if(!empty($userDepHead)){
                    $depHead=$userDepHead->namadepan;
                    }

                    return $depHead;
                  })


                ->rawColumns(['dephead','teamlead','roled','action','status'])
                ->make(true);
      }
      return view('manajemenUser.index',['title' => $title,]);
    }

    public function store(Request $request) {
        dd($request);

        $dashboard = $request->isTeamLeader == null ? $dataPage="0" : $dataPage="1";
        // dd($dashboard);
     try{
         if($request->id == null){
        // dd($request);
            $this->validate($request, [
                'isTeamLeader' => 'required_without:teamLeader_select|not_in:0',
                'teamLeader_select' => 'required_without:isTeamLeader|not_in:0',
                'role_select' => 'required|not_in:0',
                'departmenthead_select' => 'required|not_in:0',
                'username' => 'required|unique:users,username',
                'email' => 'required',
                'mobilephone' => 'required',
                'jabatan' => 'required',
                'namadepan' => 'required',
                'namabelakang' => 'required',
                'nip' => 'required',
                'password' => 'required|min:8',
                'confirm_password' => 'required|min:8|same:password',
               
            ],
            [
                // 'required' => 'Kolom :attribute tidak boleh kosong.',
                'unique' => 'Kolom :attribute sudah terdaftar.'
            ]
        );

        }else{
            // dd($request);
            $request->validate(

            [
                'role_select' => 'required|not_in:0',
                'departmenthead_select' => 'required|not_in:0',
                'isTeamLeader' => 'required_without:teamLeader_select|not_in:0',
                'teamLeader_select' => 'required_without:isTeamLeader|not_in:0',
                'new_password' => 'required|min:8',
                'new_confirm_password' => 'required|min:8|same:new_password',
             
            ],
            [
                // 'required' => 'Kolom :attribute tidak boleh kosong.',
                // 'unique' => 'Kolom :attribute sudah terdaftar.'
            ]);
        }
        if($request->id == null){
            // // dd($request);
            $newUser = User::updateOrInsert([
                'id'   => $request->data_id,
            ],[
                'username'       => $request->username,
                'email'       => $request->email,
                'jabatan'       => $request->jabatan,
                'mobilephone'       => $request->mobilephone,
                'position'       => $request->jabatan,
                'namadepan'       => $request->namadepan,
                'namabelakang'     => $request->namabelakang,
                'nip'               => $request->nip,
                'teamleaderid'       => $request->teamLeader_select,
                'departmenthead'       => $request->departmenthead_select,
                'password' => Hash::make($request['password']),
                'accessid' => $request->role_select,
                'isactive' => 1,
            ]);
                $lastUser=User::orderBy('id', 'DESC')->first();

                
            if(!empty($request->input('isTeamLeader'))) {
                $isteamlead=1;
                $newUser = User::updateOrInsert([
                    'id'                   => $lastUser->id
                  ],[
                    'isteamleader'       => $isteamlead,
                  ]);
                
                

            } 
           
        }else{
            // User::find(auth()->user()->id)->update(['password'=> Hash::make($request->new_password)]);
            // dd("dfsdfsd");
            $newUser = User::updateOrInsert([
              'id'                   => $request->id
            ],[
                'email'       => $request->email,
                'jabatan'       => $request->jabatan,
                'mobilephone'       => $request->mobilephone,
                'position'       => $request->jabatan,
                'namadepan'       => $request->namadepan,
                'namabelakang'     => $request->namabelakang,
                'nip'               => $request->nip,
                'teamleaderid'       => $request->teamLeader_select,
                'departmenthead'       => $request->departmenthead_select,
                'accessid' => $request->role_select,
                'isactive' => 1,
                'password' => Hash::make($request['new_password']),
            ]);
            $userNow=User::where('id', '=', $request->id)->first();
            // if($userNow->isteamlead == 1)
            // dd($userNow);
            
            //jika isteamlead=0
            if($dataPage == "0" ) {
                $isteamlead=0;

                $newUser = User::updateOrInsert([
                    'id'                   => $request->id
                  ],[
                    'isteamleader'       => $isteamlead,
                  ]);
                  // karena dia bukan lagi team leader maka teamleader table di edit menjadi 
                  // teamleaderid teamLeader_select
                  // mencari user yang ini apakah dia punya table teamleader 

                  // 
                  $isteamleaderbefore=TeamLeader::where([
                    ['userid', '=', $userNow->id],
                    ['teamleaderid', '=', $userNow->id],
                  ])->delete();

                  $userTeamLead=TeamLeader::where(
                    'userid', '=', $userNow->id)
                    ->first();
                        // dd($userTeamLead);

                        if($userTeamLead == null){
                            $newTeamLeader = TeamLeader::updateOrInsert([
                          'id'                   =>  $request->data_id
                        ],[
                          'teamleaderid'             => $request->teamLeader_select,
                          'userid'                   => $userNow->id,
                          'isactive' => 1,
                        ]);

                        }else{

                            $newTeamLeader = TeamLeader::updateOrInsert([
                          'id'                   =>  $userTeamLead->id
                        ],[
                          'teamleaderid'             => $request->teamLeader_select,
                          'userid'                   => $userNow->id,
                          'isactive' => 1,
                        ]);
                        }

                        //jika isteamlead=1
                  } else if($dataPage == "1") {
                      
                      $isteamlead=1;
                      $newUser = User::updateOrInsert([
                          'id'                   => $request->id
                        ],[
                          'isteamleader'       => $isteamlead,
                        ]);
                        
                        $userTeamLead=TeamLeader::where('userid', '=', $userNow->teamleaderid)->first();
                        // dd($userTeamLead);

                        if($userTeamLead == null){
                            $newTeamLeader = TeamLeader::updateOrInsert([
                          'id'                   =>   $request->data_id
                        ],[
                          'teamleaderid'             => $request->id,
                          'userid'                   => $userNow->id,
                          'isactive' => 1,
                        ]);
                        }else{
                            $newTeamLeader = TeamLeader::updateOrInsert([
                          'id'                   =>  $userTeamLead->id
                        ],[
                          'teamleaderid'             => $userNow->id,
                          'userid'                   => $userNow->id,
                          'isactive' => 1,
                        ]);
                        }
                
            }
        }

    }catch(Exception $e){
        $msg->sts = 0;
        $msg->msg = $e->getMessage();
        return redirect()->back()
          ->withErrors(['User Gagal Disimpan. ' . $msg->msg])
          ->withInput();
      }
       if ($newUser) {
            return redirect()
                ->route('user.index')
                ->with([
                    'success' => 'New User has been created successfully'
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
        $title = ["User", "User", "Create Data"];
        $role = Role::where('isactive', '=', 1)->get();
        // $userTeamLead = User::where('isactive', '=', 1)->get();
        // $userTeamLead = TeamLeader::with('getUser')->where('isactive', '=', 1)->get();
        // $userTeamLead = TeamLeader::all();

        $userTeamLead=User::where('isteamleader', '=', 1)
        // ->groupBy('teamleader.teamleaderid','users.namadepan','users.id','teamleader.teamleaderid','teamleader.id')
        ->get();

        // $userTeamLead=TeamLeader::
        // select('users.namadepan','users.id AS idUser','teamleader.teamleaderid', 'teamleader.*',)
        // ->leftjoin('users', 'teamleader.teamleaderid', '=', 'users.id')
        // ->groupBy('teamleader.teamleaderid','users.namadepan','users.id','teamleader.teamleaderid','teamleader.id')
        // ->get();
        
        

        $userDepartmentHead=Departement::select('departement.*','users.*','users.id As userid', 'departement.id As departementid')
        ->leftjoin('users', 'departement.departmenthead', '=', 'users.id')
        // ->groupBy('teamleader.teamleaderid')
        ->get();

        // dd($userDepartmentHead);

        return view('manajemenUser.form',['userTeamLead' => $userTeamLead,'userDepartmentHead' => $userDepartmentHead,'title' => $title,'role' => $role, ]);
    }

    public function show($id) {
        $user = $this->getUserById($id);
        return view('manajemenUser.show', ['user' => $user, ]);
    }

    public function edit($id)
    {
        // $id id milik user
        $title = ["User", "User", "Edit Data"];
        $user = $this->getUserById($id);
        $role = Role::get();
        // dd(count($role));
        // dd($user);
        
        
          //untuk dropdown team lead
      $userDepartment=Departement::select('users.namadepan','users.id AS idUser','departement.id AS deptid','departement.departmenthead', 'departement.*',)
      ->leftjoin('users', 'departement.departmenthead', '=', 'users.id')
      ->where('departement.isactive', '=',1)
      // ->where([
      //   ['users.isactive', '=', 1],
      //   ['departement.departmenthead', '!=', $user->id]
      // ])
      // ->groupBy('departement.departmenthead','users.namadepan','users.id','departement.departmenthead','departement.id')
      ->get();

        // sebagai is !empty pembanding berdasarkan data user
      $departmentHeadById = Departement::
        where([
          ["departmenthead", "=",$user->departmenthead],
          ["isactive", "=",1],
          ])->first();
      // dd($departmentHeadById);


          //untuk dropdown team lead
      $userTeamLead=TeamLeader::select('users.namadepan','users.id AS idUser','teamleader.teamleaderid', 'teamleader.*',)
      ->leftjoin('users', 'teamleader.teamleaderid', '=', 'users.id')
      ->where([
        ['users.isactive', '=', 1],
        ['teamleaderid', '!=', $user->id]
      ])
      ->groupBy('teamleader.teamleaderid','users.namadepan','users.id','teamleader.teamleaderid','teamleader.id')
      ->get();
      
    // sebagai is !empty pembanding berdasarkan data user
      $teamLeadById = User::
      where([
        ["id", "=",$user->teamleaderid],
        ["isactive", "=",1],
        ])->first();
        // dd($teamLeadById);

      // $userTeamLead=User::get();
    //   dd($userTeamLead);
   
      $acesUser=Access::where('roleid', '=', $user->accessid)->first();
      $roleAccessById=Role::
      where([
          ["id", "=",$acesUser->roleid],
          ["isactive", "=",1],
      ])->first();
      // dd($roleAccessById);

      $UserAccess = User::with('getAccess')->
      where([
          ["id", "=",$id],
          ["isactive", "=",1],
      ])->first();
          // dd($UserAccess);

      $access = Access::get();
      $roledById = Role::get();
      $accessRole[] = array();

        foreach($access as $key=>$value){
          $roledById = Role::where('id', '=', $value['roleid'])->first();
          if($roleAccessById == null)
          $roleAccessById="";
          else{

          $accessRole[$key] = array(
            'id'              => $value['id'],
            'text'            => $roledById['name']
          );
      }
        }
       $access['accessRole'] = $accessRole;

        return view('manajemenUser.form',[ 'acesUser' => $acesUser,'roleAccessById' => $roleAccessById,'teamLeadById' => $teamLeadById,'userTeamLead' => $userTeamLead,'departmentHeadById' => $departmentHeadById,'userDepartment' => $userDepartment,'UserAccess' => $UserAccess,'UserAccess' => $UserAccess,'UserAccess' => $UserAccess,'access' => $access,'role' => $role,'title' => $title,'user' => $user, ]);
    }
    
 public function exportpdf()
    {
    	$user = User::get();
      // dd($user);
      $dataRole=User::select('users.*','users.id','access.id','role.id','role.name')
      ->leftjoin('access', 'users.accessid', '=', 'access.id')
      ->leftjoin('role', 'access.roleid', '=', 'role.id')
      ->get();
      // $userDepartment=User::select('users.*','users.namadepan','users.id AS idUser','departmenthead.*',)
      // ->leftjoin('departmenthead', 'users.departmenthead', '=', 'departmenthead.id')
      // ->where('users.isactive', '=', 1) 
      // // ->groupBy('departmenthead.departmentheadid')
      // ->get();

      // dd($userDepartment);
        
    	$pdf = PDF::loadview('manajemenUser.user_pdf',['dataRole'=>$dataRole,'user'=>$user]);
    	return $pdf->download('laporan-user.pdf');
    }

    public function status(Request $request) {
        // dd($request);
        $model = User::find($request->id);
            $model['isactive'] = 0;
            $model->updatedby = Auth::id();
            $model->updated_at = Carbon::now();
            $model->save();

            $status  = 200;
            $header  = 'Success';
            $message = 'User berhasil di Delete.';
        
        return response()->json([
            'status' => $status,
            'header' => $header,
            'message' => $message
        ]);
    }
    public function getUserById($id){
        $user = User::find($id);

        return $user;
      }


}
