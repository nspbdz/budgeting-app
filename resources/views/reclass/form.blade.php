@extends('layouts.template')

@section('menu-title')
@endsection

@section('breadcrumb')
@endsection

@section('content')
<?php
 ?>
<!-- <div class="row">
    <div class="col-md-12"> -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="bx bx-home"></i> Home </a></li>
            <li class="breadcrumb-item"><a href="{{ route('reclass.index') }}"> {{ $title[1] }} </a></li>
            <li class="breadcrumb-item active">{{ $title[2] }}</li>
        </ol>
    </nav>

    <section class="card">
        <div class="card-header">
            <h4 class="card-title"></h4>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('reclass.store') }}">
                @csrf
                <input type="hidden" name="data_id" id="data_id">


                @if(isset($project))
                    <input type="text" class="form-control" name="id" value="{{ $project->id }}" hidden>
                    <div class="row">

                        <div class="col-md-6">
                            <label>Project Code <span class="danger"></span></label>
                            <input type="text" class="form-control" name="projectcode" value="{{ isset($project) ? $project['projectcode'] : $id }}" hidden>

                            <input id="projectcode" type="text" class="form-control @error('projectcode') is-invalid @enderror"
                                name="projectcode"
                                value="{{ isset($project) ? $project['projectcode'] : $id }}"
                                required autocomplete="projectcode" autofocus disabled>

                            @error('projectcode')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label>Nilai Kontrak <span class="danger"></span></label>
                            <input id="nilaikontrak" type="text" class="form-control @error('nilaikontrak') is-invalid @enderror"
                                name="nilaikontrak"
                                value="{{ isset($project) ? $project['nilaikontrak'] : $id }}"
                                required autocomplete="nilaikontrak" autofocus>

                            @error('nilaikontrak')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                    </div>
                    <div class="row">

                    <div class="col-md-6">
                            <label>Master Aset <span class="danger"></span></label>
                            <input id="masteraset" type="text" class="form-control @error('masteraset') is-invalid @enderror"
                                name="masteraset"
                                value="{{ isset($project) ? $project['masteraset'] : $id }}"
                                required autocomplete="masteraset" autofocus>

                            @error('masteraset')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label>Nilai Realisasi <span class="danger"></span></label>
                            <input id="nilairealisasi" type="text" class="form-control @error('nilairealisasi') is-invalid @enderror"
                                name="nilairealisasi"
                                value="{{ isset($project) ? $project['nilairealisasi'] : $id }}"
                                required autocomplete="nilairealisasi" autofocus>

                            @error('nilairealisasi')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        </div>
                        <div class="row">

                <div class="col-md-6">
                    <label>Nama Project <span class="danger"></span></label>
                    <input id="namaproject" type="text" class="form-control @error('namaproject') is-invalid @enderror"
                        name="namaproject"
                        value="{{ isset($project) ? $project['namaproject'] : $id }}"
                        required autocomplete="namaproject" autofocus>

                    @error('namaproject')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                </div>
                <div class="row">

                <div class="col-md-6">
                    <label>Nama Kontrak <span class="danger"></span></label>
                    <input id="namakontrak" type="text" class="form-control @error('namakontrak') is-invalid @enderror"
                        name="namakontrak"
                        value="{{ isset($project) ? $project['namakontrak'] : $id }}"
                        required autocomplete="namakontrak" autofocus>
                    @error('namakontrak')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                </div>

                @else
                    <div class="row">

                        <div class="col-md-6">
                            <label>No Kontrak <span class="danger">*</span></label>
                            <input id="nomorkontrak" type="nomorkontrak" class="form-control @error('nomorkontrak') is-invalid @enderror"
                                name="nomorkontrak" value="{{ old('nomorkontrak') }}" required autocomplete="nomorkontrak">

                            @error('nomorkontrak')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label> Tahun <span class="danger">*</span></label>
                            <input id="tahun" type="text" class="form-control @error('tahun') is-invalid @enderror"
                                name="tahun" value="{{ old('tahun') }}" required autocomplete="tahun"
                                autofocus>

                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                    </div>
                    <br></br>
                   <div class="row">
                        <div class="col-md-6">
                        <label> nama project <span class="danger">*</span></label>
                            <input id="nilaiadp" type="text" class="form-control @error('nilaiadp') is-invalid @enderror"
                                name="nilaiadp" value="{{ old('nilaiadp') }}" required autocomplete="nilaiadp"
                                autofocus>

                            @error('nilaiadp')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                        <label> Nilai Realisasi ADP <span class="danger">*</span></label>
                            <input id="nilairealisasiadp" type="number" class="form-control @error('nilairealisasiadp') is-invalid @enderror"
                                name="nilairealisasiadp" value="{{ old('nilairealisasiadp') }}" required autocomplete="nilairealisasiadp"
                                autofocus>

                            @error('nilairealisasiadp')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                @endif
            <br>
                <div class="row mb-0">
                    <div class="col-md-12 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Submit') }}
                        </button>
                        <a href="{{ route('reclass.index') }}">
                     <button type="button" class="btn btn-danger"> Cancel
                    </button>
                    </a>
                    </div>
                </div>
            </form>


        </div>
    </section>




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

<script src="{{ asset('js/master/project/reclass.js') }}"></script>
