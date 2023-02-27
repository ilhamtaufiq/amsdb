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
              <li class="breadcrumb-item active" aria-current="page">Data Relokasi</li>
            </ol>
          </nav>
        </div>
        <!-- /BREADCRUMB -->
        <div class="seperator-header layout-top-spacing">
          <h4 class="">Tambah Relokasi</h4>
        </div>

        <!-- /FORM TAMBAH -->
        <div class="row">
          <div class="col-xl-12 col-lg-12 col-sm-12 layout-spacing">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Relokasi</h5>
                <form id="input" class="simple-example needs-validation" method="post"
                      action="{{ route('relokasi.store') }}" novalidate>
                  @csrf
                  <div class="form-row">
                    <div class="form-group">
                        <div class="row">
                          <div class="col-12 md-4">
                            <label>Nama</label>
                            <input type="text" class="form-control" id="nama" name="nama"
                                   placeholder="Nama" value="" required>
                          </div>
                          <div class="col-12 md-4">
                            <label>NIK</label>
                            <input type="text" class="form-control" id="nik" name="nik"
                                   placeholder="NIK" value="" required>
                          </div>
                          <div class="col-12 md-4">
                            <label>Alamat</label>
                            <input type="text" class="form-control" id="alamat" name="alamat"
                                   placeholder="Alamat" value="" required>
                          </div>
                          <div class="col-12 md-4">
                            <label>Desa</label>
                            <input type="text" class="form-control" id="desa" name="desa"
                                   placeholder="Desa" value="" required>
                          </div>
                          <div class="col-12 md-4">
                            <label>Kecamatan</label>
                            <input type="text" class="form-control" id="kecamatan" name="kecamatan"
                                   placeholder="Kecamatan" value="" required>
                          </div>
                          <div class="col-12 md-4">
                            <label>Keterangan</label>
                            <select class="form-control" name="keterangan" id="keterangan" required>
                              <option value="Bersedia Relokasi">Bersedia Relokasi</option>
                              <option value="Bersedia Relokasi Mandiri">Bersedia Relokasi Mandiri</option>
                              <option value="Tidak Bersedia Relokasi">Tidak Bersedia Relokasi</option>
                            </select>
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
          <script src="{{ asset('plugins/tomSelect/tom-select.base.js') }}"></script>
          <script>
            document.querySelectorAll('.select').forEach((el) => {
              let settings = {
                create: false,
                sortField: {
                  field: 'text',
                  direction: 'asc'
                }
              };
              new TomSelect(el, settings);
            });
          </script>
          </x-slot>
  </x-base-layout>
