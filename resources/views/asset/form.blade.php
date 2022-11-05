@extends('layouts.template')

@section('menu-title')
@endsection

@section('breadcrumb')
@endsection

@section('content')
<?php
// dd($asset);
 ?>
<!-- <div class="row">
    <div class="col-md-12"> -->
     <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="bx bx-home"></i> Home </a></li>
            <li class="breadcrumb-item"><a href="{{ route('asset.index') }}"> {{ $title[1] }} </a></li>
            <li class="breadcrumb-item active">{{ $title[2] }}</li>
        </ol>
    </nav>

    <section class="card">
        <div class="card-header">
            <h4 class="card-title"></h4>
        </div>
        <div class="card-body">


            <form method="POST" action="{{ route('asset.store') }}">
                @csrf
                <input type="hidden" name="data_id" id="data_id">

                    @if(isset($assetById))
                        <input type="text" class="form-control" name="id" value="{{ $assetById->id }}" hidden>
                        <div class="row">

                        @if($project_select->count() < 1)
        
                    <div class="col-md-6">
                        <label>Project Code <span class="danger">*</span></label>
                        <select id="Pilih Project Code" name="Pilih Project Code" class="form-control col-md-12 @error('Pilih Project Code') is-invalid @enderror" style="width: 100% !important" id="Pilih Project Code">
                            <option value="0">Pilih Project Code</option>
                            
                        </select>
                        <div id="merah">* Data Kosong </div>

                        @error('Pilih Project Code')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror   
                    </div>
                    @else

                    <div class="col-md-6">
                        <label> Project Code <span class="danger">*</span></label>
                        @if($projectById != null)
                        <!--  --> 
                        <select id="project_select" name="project_select" class="form-control col-md-12 @error('project_select') is-invalid @enderror" style="width: 100% !important" id="project_select">
                            <option value="0">Pilih Project Code</option>
                            @foreach($project_select as $itemProject)
                                <option value="{{ $itemProject->id }}" {{ $itemProject->id == $projectById->id ? 'selected' : '' }}>{{ $itemProject->projectcode }}</option>
                            @endforeach
                        </select>

                        @elseif($projectById == null)

                            <select id="project_select" name="project_select" class="form-control col-md-12 @error('project_select') is-invalid @enderror" style="width: 100% !important" >
                            <option value="0">Pilih Project Code</option>
                            @foreach($project_select as $id => $itemDepHead)
                                <option value="{{ $itemDepHead->id }}" {{ old('project_select') == $itemDepHead->id ? "selected" :""}}>
                                            {{ $itemDepHead->projectcode }}</option>
                            @endforeach
                            </select>
                            <div id="merah">* Data Sebelumnya Kosong <br> &nbsp; Atau Telah Di   Hapus </div>
                        @endif

                        @error('project_select')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>


                    @endif
                        

                        

                        <div class="col-md-6">
                            <label>Master Asset <span class="danger">*</span></label>
                            <input id="masterasset" type="masterasset" class="form-control @error('masterasset') is-invalid @enderror"
                                name="masterasset" value="{{ isset($assetById) ? $assetById['masterasset'] : $id }}" required autocomplete="masterasset">

                            @error('masterasset')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>


                    </div>
                    <div class="row">

                        <div class="col-md-6">
                            <label>Nomor Master Asset <span class="danger">*</span></label>
                            <input id="projectname" type="projectname" class="form-control @error('projectname') is-invalid @enderror"
                                name="projectname" value="{{ isset($assetById) ? $assetById['projectname'] : $id }}"
                            required autocomplete="projectname" autofocus >
                            @error('projectname')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label> nama Pekerjaan <span class="danger">*</span></label>
                            <input id="jobname" type="text" class="form-control @error('jobname') is-invalid @enderror"
                                name="jobname" value="{{ isset($assetById) ? $assetById['jobname'] : $id }}"
                            required autocomplete="jobname" autofocus >

                            @error('jobname')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row">

                        <div class="col-md-6">
                            <label>Nomor Kontrak <span class="danger">*</span></label>
                            <input id="contractnumber" type="number" class="form-control @error('contractnumber') is-invalid @enderror"
                                name="contractnumber" value="{{ isset($assetById) ? $assetById['contractnumber'] : $id }}" required autocomplete="contractnumber" autofocus >


                            @error('contractnumber')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label> Nilai Kontrak <span class="danger">*</span></label>
                            <input id="contractvalue" type="number" class="form-control @error('contractvalue') is-invalid @enderror"
                                name="contractvalue" value="{{ isset($assetById) ? $assetById['contractvalue'] : $id }}"  required autocomplete="contractvalue" autofocus >

                            @error('contractvalue')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        </div>

                @else
                <div class="row">

                          <div class="col-md-6">
                            <label>Project Code <span class="danger"></span></label>
                            <select id="project_select" name="project_select" class="form-control col-md-12 @error('project_select') is-invalid @enderror" style="width: 100% !important" id="rekening_kas_select">
                                <option value="0">Pilih Proyek</option>
                                @foreach ($projectCode as $itemProject)
                                <option value="{{ $itemProject->id }}">
                                            {{ $itemProject->projectname }}</option>
                                @endforeach
                            </select>
                                <!-- <div>
                                @error('project_select')
                                <div style="width:200px" class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                @enderror -->
                                @error('project_select')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>

                        <div class="col-md-6">
                            <label>Master Asset <span class="danger">*</span></label>
                            <input id="masterasset" type="masterasset" class="form-control @error('masterasset') is-invalid @enderror"
                                name="masterasset" value="{{ old('masterasset') }}" required autocomplete="masterasset">

                            @error('masterasset')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                    </div>
                    <div class="row">

                        <div class="col-md-6">
                            <label>Project Name <span class="danger">*</span></label>
                            <input id="projectname" type="projectname" class="form-control @error('projectname') is-invalid @enderror"
                                name="projectname" value="{{ old('projectname') }}" required autocomplete="projectname">

                            @error('projectname')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label> nama Pekerjaan <span class="danger">*</span></label>
                            <input id="jobname" type="text" class="form-control @error('jobname') is-invalid @enderror"
                                name="jobname" value="{{ old('jobname') }}" required autocomplete="jobname"
                                autofocus>

                            @error('jobname')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row">

                        <div class="col-md-6">
                            <label>Nomor Kontrak <span class="danger">*</span></label>
                            <input id="contractnumber" type="number" class="form-control @error('contractnumber') is-invalid @enderror"
                                name="contractnumber" value="{{ old('contractnumber') }}" required autocomplete="contractnumber">

                            @error('contractnumber')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label> Nilai Kontrak <span class="danger">*</span></label>
                            <input id="contractvalue" type="number" class="form-control @error('contractvalue') is-invalid @enderror"
                                name="contractvalue" value="{{ old('contractvalue') }}" required autocomplete="contractvalue"
                                autofocus>

                            @error('contractvalue')
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
                        <a href="{{ route('asset.index') }}">
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

<script src="{{ asset('js/asset/asset.js') }}"></script>
