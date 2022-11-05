@extends('layouts.app')

@section('content')
<div class="container-fluid">

    <section class="card">

        <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                <!-- <div class="container-fluid"> -->
                    <div>
                        <div class="row">
                        <div class="col-md-6">
                            <label>Username <span class="danger">*</span></label>
                            <input id="username" type="text"
                                class="form-control @error('username') is-invalid @enderror" name="username"
                                value="{{ old('username') }}" required autocomplete="username"
                                autofocus>

                            @error('username')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label>Jabatan <span class="danger">*</span></label>
                            <input id="jabatan" type="jabatan"
                                class="form-control @error('jabatan') is-invalid @enderror" name="jabatan"
                                value="{{ old('jabatan') }}" required autocomplete="jabatan">

                            @error('jabatan')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <br> </br>

                    <div class="row">
                        <div class="col-md-6">
                            <label>Nama Depan <span class="danger">*</span></label>
                            <input id="namadepan" type="text"
                                class="form-control @error('namadepan') is-invalid @enderror" name="namadepan"
                                value="{{ old('namadepan') }}" required autocomplete="namadepan"
                                autofocus>

                            @error('namadepan')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label>Nama Belakang <span class="danger">*</span></label>
                            <input id="namabelakang" type="text"
                                class="form-control @error('namabelakang') is-invalid @enderror" name="namabelakang"
                                value="{{ old('namabelakang') }}" required autocomplete="namabelakang"
                                autofocus>

                            @error('namabelakang')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                    </div>
                    <br> </br>

                    <div class="row">
                        <div class="col-md-6">
                            <label>Password <span class="danger">*</span></label>
                            <input id="password" type="password"
                                class="form-control @error('password') is-invalid @enderror" name="password" required
                                autocomplete="new-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label>Confirmation Password <span class="danger">*</span></label>
                            <input id="password-confirm" type="password" class="form-control"
                                name="password_confirmation" required autocomplete="new-password">

                        </div>
                    </div>

                    <br> </br>

                    <div class="row">

                        <div class="col-md-6">
                            <label>NIP <span class="danger">*</span></label>
                            <input id="nip" type="nip" class="form-control @error('nip') is-invalid @enderror"
                                name="nip" value="{{ old('nip') }}" required autocomplete="nip">

                            @error('nip')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <!-- <label>Role <span class="danger">*</span></label>
                            <input id="role" type="role" class="form-control @error('role') is-invalid @enderror"
                                name="role" value="{{ old('role') }}" required autocomplete="role">

                            @error('role')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror -->
                        </div>

                    </div>
                    <br> </br>

                    <div class="row">

                        <div class="col-md-6">
                            <label>Nama Tim Leader <span class="danger">*</span></label>
                            <input id="namatimleader" type="namatimleader"
                                class="form-control @error('namatimleader') is-invalid @enderror" name="namatimleader"
                                value="{{ old('namatimleader') }}" required
                                autocomplete="namatimleader">

                            @error('namatimleader')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label>Nama Validator <span class="danger">*</span></label>
                            <input id="namavalidator" type="namavalidator"
                                class="form-control @error('namavalidator') is-invalid @enderror" name="namavalidator"
                                value="{{ old('namavalidator') }}" required
                                autocomplete="namavalidator">

                            @error('namavalidator')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                    </div>

                   </div>
                    <br> </br>
                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-5">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                                <a href="{{ route('login') }}">
                                <button type="button" class="btn btn-danger"> Login
                                </button>
                                </a>
                            </div>
                        </div>
                    </form>
        </div>
    </section>
    </div>


@endsection
