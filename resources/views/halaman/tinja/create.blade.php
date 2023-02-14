<x-base-layout :scrollspy="false">

  <x-slot:pageTitle>
    {{ $title }}
    </x-slot>

    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <x-slot:headerFiles>
      <!--  BEGIN CUSTOM STYLE FILE  -->
      <link rel="stylesheet" type="text/css" href="{{ asset('plugins/tomSelect/tom-select.default.min.css') }}">

      <!--  END CUSTOM STYLE FILE  -->
      </x-slot>
      <!-- END GLOBAL MANDATORY STYLES -->

      <!-- BREADCRUMB -->
      <div class="page-meta">
        <nav class="breadcrumb-style-one" aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Tambah</a></li>
            <li class="breadcrumb-item active" aria-current="page">Kwitansi Tinja</li>
          </ol>
        </nav>
      </div>
      <!-- /BREADCRUMB -->
      <div class="seperator-header layout-top-spacing">
        <h4 class="">Tambah Kwitansi Tinja</h4>
      </div>

      <!-- /FORM TAMBAH -->
      <div class="row">
        <div class="col-xl-12 col-lg-12 col-sm-12 layout-spacing">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Tinja</h5>
              <form id="input" class="simple-example needs-validation" method="post"
                    action="{{ route('tinja.store') }}" novalidate>
                @csrf
                <div class="form-row">
                  <div class="row">
                    <div class="col-md-4 mb-4">
                      <label for="nomor">Nomor</label>
                      <input type="text" class="form-control" id="nomor" name="nomor"
                             placeholder="Nomor Kwitansi" value="" required>
                      <div class="invalid-feedback">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6 mb-4">
                      <label for="nama">Nama</label>
                      <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama"
                             value="" required>
                      <div class="invalid-feedback">
                      </div>
                    </div>
                    <div class="col-md-4 mb-4">
                      <label for="nominal">Nominal</label>
                      <input type="number" class="form-control" id="nominal" name="nominal" placeholder="Nominal Pembayaran"
                             value="" required>
                      <div class="invalid-feedback">
                      </div>
                    </div>
                    <div class="col-md-2 mb-4">
                        <label for="jumlah">Jumlah</label>
                        <input type="number" class="form-control" id="jumlah" name="jumlah" placeholder="Jumlah"
                               value="" required>
                        <div class="invalid-feedback">
                        </div>
                      </div>
                    <div class="col-md-12 mb-4">
                      <label for="pembayaran">Pembayaran</label>
                      <textarea class="form-control" name="pembayaran" placeholder="Uraian Pembayaran"></textarea>
                      <div class="invalid-feedback">
                      </div>
                    </div>
                  </div>
                </div>
                  <button class="btn btn-primary submit-fn mt-2" type="submit">Submit form</button>
              </form>
            </div>
          </div>
        </div>
      </div>
      </div>

      <!--  BEGIN CUSTOM SCRIPTS FILE  -->
      <x-slot:footerFiles>
        @vite(['resources/assets/js/forms/bootstrap_validation/bs_validation_script.js'])

        <script src="{{ asset('plugins/global/vendors.min.js') }}"></script>
        @vite(['resources/assets/js/custom.js'])

        </x-slot>
</x-base-layout>
