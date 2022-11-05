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
                        <label for="search">Search</label>
                        <input type="text" class="form-control" placeholder="masukan Code Project" id="code"
                            name="search">
                    </div>
                </div>


        </form>
        <br></br>

            <div class="table-responsive" id="table-menu">
                    <table class="table data-table table-striped table-hover table-bordered" id="table_reporting"
                        data-url="{{ route('reporting.index') }}" data-switchurl="{{ route('reporting.status') }}" data-backurl="{{ route('reporting.index') }}"
                        style="width: 100% !important" ">
                        <thead>
                            <tr>
                                <th width="10%">No</th>
                                <!-- <th>Action</th> -->
                                <th>Project Code</th>
                                <th>Nama Pekerjaan</th>
                                <!-- <th>Date</th> -->
                                <th>Approval Status</th>
                                <th>Status Approval PM</th>
                                <th>Approval PM</th>
                                <th>Status Approval P&P</th>
                                <th>Approval P&P</th>
                            </tr>
                        </thead>
                        <tbody id="tabel_result">

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

<script src="{{asset('js/reporting/reporting.js')}}"></script>



