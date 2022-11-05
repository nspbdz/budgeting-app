@extends('layouts.template')

@section('menu-title')
@endsection

@section('breadcrumb')
@endsection

@section('content')
<!-- <div class="row">
    <div class="col-md-12"> -->


<div class="container">
<!-- <div style="overflow-x: auto;"> -->
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
                <a class="btn btn-xs btn-primary" href="{{ route('inputproject.create') }}">
                <img src="{{ asset('icons/addicon.svg') }}" alt="">
                 Inputan Project </a>

            </div>
        </div>
    </form>

    <br> </br>

    <a href="cetak_pdf" class="btn btn-primary my-3" target="#">CETAK PDF</a>
        <!-- <a href="cetak_pdf" class="btn btn-primary" target="#">CETAK PDF</a> -->
        &nbsp;
    <a href="export_excelinputproject" class="btn btn-success my-3" target="#">EXPORT EXCEL</a>

    <div class="table-responsive" id="table-menu">
        <table  class="table data-table table-striped table-hover table-bordered" id="table_reporting"
            data-url="{{ route('inputproject.index') }}"
            data-switchurl="{{ route('inputproject.status') }}"
            data-backurl="{{ route('inputproject.index') }}" style="width: 100% !important" >
            <thead>
            <tr>
            <th width="10%">No</th>
            <th class="actiontbl"> Action</th>
            <th>Nama Inisiatif</th>
            <th>Nama Pekerjaan</th>
            <th>Project Code</th>
            <th>IO</th>
            <th>No. Formulir Permintaan</th>
            <th>Permintaan Upload</th>
            <th>Nama vendor</th>
            <th>Status</th>
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

<script src="{{ asset('js/inputProject/inputProject.js') }}"></script>
