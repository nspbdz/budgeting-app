@extends('layouts.template')

@section('menu-title')
@endsection

@section('breadcrumb')
@endsection

@section('content')
<?php
// dd($user);
 ?>
<!-- <div class="row">
    <div class="col-md-12"> -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="bx bx-home"></i> Home </a></li>
            <li class="breadcrumb-item"><a href="{{ route('project.index') }}"> {{ $title[1] }} </a></li>
            <li class="breadcrumb-item active">{{ $title[2] }}</li>
        </ol>
    </nav>

    <section class="card">
        <div class="card-header">
            <h4 class="card-title"></h4>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('project.store') }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="data_id" id="data_id">


                @if(isset($projectById))
                    <input type="text" class="form-control" name="id" value="{{ $projectById->id }}" hidden>
                    <div class="row">

                    <div class="col-md-6">
                        <label>Project Code <span class="danger">*</span></label>
                        <input id="projectcode" type="projectcode" class="form-control @error('projectcode') is-invalid @enderror"
                            name="projectcode"  value="{{ isset($projectById) ? $projectById['projectcode'] : $id }}"  required autocomplete="projectcode">

                        @error('projectcode')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>


                    <div class="col-md-6">
                        <label> Nilai Feasibility Study <span class="danger">*</span></label>
                        <input id="nilaifs" type="file" class="form-control @error('nilaifs') is-invalid @enderror"
                            name="nilaifs" value="{{ old('nilaifs') }}"  autocomplete="nilaifs"
                            autofocus>

                        @error('nilaifs')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    </div>
                    <br></br>
                    <div class="row">

                    <div class="col-md-6">
                        <label>Sub Project Code <span class="danger">*</span></label>
                        <input id="subprojectcode" type="subprojectcode" class="form-control @error('subprojectcode') is-invalid @enderror"
                            name="subprojectcode" value="{{ isset($projectById) ? $projectById['subprojectcode'] : $id }}"  required autocomplete="subprojectcode">

                        @error('subprojectcode')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>


                    <div class="col-md-6">
                        <label> Tahun Feasibility Study <span class="danger">*</span></label>
                        <select id="tahunfs_select" name="tahunfs_select" class="form-control col-md-12 @error('tahunfs_select') is-invalid @enderror" style="width: 100% !important" id="tahunfs_select">
                       
                        <option value="0">Pilih Tahun Feasibility Study</option>
                        @foreach($tahunfs as $itemTahunFs)
                            <option value="{{ $itemTahunFs }}" {{ $itemTahunFs == $projectById->fsyear ? 'selected' : '' }}>
                             {{ $itemTahunFs }}</option>
                        @endforeach
                        </select>

                        @error('tahunfs_select')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    </div>
                    <br></br>

                    <div class="row">
                    <div class="col-md-6">
                    <label> Nama Inisiatif <span class="danger">*</span></label>
                    <input id="initiativename" type="text" class="form-control @error('initiativename') is-invalid @enderror"
                        name="initiativename" value="{{ isset($projectById) ? $projectById['initiativename'] : $id }}"  required autocomplete="initiativename"
                        autofocus>

                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    </div>

                    <div class="col-md-6">
                    <label> Target Live <span class="danger">*</span></label>
                    
                    <input id="targetlive" type="date" class="form-control @error('targetlive') is-invalid @enderror"
                        name="targetlive" value="{{ isset($projectById) ? $projectById['targetlive'] : $id }}"  required autocomplete="targetlive"
                        autofocus>

                    @error('targetlive')
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
                        <input id="projectname" type="text" class="form-control @error('projectname') is-invalid @enderror"
                            name="projectname" value="{{ isset($projectById) ? $projectById['projectname'] : $id }}" required autocomplete="projectname"
                            autofocus>

                        @error('projectname')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label> Tahun Alokasi Anggaran <span class="danger">*</span></label>
                        <select id="tahunalokasianggaran_select" name="tahunalokasianggaran_select" class="form-control col-md-12 @error('tahunalokasianggaran_select') is-invalid @enderror" style="width: 100% !important" id="tahunalokasianggaran_select">
                        <option value="0">Pilih Tahun Alokasi Anggaran</option>
                        @foreach($tahunalokasianggaran as $id => $itemTahunAlokasiAnggaran)
                            <option value="{{ $itemTahunAlokasiAnggaran }}" {{ $itemTahunAlokasiAnggaran == $projectById->budgetallocationyear ? 'selected' : '' }}>
                                        {{ $itemTahunAlokasiAnggaran }}</option>
                        @endforeach
                        </select>
                            @error('tahunalokasianggaran_select')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                    </div>

                    </div>
                    <br></br>

                    <div class="row">
                    <div class="col-md-6">
                    <label> Alokasi Anggaran <span class="danger">*</span></label>
                        <input id="alokasianggaran" type="text" class="form-control @error('alokasianggaran') is-invalid @enderror"
                            name="alokasianggaran" value="{{ isset($projectById) ? $projectById['budgetallocation'] : $id }}" required autocomplete="alokasianggaran"
                            autofocus>

                        @error('alokasianggaran')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <br></br>
                    <div class="col-md-6">
                    <label> Target Alokasi Anggaran <span class="danger">*</span></label>
                        <input id="targetalokasianggaran" type="date" class="form-control @error('targetalokasianggaran') is-invalid @enderror"
                            name="targetalokasianggaran"  value="{{ isset($projectById) ? $projectById['budgetallocationtarget'] : $id }}"   required autocomplete="targetalokasianggaran"
                            autofocus>

                        @error('targetalokasianggaran')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    </div>
                    <br></br>



                    <div class="row">
                    @if($user->count() < 1)
                        <div class="col-md-6">
                            <label>PIC<span class="danger"></span></label>
                            <select id="pic_select" name="pic_select" class="form-control col-md-12 @error('pic_select') is-invalid @enderror" style="width: 100% !important" id="rekening_kas_select">
                                <option value="0">Pilih User</option>
                            </select>
                                @error('pic_select')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>

                    @else
                        <div class="col-md-6">

                             <label>PIC<span class="danger"></span></label>
                      

                            @error('pic_select')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        @endif

                    <!-- <div class="col-md-6">
                        <label>PIC<span class="danger"></span></label>
                        <select id="pic_select" name="pic_select" class="form-control col-md-12 @error('pic_select') is-invalid @enderror" style="width: 100% !important" id="rekening_kas_select">
                            <option value="0">Pilih User</option>
                            @foreach ($user as $itemUser)
                            <option value="{{ $itemUser->id }}" {{ $itemUser->id == $projectById->pic ? 'selected' : '' }}>
                                        {{ $itemUser->namadepan}}</option>
                            @endforeach                        
                        </select>
                            @error('pic_select')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                    </div> -->


    
                    <div class="col-md-6">
                        <label>Metoe Pembayaran <span class="danger"></span></label>
                        <select id="pembayaran_select" name="pembayaran_select" class="form-control col-md-12 @error('pembayaran_select') is-invalid @enderror" style="width: 100% !important" id="rekening_kas_select">
                            <option value="0">Pilih Pembayaran</option>
                            @foreach ($pembayaran as $itemPembayaran)
                            <option value="{{ $itemPembayaran }}" {{ $itemPembayaran == $projectById->paymentmethode ? 'selected' : '' }}>
                                       {{ $itemPembayaran }}</option>
                            @endforeach
                        </select>
                    
                            @error('pembayaran_select')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                    </div>


                    </div>


<!--                     
                    <div class="row">

                        <div class="col-md-4">
                            <label>code <span class="danger"></span></label>
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

                        <div class="col-md-4">
                            <label>nama Projek <span class="danger"></span></label>
                            <input id="projectname" type="text" class="form-control @error('projectname') is-invalid @enderror"
                                name="projectname"
                                value="{{ isset($project) ? $project['projectname'] : $id }}"
                                required autocomplete="projectname" autofocus>

                            @error('projectname')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label>Nama Inisiatif <span class="danger"></span></label>
                            <input id="initiativename" type="text" class="form-control @error('initiativename') is-invalid @enderror"
                                name="initiativename"
                                value="{{ isset($project) ? $project['initiativename'] : $id }}"
                                required autocomplete="initiativename" autofocus>

                            @error('initiativename')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>


                    </div> -->

                @else
                    <div class="row">

                        <div class="col-md-6">
                            <label>Project Code <span class="danger">*</span></label>
                            <input id="projectcode" type="projectcode" class="form-control @error('projectcode') is-invalid @enderror"
                                name="projectcode" value="{{ old('projectcode') }}" required autocomplete="projectcode">

                            @error('projectcode')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        
                        <div class="col-md-6">
                            <label> Nilai Feasibility Study <span class="danger">*</span></label>
                            <input id="nilaifs" type="file" class="form-control @error('nilaifs') is-invalid @enderror"
                                name="nilaifs" value="{{ old('nilaifs') }}" required autocomplete="nilaifs"
                                autofocus>

                            @error('nilaifs')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <br></br>
                    <div class="row">

                        <div class="col-md-6">
                            <label>Sub Project Code <span class="danger">*</span></label>
                            <input id="subprojectcode" type="subprojectcode" class="form-control @error('subprojectcode') is-invalid @enderror"
                                name="subprojectcode" value="{{ old('subprojectcode') }}" required autocomplete="subprojectcode">

                            @error('subprojectcode')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        
                        <div class="col-md-6">
                            <label> Tahun Feasibility Study <span class="danger">*</span></label>
                            <select id="tahunfs_select" name="tahunfs_select" class="form-control col-md-12 @error('tahunfs_select') is-invalid @enderror" style="width: 100% !important" id="tahunfs_select">
                            <option value="0">Pilih Tahun Feasibility Study</option>
                            @foreach($tahunfs as $id => $itemTahunFs)
                                <option value="{{ $itemTahunFs }}" {{ old('tahunfs_select') == $itemTahunFs ? "selected" :""}}>
                                            {{ $itemTahunFs }}</option>
                            @endforeach
                            </select>
                                @error('tahunfs_select')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
                    </div>
                    <br></br>
                  
                    <div class="row">
                    <div class="col-md-6">
                        <label> Nama Inisiatif <span class="danger">*</span></label>
                        <input id="initiativename" type="text" class="form-control @error('initiativename') is-invalid @enderror"
                            name="initiativename" value="{{ old('initiativename') }}" required autocomplete="initiativename"
                            autofocus>

                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label> Target Live <span class="danger">*</span></label>
                        <input id="targetlive" type="date" class="form-control @error('targetlive') is-invalid @enderror"
                            name="targetlive" value="{{ old('targetlive') }}" required autocomplete="targetlive"
                            autofocus>

                        @error('targetlive')
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
                            <input id="projectname" type="text" class="form-control @error('projectname') is-invalid @enderror"
                                name="projectname" value="{{ old('projectname') }}" required autocomplete="projectname"
                                autofocus>

                            @error('projectname')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label> Tahun Alokasi Anggaran <span class="danger">*</span></label>
                            <select id="tahunalokasianggaran_select" name="tahunalokasianggaran_select" class="form-control col-md-12 @error('tahunalokasianggaran_select') is-invalid @enderror" style="width: 100% !important" id="tahunalokasianggaran_select">
                            <option value="0">Pilih Tahun Alokasi Anggaran</option>
                            @foreach($tahunalokasianggaran as $id => $itemTahunAlokasiAnggaran)
                                <option value="{{ $itemTahunAlokasiAnggaran }}" {{ old('tahunalokasianggaran_select') == $itemTahunAlokasiAnggaran ? "selected" :""}}>
                                            {{ $itemTahunAlokasiAnggaran }}</option>
                            @endforeach
                            </select>
                                @error('tahunalokasianggaran_select')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
                     
                    </div>
                    <br></br>

                    <div class="row">
                        <div class="col-md-6">
                        <label> Alokasi Anggaran <span class="danger">*</span></label>
                            <input id="alokasianggaran" type="text" class="form-control @error('alokasianggaran') is-invalid @enderror"
                                name="alokasianggaran" value="{{ old('alokasianggaran') }}" required autocomplete="alokasianggaran"
                                autofocus>

                            @error('alokasianggaran')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                    <br></br>
                        <div class="col-md-6">
                        <label> Target Alokasi Anggaran <span class="danger">*</span></label>
                            <input id="targetalokasianggaran" type="date" class="form-control @error('targetalokasianggaran') is-invalid @enderror"
                                name="targetalokasianggaran" value="{{ old('targetalokasianggaran') }}" required autocomplete="targetalokasianggaran"
                                autofocus>

                            @error('targetalokasianggaran')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <br></br>

                    <div class="row">
                    <div class="col-md-6">
                            <label>PIC<span class="danger"></span></label>
                            <select id="pic_select" name="pic_select" class="form-control col-md-12 @error('pic_select') is-invalid @enderror" style="width: 100% !important" id="rekening_kas_select">
                                <option value="0">Pilih User</option>
                                @foreach ($user as $itemUser)
                                <option value="{{ $itemUser->id }}" {{ old('pic_select') == $itemUser->id ? "selected" :""}}>
                                            {{ $itemUser->namadepan }}</option>
                                @endforeach

                               
                            </select>
                                @error('pic_select')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
                       
                         <div class="col-md-6">
                            <label>Metoe Pembayaran <span class="danger"></span></label>
                            <select id="pembayaran_select" name="pembayaran_select" class="form-control col-md-12 @error('pembayaran_select') is-invalid @enderror" style="width: 100% !important" id="rekening_kas_select">
                                <option value="0">Pilih Pembayaran</option>
                                @foreach ($pembayaran as $itemPembayaran)
                                <option value="{{ $itemPembayaran }}" {{ old('pembayaran_select') == $itemPembayaran ? "selected" :""}}>
                                            {{ $itemPembayaran }}</option>
                                @endforeach
                            </select>
                          
                                @error('pembayaran_select')
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
                        <a href="{{ route('project.index') }}">
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

<script src="{{ asset('js/master/project/project.js') }}"></script>
