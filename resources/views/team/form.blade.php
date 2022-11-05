@extends('layouts.template')

@section('menu-title')
@endsection

@section('breadcrumb')
@endsection

@section('content')
<?php
// dd($teamLeader);
 ?>
<!-- <div class="row">
    <div class="col-md-12"> -->
     <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="bx bx-home"></i> Home </a></li>
            <li class="breadcrumb-item"><a href="{{ route('team.index') }}"> {{ $title[1] }} </a></li>
            <li class="breadcrumb-item active">{{ $title[2] }}</li>
        </ol>
    </nav>

    <section class="card">
        <div class="card-header">
            <h4 class="card-title"></h4>
        </div>
        <div class="card-body">


            <form method="POST" action="{{ route('team.store') }}">
                @csrf
                <input type="hidden" name="data_id" id="data_id">


                @if(isset($teamById))
                    <input type="text" class="form-control" name="id" value="{{ $teamById->id }}" hidden>
                    
                       <div class="row">
                        <div class="col-md-6">
                            <label>Nama Team <span class="danger"></span></label>
                            <input id="code" type="text" class="form-control @error('code') is-invalid @enderror"
                                name="name"
                                value="{{ isset($teamById) ? $teamById['name'] : $id }}"
                            required autocomplete="code" autofocus >

                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        </div>
                        <br></br>


                        <div class="row">
                        @if($userDepartment->count() < 1)
    
                        <div class="col-md-6">
                                <label>Department Head <span class="danger">*</span></label>
                                <select id="departement_select" name="departement_select" class="form-control col-md-12 @error('departement_select') is-invalid @enderror" style="width: 100% !important" id="departement_select">
                                    <option value="0">Department Head</option>
                                    
                                </select>
                                <div id="merah">* Data Kosong </div>

                                @error('departement_select')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror   
                            </div>
                            @else

                            <div class="col-md-6">
                                <label> Department  <span class="danger">*</span></label>
                                @if(!empty($teamDepartementById))
                                <!--  -->
                                <select id="departement_select" name="departement_select" class="form-control col-md-12 @error('departement_select') is-invalid @enderror" style="width: 100% !important" id="departement_select">
                                    <option value="0">Pilih Department </option>
                                    @foreach ($userDepartment as $itemDepartment)
                                    <option value="{{ $itemDepartment->id }}"
                                {{   $itemDepartment->id == $teamDepartementById['id'] ? 'selected' : '' }}>
                                {{ $itemDepartment->name }}</option>
                                    @endforeach
                                </select>

                                @elseif(empty($teamDepartementById))
                                    <select id="departement_select" name="departement_select" class="form-control col-md-12 @error('departement_select') is-invalid @enderror" style="width: 100% !important" >
                                    <option value="0">Pilih Department </option>
                                    @foreach($userDepartment as $id => $itemDepHead)
                                        <option value="{{ $itemDepHead->id }}" {{ old('departement_select') == $itemDepHead->id ? "selected" :""}}>
                                                    {{ $itemDepHead->name }}</option>
                                    @endforeach
                                    </select>
                                    <div id="merah">* Data Sebelumnya Kosong <br> &nbsp; Atau Telah Di   Hapus </div>
                                @endif

                                @error('departement_select')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>


                            @endif
                        </div>
                        <br></br>


                        <div class="row">

                        @if($teamLeader->count() < 1)


                        <div class="col-md-6">
                            <label>Team Leader <span class="danger">*</span></label>
                            <select id="teamLeader_select" name="teamLeader_select" class="form-control col-md-12 @error('teamLeader_select') is-invalid @enderror" style="width: 100% !important" id="teamLeader_select">
                                <option value="0">Team Leader</option>
                                
                            </select>
                            <div id="merah">* Data Kosong </div>

                            @error('teamLeader_select')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror   
                        </div>
                        @else

                        <div class="col-md-6">
                            <label> Team Leader <span class="danger">*</span></label>
                            @if(!empty($teamLeaderById))
                            <!--  -->
                            <select id="teamLeader_select" name="teamLeader_select" class="form-control col-md-12 @error('teamLeader_select') is-invalid @enderror" style="width: 100% !important" id="teamLeader_select">
                                <option value="0">Pilih Team Leader</option>
                                @foreach ($teamLeader as $items)
                                <option value="{{ $items->id }}"
                                {{   $items->id == 1 ? 'selected' : '' }}>
                                {{ $items->namadepan }}</option>
                                @endforeach
                            </select>

                            @elseif(empty($teamLeaderById))
                                <select id="teamLeader_select" name="teamLeader_select" class="form-control col-md-12 @error('teamLeader_select') is-invalid @enderror" style="width: 100% !important" >
                                <option value="0">Pilih Team Leader</option>
                                @foreach($teamLeader as $id => $items)
                                    <option value="{{ $items->id }}" {{ old('teamLeader_select') == $items->id ? "selected" :""}}>
                                                {{ $items->namadepan }}</option>
                                @endforeach
                                </select>
                                <div id="merah">* Data Sebelumnya Kosong <br> &nbsp; Atau Telah Di   Hapus </div>
                            @endif

                            @error('teamLeader_select')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>


                        @endif

                        </div>



                @else
                <div class="row">
                            
                <div class="col-md-6">
                            <label> nama Team <span class="danger">*</span></label>
                            <input id="namateam" type="text" class="form-control @error('namateam') is-invalid @enderror"
                                name="namateam" value="{{ old('namateam') }}" required autocomplete="namateam"
                                autofocus>

                            @error('namateam')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        </div>
                        <br> </br>
                    <div class="row">
                    <div class="col-md-6">
                            <label>Departement  <span class="danger"></span></label>
                            <select id="departement_select" name="departement_select" class="form-control col-md-12 @error('departement_select') is-invalid @enderror" style="width: 100% !important" id="rekening_kas_select">
                                <option value="0">Pilih Departement</option>
                                @foreach ($departement as $itemDepartement)
                                <option value="{{ $itemDepartement->id }}">
                                            {{ $itemDepartement->name }}</option>
                                @endforeach
                            </select>
                                @error('departement_select')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
                       
                    </div>
                    <br> </br>

                    <div class="row">
                     

                        <div class="col-md-6">
                            <label>Team Leader  <span class="danger"></span></label>
                            <select id="teamLeader_select" name="teamLeader_select" class="form-control col-md-12 @error('teamLeader_select') is-invalid @enderror" style="width: 100% !important" id="rekening_kas_select">
                                <option value="0">Pilih Team Leader</option>
                                @foreach ($teamLeader as $itemTeamLeader)
                                <option value="{{ $itemTeamLeader->id }}">
                                            {{ $itemTeamLeader->namadepan }}</option>
                                @endforeach
                            </select>
                                @error('teamLeader_select')
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
                        <a href="{{ route('team.index') }}">
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

<script src="{{ asset('js/team/team.js') }}"></script>
