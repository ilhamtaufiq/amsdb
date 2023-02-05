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
              <li class="breadcrumb-item active" aria-current="page">NPHD</li>
            </ol>
          </nav>
        </div>
        <!-- /BREADCRUMB -->
        <div class="seperator-header layout-top-spacing">
          <h4 class="">Tambah NPHD</h4>
        </div>

        <!-- /FORM TAMBAH -->
        <div class="row">
          <div class="col-xl-12 col-lg-12 col-sm-12 layout-spacing">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">NPHD</h5>
                <form id="input" class="simple-example needs-validation" method="post"
                      action="{{ route('nphd.update', $nphd->id) }}" novalidate>
                  @csrf
                  @method('PUT')
                  <div class="form-row">
                    <div class="row">
                      <div class="col-md-8 mb-4">
                        <label for="pekerjaan">Nama Pekerjaan</label>
                        <select class="select form-control" name="pekerjaan_id" id="select-beast"
                                placeholder="Pilih Sub Kegiatan" autocomplete="off" required="">
                                <option value="{{ $nphd->pekerjaan_id }}">{{ $nphd->pekerjaan->nama_pekerjaan }}</option>
                                @foreach ($pekerjaan as $k)
                            <option value="{{ $k->id }}"> {{ $k->nama_pekerjaan }}</option>
                          @endforeach
                        </select>
                        <div class="invalid-feedback">
                        </div>
                      </div>
                      <div class="col-md-4 mb-4">
                        <label for="bangunan">Bangunan</label>
                        <input value="{{ $nphd->bangunan }}" type="text" class="ts-control" id="bangunan" name="bangunan"
                               placeholder="Nama Bangunan" required>
                        <div class="invalid-feedback">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-4">
                          <label for="no_nphd">Nomor NPHD</label>
                          <input type="text" class="ts-control" id="no_nphd" name="no_nphd" placeholder="Nomor NPHD"
                                 value="{{ $nphd->no_nphd }}" required>
                          <div class="invalid-feedback">
                          </div>
                        </div>
                        <div class="col-md-6 mb-4">
                          <label for="tgl_nphd">Tanggal NPHD</label>
                          <input type="date" class="ts-control" id="tgl_nphd" name="tgl_nphd" placeholder="Tanggal NPHD"
                                 value="{{ $nphd->tgl_nphd }}" required>
                          <div class="invalid-feedback">
                          </div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <label for="no_ba">Nomor Berita Acara</label>
                            <input type="text" class="ts-control" id="no_ba" name="no_ba" placeholder="Nomor Berita Acara Serah Terima Fisik"
                                   value=""{{ $nphd->no_ba }} required>
                            <div class="invalid-feedback">
                            </div>
                          </div>
                          <div class="col-md-6 mb-4">
                            <label for="tgl_ba">Tanggal Berita Acara</label>
                            <input type="date" class="ts-control" id="tgl_ba" name="tgl_ba" placeholder="Tanggal Berita Acara Serah Terima Fisik"
                                   value="{{ $nphd->tgl_ba }}" required>
                            <div class="invalid-feedback">
                            </div>
                          </div>
                      </div>
                    <div class="row">
                      <div class="col-md-6 mb-4">
                        <label for="pengelola">Nama Pengelola</label>
                        <input value="{{ $nphd->pengelola }}" type="text" class="ts-control" id="pengelola" name="pengelola"
                               placeholder="Nama Pengelola" required>
                        <div class="invalid-feedback">
                        </div>
                      </div>
                      <div class="col-md-6 mb-4">
                        <label for="ketua">Ketua Pengelola</label>
                        <input value="{{ $nphd->ketua }}" type="text" class="ts-control" id="ketua" name="ketua"
                               placeholder="Nama Ketua Pengelola" required>
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
