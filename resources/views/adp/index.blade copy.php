@extends('layouts.template')

@section('menu-title')
@endsection

@section('breadcrumb')
@endsection

@section('content')
<!-- <div class="row">
    <div class="col-md-12"> -->


<div class="container">

    <form method="POST" id="search_form" class="form-horizontal">
        <div class="row">
            <div class="col-md-6">
                <!-- <label for="search">Search</label> -->
                <br>
                <input type="text" class="form-control" placeholder="Search" id="search" name="search">
            </div>
            <div class="col-md-6 ">
                <br>
                <div class="float-right">
                <a class="btn btn-xs btn-primary" href="{{ route('adp.create') }}">
                <img src="{{ asset('icons/addicon.svg') }}" alt="">
                     ADP </a>

            </div>

            </div>



        </div>

        <div class="btn-group float-right" style="margin-top: 15px;">
            <div class="text-right">
                <!-- <a class="btn btn-xs btn-primary" href="{{ route('adp.create') }}"> <i
                        class="bx bxs-user-plus"></i> ADP </a> -->
            </div>
            <!-- <button type="submit" class="btn btn-primary" data-toggle="tooltip" data-placement="bottom"
                title="Cari Data"> <i class="bx bx-search"></i> Cari </button>
            <button type="reset" class="btn btn-warning" data-toggle="tooltip" id="reset_form" data-placement="bottom"
                title="Reset Filter"><i class="bx bx-reset"></i> Reset
            </button> -->
        </div>
    </form>
    <div class="row">
        <div class="col-md-2">
            <div class="text-right">
                <!-- <a class="btn btn-xs btn-primary" href="{{ route('adp.create') }}"> <i
                        class="bx bxs-user-plus"></i> Tambah data </a> -->
            </div>
        </div>
    </div>
    <br> </br>
    <!-- php artisan make:export SiswaExport --model=Siswa -->
    <!-- php artisan make:export InputProjectExport --model=ProjectDetail -->

    <div class="table-responsive" id="table-menu">
        <table class="table data-table table-striped table-hover table-bordered" id="table_reporting"
            data-url="{{ route('adp.index') }}"
            data-switchurl="{{ route('adp.status') }}"
            data-backurl="{{ route('adp.index') }}" style="width: 100% !important" ">
        <thead>
            <tr>
            <th width=" 10%">#</th>
            <th>Nama Pekerjaan</th>
            <th>No. Kontrak</th>
            <th>Nilai ADP Akhir Tahun</th>
            <th>Tahun</th>
            <th>Nilai Realisasi ADP </th>
            <th>Action</th>
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

<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
    integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
</script>
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script> -->


<!-- jquery.dataTables.min -->

<!-- <script src=" {{ asset('js/datatable/jquery.dataTables.min.js') }} " type="text/javascript"></script> -->
<!-- <script src=" {{ asset('js/datatable/dataTables.bootstrap4.min.js') }} " type="text/javascript"></script> -->
<script src="//cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="//cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>

<script src="{{ asset('js/master/adp/adp.js') }}"></script>
