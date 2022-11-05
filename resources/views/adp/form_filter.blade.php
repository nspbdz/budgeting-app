<section class="card" style="border: solid 1px #2c6de9; margin-bottom: 10px;">
    <div class="card-header" style="background-color: #2c6de9;">
        <h4 class="card-title" style="color: white !important;">Pencarian</h4>
    </div>
    <div class="card-body">
        <br>
        <form method="POST" id="search_form" class="form-horizontal">
            <div class="row">
                <div class="col-md-4">
                    <!-- <label for="search">Kata Kunci</label> -->
                    <input type="text" class="form-control" placeholder="Masukkan Kata Kunci" id="search"
                        name="search">
                </div>
            <div class="col-md-2">

                <div class="btn-group float-right" >
                <button type="submit" class="btn btn-primary" data-toggle="tooltip" data-placement="bottom"
                    title="Cari Data"> <i class="bx bx-search"></i> Cari </button>
                <button type="reset" class="btn btn-warning" data-toggle="tooltip" id="reset_form"
                    data-placement="bottom" title="Reset Filter"><i class="bx bx-reset"></i> Reset
                </button>

                </div>

            </div>
                 <div class="col-md-6">
                 <div class="float-right">
                    <a class="btn btn-xs btn-primary" href="{{ route('asset.create') }}">
                        <img src="{{ asset('icons/addicon.svg') }}" alt="">
                        Asset </a>
                </div>
                 </div>
            </div>
        </form>
    </div>
</section>
