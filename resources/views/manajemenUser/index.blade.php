@extends('layouts.template')

@section('menu-title')
@endsection

@section('breadcrumb')
@endsection

 <?php
//  dd($user);
 ?>
@section('content')

<style>
    #btnwrapper{
        padding:5px
    }
     @media screen and (min-width: 700px) {

        img{}
 /* #asd {
    background-color: lightgreen;
  }
} */
/* .table-responsive {
    display: table; */


    /* background-color: lightgreen; */
    /* @media(max-width: 500px){

        table {

     border-collapse: collapse;
     width: 10%;
}
th {
  height: 70px;
} */
    /* .table{
    	width: 50%;

    }
    .table, .table tbody, .table thead,.table tr, .table td{
		display: block;
		width: 50%;
	} */



}
</style>
    <div class="container">

     <form method="POST" id="search_form" class="form-horizontal">
            <div class="row"  id="btnwrapper">
                <div class="col-md-4">
                    <!-- <label for="search">Kata Kunci</label> -->
                    <input type="text" class="form-control" placeholder="Masukkan Kata Kunci" id="search"
                        name="search">
                </div>
                <div class="btn-group float-right" >
                <button type="submit" class="btn btn-primary" data-toggle="tooltip" data-placement="bottom"
                    title="Cari Data"> <i class="bx bx-search"></i> Cari </button>
                <button type="reset" class="btn btn-warning" data-toggle="tooltip" id="reset_form"
                    data-placement="bottom" title="Reset Filter"><i class="bx bx-reset"></i> Reset
                </button>
                </div>
                
                <div class="col-md-6">
                 <div class="float-right">
                    <a class="btn btn-xs btn-primary" href="{{ route('user.create') }}">
                        <img src="{{ asset('icons/addicon.svg') }}" alt="">
                        User </a>
                        <a href="{{ route('user.exportpdf') }}" class="btn btn-primary" target="_blank">CETAK PDF</a>
                </div>
            </div>
          
            </div>
        </form>

           
            <div class="table-responsive" id="table-menu">
                
                    <table class="table data-table table-striped table-hover table-bordered" id="table_reporting"
                        data-url="{{ route('user.index') }}" data-switchurl="{{ route('user.status') }}" data-backurl="{{ route('user.index') }}"
                        style="width: 100% !important" ">
                        <thead>
                            <tr>
                                <th width="10%">No</th>
                                <!-- <th>Status</th> -->
                                <th>Username</th>
                                <th>Nama Depan</th>
                                <th>Nama Belakang</th>
                                <th>Jabatan</th>
                                <th>NIP</th>
                                <th>Role</th>
                                <th>Dept.Head</th>
                                <th>Team Leader</th>
                                <th>Action</th>

                                <!-- <th>Rincian Kegiatan</th> -->
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
      </div>



      <!-- </div>
</div> -->


@endsection
<!-- <script type="text/javascript" src="http://ajax.microsoft.com/ajax/jquery/jquery-3.5.1.min.js"></script> -->

<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script> -->


<!-- jquery.dataTables.min -->

<!-- <script src=" {{asset('js/datatable/jquery.dataTables.min.js')}} " type="text/javascript"></script> -->
<!-- <script src=" {{asset('js/datatable/dataTables.bootstrap4.min.js')}} " type="text/javascript"></script> -->
<script src="//cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
 <script src="//cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>

<script src="{{asset('js/master/user/user.js')}}"></script>



