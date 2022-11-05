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
            <li class="breadcrumb-item"><a href="{{ route('adp.index') }}"> {{ $title[1] }} </a></li>
            <li class="breadcrumb-item active">{{ $title[2] }}</li>
        </ol>
    </nav>

    <section class="card">
        <div class="card-header">
            <h4 class="card-title"></h4>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('adp.store') }}">
                @csrf
                <input type="hidden" name="data_id" id="data_id">


                @if(isset($adpById))
                    <input type="text" class="form-control" name="id" value="{{ $adpById->id }}" hidden>
                    <div class="row">
                    <div class="col-md-6">
                        <label>Nama Pekerjaan <span class="danger"></span></label>
                        <input type="text" class="form-control" name="namapekerjaan" value="{{ isset($adpById) ? $adpById['namapekerjaan'] : $id }}" hidden>

                        <input id="namapekerjaan" type="text" class="form-control @error('namapekerjaan') is-invalid @enderror"
                            name="namapekerjaan"
                            value="{{ isset($adpById) ? $adpById['jobname'] : $id }}"
                            required autocomplete="namapekerjaan" autofocus >

                        @error('namapekerjaan')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    </div>
                    <br></br>

                    <div class="row">
                    <div class="col-md-6">
                        <label>No Kontrak <span class="danger"></span></label>
                        <input type="text" class="form-control" name="nomorkontrak" value="{{ isset($adpById) ? $adpById['nomorkontrak'] : $id }}" hidden>

                        <input id="nomorkontrak" type="text" class="form-control @error('nomorkontrak') is-invalid @enderror"
                            name="nomorkontrak"
                            value="{{ isset($adpById) ? $adpById['contractnumber'] : $id }}"
                            required autocomplete="nomorkontrak" autofocus >

                        @error('nomorkontrak')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    </div>
                    <br></br>

                    <div class="row">
                    <div class="col-md-6">
                        <label>Nilai Adp Akhir Tahun <span class="danger"></span></label>
                        <input type="text" class="form-control" name="nilaiadpakhirtahun" value="{{ isset($adpById) ? $adpById['nilaiadpakhirtahun'] : $id }}" hidden>

                        <input id="nilaiadpakhirtahun" type="number" class="form-control @error('nilaiadpakhirtahun') is-invalid @enderror"
                            name="nilaiadpakhirtahun"
                            value="{{ isset($adpById) ? $adpById['valueadplastyear'] : $id }}"
                            required autocomplete="nilaiadpakhirtahun" autofocus >

                        @error('nilaiadpakhirtahun')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    </div>
                    <br></br>

                    <div class="row">
                    <div class="col-md-6">
                        <label>Pembentukan Formasi <span class="danger"></span></label>
                        <input type="text" class="form-control" name="formation_select" value="{{ isset($adpById) ? $adpById['nilaiadpakhirtahun'] : $id }}" hidden>

                        <select id="formation_select" name="formation_select" class="form-control col-md-12 @error('formation_select') is-invalid @enderror" style="width: 100% !important" id="formation_select">
                            @foreach($formationYears as $item)
                                <option value="{{ $item }}" {{ $item == $adpById->adpformationyear ? 'selected' : '' }}>{{ $item }}</option>
                            @endforeach
                            </select>

                        @error('formation_select')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    </div>
                    
                    <br></br>
                    <div class="row">
                    <div class="col-md-6">
                        <label>Nilai Realisasi ADP * <span class="danger"></span></label>
                        <input id="nilairealisasiadp" type="number" class="form-control @error('nilairealisasiadp') is-invalid @enderror"
                            name="nilairealisasiadp"
                            value="{{ isset($adpById) ? $adpById['valueadprealitation'] : $id }}"
                            required autocomplete="nilairealisasiadp" autofocus>


                        @error('nilairealisasiadp')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    
                </div>
                <br></br>
                    <div class="row">
                    @if($pic->count() < 1)


                    <div class="col-md-6">
                        <label>PIC <span class="danger">*</span></label>
                        <select id="pic_select" name="pic_select" class="form-control col-md-12 @error('pic_select') is-invalid @enderror" style="width: 100% !important" id="pic_select">
                            <option value="0">PIC</option>
                            
                        </select>
                        <div id="merah">* Data Kosong </div>

                        @error('pic_select')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror   
                    </div>
                    @else

                    <div class="col-md-6">
                        <label> PIC <span class="danger">*</span></label>
                        @if(!empty($UserPic))
                        <!--  -->
                        <select id="pic_select" name="pic_select" class="form-control col-md-12 @error('pic_select') is-invalid @enderror" style="width: 100% !important" id="pic_select">
                            <option value="0">Pilih PIC</option>
                            @foreach ($pic as $items)
                            <option value="{{ $items->id }}"
                            {{   $items->id == $UserPic->id  ? 'selected' : '' }}>
                            {{ $items->namadepan }}</option>
                            @endforeach
                        </select>

                        @elseif(empty($UserPic))
                            <select id="pic_select" name="pic_select" class="form-control col-md-12 @error('pic_select') is-invalid @enderror" style="width: 100% !important" >
                            <option value="0">Pilih PIC</option>
                            @foreach($pic as $id => $items)
                                <option value="{{ $items->id }}" {{ old('pic_select') == $items->id ? "selected" :""}}>
                                            {{ $items->namadepan }}</option>
                            @endforeach
                            </select>
                            <div id="merah">* Data Sebelumnya Kosong <br> &nbsp; Atau Telah Di   Hapus </div>
                        @endif

                        @error('pic_select')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>


                    @endif
                    
                    </div>
                    <br></br>

                  
            @else
                    <div class="row">
                    <div class="col-md-6">
                        <label>Nama Pekerjaan <span class="danger">*</span></label>
                        <input id="namapekerjaan" type="namapekerjaan" class="form-control @error('namapekerjaan') is-invalid @enderror"
                            name="namapekerjaan" value="{{ old('namapekerjaan') }}" required autocomplete="namapekerjaan">

                        @error('namapekerjaan')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    </div>
                    <br></br>

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
                    </div>
                    <br></br>
                   
                    <div class="row">
                    <div class="col-md-6">
                        <label>Nilai Adp Akhir Tahun <span class="danger">*</span></label>
                        <input id="nilaiadpakhirtahun" type="number" class="form-control @error('nilaiadpakhirtahun') is-invalid @enderror"
                            name="nilaiadpakhirtahun" value="{{ old('nilaiadpakhirtahun') }}" required autocomplete="nilaiadpakhirtahun"
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
                    <label> Pembentukan Formasi <span class="danger">*</span></label>
                    <select id="formation_select" name="formation_select" class="form-control col-md-12 @error('formation_select') is-invalid @enderror" style="width: 100% !important" id="formation_select">

                    <option value="0">Pilih Pembentukan Formasi</option>
                        @foreach ($formationYears as $itempic)
                        <option value="{{ $itempic }}">
                                    {{ $itempic }}</option>
                        @endforeach
                    </select>
                        @error('formation_select')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                    <br></br>
                   
                <div class="row">
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
                    <br></br>
               
                <div class="row">
                    <div class="col-md-6">
                    <label> PIC <span class="danger">*</span></label>
                    <!-- <select class="form-control" id="type" name="pic_select"> -->
                    <select id="pic_select" name="pic_select" class="form-control col-md-12 @error('pic_select') is-invalid @enderror" style="width: 100% !important" id="pic_select">

                    <option value="0">Pilih PIC</option>
                        @foreach ($pic as $itempic)
                        <option value="{{ $itempic->id }}">
                                    {{ $itempic->namadepan }}</option>
                        @endforeach
                    </select>
                        @error('pic_select')
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
                        <a href="{{ route('adp.index') }}">
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

<script src="{{ asset('js/master/project/adp.js') }}"></script>
