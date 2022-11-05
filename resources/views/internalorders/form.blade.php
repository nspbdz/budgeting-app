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
            <li class="breadcrumb-item"><a href="{{ route('internalorder.index') }}"> {{ $title[1] }} </a></li>
            <li class="breadcrumb-item active">{{ $title[2] }}</li>
        </ol>
    </nav>
    <section class="card">
        <div class="card-header">
            <h4 class="card-title"></h4>
        </div>
        <div class="card-body">


            <form method="POST" action="{{ route('internalorder.store') }}">
                @csrf
                <input type="hidden" name="data_id" id="data_id">


                @if(isset($IOById))
                    <input type="text" class="form-control" name="id" value="{{ $IOById->id }}" hidden>
                    <div class="row">
                        @if($project->count() < 1)
        
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
                            @if(!empty($ProjectByIO))
                            <!--  --> 
                            <select id="projectCode_select" name="projectCode_select" class="form-control col-md-12 @error('projectCode_select') is-invalid @enderror" style="width: 100% !important" id="projectCode_select">
                                <option value="0">Pilih Project Code</option>
                                @foreach($project as $itemProject)
                                    <option value="{{ $itemProject->id }}" {{ $itemProject->id == $ProjectByIO->id ? 'selected' : '' }}>{{ $itemProject->projectcode }}</option>
                                @endforeach
                            </select>

                            @elseif(empty($ProjectByIO))
                                <select id="projectCode_select" name="projectCode_select" class="form-control col-md-12 @error('projectCode_select') is-invalid @enderror" style="width: 100% !important" >
                                <option value="0">Pilih Project Code</option>
                                @foreach($project as $id => $itemDepHead)
                                    <option value="{{ $itemDepHead->id }}" {{ old('projectCode_select') == $itemDepHead->id ? "selected" :""}}>
                                                {{ $itemDepHead->projectcode }}</option>
                                @endforeach
                                </select>
                                <div id="merah">* Data Sebelumnya Kosong <br> &nbsp; Atau Telah Di   Hapus </div>
                            @endif

                            @error('projectCode_select')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>


                        @endif
                      
                    </div>
                    <br>
                    <div class="row">
                    <div class="col-md-6">
                        <label> Nama Io <span class="danger"></span></label>
                            <input id="namaio" type="text" class="form-control @error('namaio') is-invalid @enderror"
                                name="namaio" value="{{ isset($IOById) ? $IOById['name'] : $id }}" required autocomplete="namaio"
                                autofocus>

                            @error('namaio')
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
                            <select id="projectCode_select" name="projectCode_select" class="form-control col-md-12 @error('projectCode_select') is-invalid @enderror" style="width: 100% !important" id="projectCode_select">
                                <option value="0">Pilih Project Code</option>
                                @foreach ($projectCode as $item)
                                <option value="{{ $item->id }}">
                                            {{ $item->projectcode }}</option>
                                @endforeach
                            </select>

                                @error('projectCode_select')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>

                       
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label> Nama Io <span class="danger">*</span></label>
                            <input id="namaio" type="text" class="form-control @error('namaio') is-invalid @enderror"
                                name="namaio" value="{{ old('namaio') }}" required autocomplete="namaio"
                                autofocus>

                            @error('namaio')
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

<script src="{{ asset('js/internalorder/internalorder.js') }}"></script>
