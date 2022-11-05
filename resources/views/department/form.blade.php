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
            <li class="breadcrumb-item"><a href="{{ route('department.index') }}"> {{ $title[1] }} </a></li>
            <li class="breadcrumb-item active">{{ $title[2] }}</li>
        </ol>
    </nav>

    <section class="card">
        <div class="card-header">
            <h4 class="card-title"></h4>
        </div>
        <div class="card-body">


            <form method="POST" action="{{ route('department.store') }}">
                @csrf
                <input type="hidden" name="data_id" id="data_id">
                @if(isset($departementById))
                <input type="text" class="form-control" name="id" value="{{ $departementById->id }}" hidden>


                    <input type="text" class="form-control" name="code" value="{{ $departementById->departementcode }}" hidden>
                    <div class="row">

                        <div class="col-md-6">
                            <label>Departement Code <span class="danger"></span></label>
                            <input id="code" type="text" class="form-control @error('code') is-invalid @enderror"
                                name="code"
                                value="{{ isset($departementById) ? $departementById['departementcode'] : $id }}"
                            required autocomplete="code" autofocus >

                            @error('code')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                       
                    </div>
                    <div class="row">
                    <div class="col-md-6">
                        <label>Departement Name <span class="danger"></span></label>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                name="name"
                                value="{{ isset($departementById) ? $departementById['name'] : $id }}"
                                required autocomplete="name" autofocus>

                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row">

                    @if($userDepartment == null)
    
                    <div class="col-md-6">
                        <label>Department Head <span class="danger">*</span></label>
                        <select id="departmentHead_select" name="departmentHead_select" class="form-control col-md-12 @error('departmentHead_select') is-invalid @enderror" style="width: 100% !important" id="departmentHead_select">
                            <option value="0">Department Head</option>
                            
                        </select>
                        <div id="merah">* Data Kosong </div>

                        @error('departmentHead_select')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror   
                    </div>
                    @else

                    <div class="col-md-6">
                        <label> Department Headss <span class="danger">*</span></label>
                        @if(!empty($departmentHeadById))
                        <!--  -->
                        <select id="departmentHead_select" name="departmentHead_select" class="form-control col-md-12 @error('departmentHead_select') is-invalid @enderror" style="width: 100% !important" id="departmentHead_select">
                            <option value="0">Pilih Department Head</option>
                            @foreach ($userDepartment as $dephead)
                            <option value="{{ $dephead->id }}"
                            {{   $dephead->id == $departementById->departmenthead ? 'selected' : '' }}>
                            {{ $dephead->namadepan }}</option>
                            @endforeach
                        </select>

                        @elseif(empty($departmentHeadById))
                            <select id="departmentHead_select" name="departmentHead_select" class="form-control col-md-12 @error('departmentHead_select') is-invalid @enderror" style="width: 100% !important" >
                            <option value="0">Pilih Department Header</option>
                            @foreach($userDepartment as $id => $itemDepHead)
                                <option value="{{ $itemDepHead->id }}" {{ old('departmentHead_select') == $itemDepHead->id ? "selected" :""}}>
                                            {{ $itemDepHead->namadepan }}</option>
                            @endforeach
                            </select>
                            <div id="merah">* Data Sebelumnya Kosong <br> &nbsp; Atau Telah Di   Hapus </div>
                        @endif

                        @error('departmentHead_select')
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
                            <label>Departement Code <span class="danger">*</span></label>
                            <input id="code" type="code" class="form-control @error('code') is-invalid @enderror"
                                name="code" value="{{ old('code') }}" required autocomplete="code">

                            @error('code')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                       
                    </div>
                    <div class="row">
                    <div class="col-md-6">
                            <label>Departement name <span class="danger">*</span></label>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                name="name" value="{{ old('name') }}" required autocomplete="name"
                                autofocus>

                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                  

                        <div class="col-md-6">
                            <label>Departement Head <span class="danger"></span></label>
                            <select id="departmentHead_select" name="departmentHead_select" class="form-control col-md-12 @error('departmentHead_select') is-invalid @enderror" style="width: 100% !important" id="rekening_kas_select">
                                <option value="0">Pilih Department Head</option>
                                @foreach ($departmentHead as $itemDepartmentHead)
                                <option value="{{ $itemDepartmentHead->id }}">
                                            {{ $itemDepartmentHead->namadepan }}</option>
                                @endforeach
                            </select>
                                @error('departmenthead_select')
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
                        <a href="{{ route('department.index') }}">
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

<script src="{{ asset('js/departement/department.js') }}"></script>
