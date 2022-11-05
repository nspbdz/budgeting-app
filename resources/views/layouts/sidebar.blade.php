<?php
// class="{{ Request::segment(1) === 'programs' ? 'active' : null }}"
// dd( UserHelp::isActiveRoute('dashboard.index') );
// UserHelp::isActiveRoute('route.name');
// dd(Route::currentRouteName());
// dd(Request::segment(1)== "dashboard" ? "iya" :null );
// dd(UserHelp::isActiveRoute(Request::segment(1)) === "dashboard" ? 'active' : null);
// dd( UserHelp::isActiveRoute('dashboard.index') );
// dd(Auth::user()->accessid);
// dd(UserHelp::get_role(Auth::user()->accessid));
// dd(UserHelp::get_inputprojectAccess(Auth::user()->accessid));
// dd(User::with('role')->find(Auth::id()));
// $inputan=
// dd(UserHelp::get_approvalAccess(Auth::user()->accessid))
// dd($inputan);
// dd($data);
// dd($data1);

 ?>

 <style>
      #masterbtn {
        background: none!important;
        border: none;
        /* padding: 0!important; */
        /*optional*/
        font-family: arial, sans-serif;
        color: #069;
        font-size:8px!important;
        /* text-decoration: underline; */
        cursor: pointer;
        }
     .font-style{
         /* font-size:8px!important; */
         color:black
         /* float:left */
     }
     #sidebarText{
        /* color: blue; */
     }
     hr {
        border: 0;
        clear:both;
        display:block;
        width: 96%;
        background-color:black;
        height: 0.1px;
        }
     .nav-item .active{
         color:blue;
         /* background-color:blue; */
     }
     .nav-item {
         color:blue;
         
         /* background-color:green; */
     }
 @media(max-width: 500px){

     .font-style{
         font-size:8px!important;
         /* color:blue */
         /* float:left */
     }
     /* .nav-link{
        float:left !important;

     }
    a img{
        float:left
        /* width: 11px; */
        /* font-size: 9px; */
    } */
    #accordionSidebar{
        zoom:60%!important;
        width:35px;
    }
 }
 </style>

<!-- Sidebar -->
<!-- navbar-nav bg-light  untuk ganti warana baegian samping  navbar-nav s-->
<ul class="navbar-nav bg-white sidebar sidebar-dark accordion" id="accordionSidebar">
<!-- <img id="logo_kai" src="{{asset('logo/Mandiri_logo.svg')}}" style="height: 37px !important; width: auto !important;"> -->

    <a class="navbar-brand" href="/home">

    <img id="logo_kai" src="{{ asset('img/logo.svg') }}" class="img-fluid"
              alt="Sample image" >
    </a>

    <br>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">
<!--
    <li  class="nav-item <?php echo UserHelp::isActiveRoute('dashboard.index') ?>" id="<?php echo UserHelp::get_DashboardAccess(Auth::user()->accessid) ?>"  >
        <a class="nav-link" href="/dashboard">
            <img src="{{ asset('icons/dashboardicon.svg') }}" alt="">
            <span  >Dashboard</span></a>
    </li> -->
    <li  class="nav-item <?php echo UserHelp::isActiveRoute('dashboard.index') ?>" id="<?php echo UserHelp::get_DashboardAccess(Auth::user()->accessid) ?>" >
        <a class="nav-link" href="/dashboard">
            <img src="{{ asset('icons/dashboardicon.svg') }}"  alt="">


        <span class="font-style">Dashboard</span></a>
    </li>
    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <button class="nav-link collapsed" id="masterbtn" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true"
            aria-controls="collapseTwo">
            <img src="{{ asset('icons/masterdataicon.svg') }}" alt="">
            <span class="font-style">Master Data</span>
</button>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div id="datadrop" class="bg-white py-2 collapse-inner rounded">
                <a id="<?php echo UserHelp::get_masterUserAccess(Auth::user()->accessid) ?>" class="collapse-item" href="/master/user">User</a>
                <a id="<?php echo UserHelp::get_masterRoleAccess(Auth::user()->accessid) ?>" class="collapse-item" href="/master/role">Role</a>
                <a id="<?php echo UserHelp::get_masterProjectAccess(Auth::user()->accessid) ?>" class="collapse-item" href="/master/project">Project</a>
                <a id="<?php echo UserHelp::get_masterDepartementAccess(Auth::user()->accessid) ?>" class="collapse-item" href="/master/department">Department</a>
                <a id="<?php echo UserHelp::get_masterTeamAccess(Auth::user()->accessid) ?>" class="collapse-item" href="/master/team">Team</a>
                <a id="<?php echo UserHelp::get_masterInternalOrderAccess(Auth::user()->accessid) ?>" class="collapse-item" href="/master/internalorder">Internal Order</a>
                <a id="<?php echo UserHelp::get_masterAssetAccess(Auth::user()->accessid) ?>" class="collapse-item" href="/master/asset">Master Asset</a>
                <a id="<?php echo UserHelp::get_masterAssetAccess(Auth::user()->accessid) ?>" class="collapse-item" href="/master/adp">Master ADP</a>
            </div>
        </div>

    </li>
    
        <!-- <button class="collapsed" >asd</button> -->
    <script>
     

    </script>

    <!-- Nav Item - Charts -->
    <!-- <li class="nav-item  "> -->
    <li  class="nav-item <?php echo UserHelp::isActiveRoute('inputproject.index') ?>" id="<?php echo UserHelp::get_inputprojectAccess(Auth::user()->accessid) ?>" >
        <a class="nav-link" href="/inputproject">
            <img src="{{ asset('icons/inputprojecticon.svg') }}"  alt="">
            
            <span class="font-style">Input Project</span></a>
    </li>

    <li class="nav-item">
    <li  class="nav-item <?php echo UserHelp::isActiveRoute('project.index') ?>" id="<?php echo UserHelp::get_crossCheckDataAccess(Auth::user()->accessid) ?>"  >
        <a class="nav-link" href="/crosscheckdata">
            <img src="{{ asset('icons/crosscheckdataicon.svg') }}" alt="">
            
            <span class="font-style">Cross Check Data</span></a>
    </li>
    <!-- <li class="nav-item"> -->
    <li  class="nav-item <?php echo UserHelp::isActiveRoute('approval.index') ?>" id="<?php echo UserHelp::get_approvalAccess(Auth::user()->accessid) ?>"  >
        <a class="nav-link" href="/approval">
            <img src="{{ asset('icons/approvalicon.svg') }}" alt="">
            
            <span class="font-style">Approval</span></a>
    </li>

    <!-- Nav Item - Tables -->
    <!-- <li class="nav-item"> -->
    <li  class="nav-item <?php echo UserHelp::isActiveRoute('reporting.index') ?>" id="<?php echo UserHelp::get_reportingAccess(Auth::user()->accessid) ?>"  >
        <a class="nav-link" href="/reporting">
        <img src="{{ asset('icons/reportingicon.svg') }}" alt="">
        
        <span class="font-style">Reporting</span></a>
    </li>

    <li class="nav-item">
    <li  class="nav-item <?php echo UserHelp::isActiveRoute('verifikasilogbook.index') ?>" id="<?php echo UserHelp::get_verifikasilogbook(Auth::user()->accessid) ?>"  >
        <a class="nav-link" href="/verifikasilogbook">
            <img src="{{ asset('icons/verifikasilogbookicon.svg') }}" alt="">
            
            <span class="font-style">Verifikasi Logbook</span></a>
    </li>

    <li class="nav-item">
    <li  class="nav-item <?php echo UserHelp::isActiveRoute('monitoringupload.index') ?>" id="<?php echo UserHelp::get_verifikasilogbook(Auth::user()->accessid) ?>"  >
        <a class="nav-link" href="/monitoringupload">
            <img src="{{ asset('icons/monitoringuploadicon.svg') }}" alt="">
            
            <span class="font-style">Monitoring Upload</span></a>
    </li>

    <li class="nav-item">
    <li  class="nav-item <?php echo UserHelp::isActiveRoute('verifikasilogbook.index') ?>" id="<?php echo UserHelp::get_verifikasilogbook(Auth::user()->accessid) ?>"  >
        <a class="nav-link" href="/verifikasilogbook">
            <img src="{{ asset('icons/monitoringadpicon.svg') }}" alt="">
            
            <span class="font-style">Monitoring ADP</span></a>
    </li>

    <li class="nav-item">
    <li  class="nav-item <?php echo UserHelp::isActiveRoute('verifikasilogbook.index') ?>" id="<?php echo UserHelp::get_verifikasilogbook(Auth::user()->accessid) ?>"  >
        <a class="nav-link" href="/verifikasilogbook">
            <img src="{{ asset('icons/projectclosureicon.svg') }}" alt="">
            
            <span class="font-style">Project Closure </span></a>
    </li>

    <li  class="nav-item <?php echo UserHelp::isActiveRoute('reclass.index') ?>" id="<?php echo UserHelp::get_reClass(Auth::user()->accessid) ?>"  >
        <a class="nav-link" href="/reclass">
            <img src="{{ asset('icons/reclassicon.svg') }}" alt="">
            
            <span class="font-style">Reclass</span></a>
    </li>



    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<script src="https://code.jquery.com/jquery-3.6.0.slim.js" integrity="sha256-HwWONEZrpuoh951cQD1ov2HUK5zA5DwJ1DNUXaM6FsY=" crossorigin="anonymous"></script>
<script>
    // console.log("asd");
      console.log(window.location.href);
        console.log($(".collapsed"));

        $( document ).ready(function() {
            var s = window.location.href
            
            if (s.match(/master.*/)) {
            console.log( "ready!" );
                $('#masterbtn').trigger('click');
            }
        });
    $(document).ready(function() {
        
        $("#dashboard").hide();
        $("#masterUser").hide();
        $("#masterRole").hide();
        $("#masterProject").hide();
        $("#masterTeam").hide();
        $("#masterInternalOrder").hide();
        $("#masterAsset").hide();
        $("#masterDepartement").hide();
        $("#inputProject").hide();
        $("#crossCheckData").hide();
        $("#approvalAccess").hide();
        $("#reporting").hide();
        $("#verifikasiUpload").hide();
        $("#reClass").hide();

});
</script>
