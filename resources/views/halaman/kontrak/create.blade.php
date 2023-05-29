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
            <li class="breadcrumb-item active" aria-current="page">Program Kegiatan</li>
          </ol>
        </nav>
      </div>
      <!-- /BREADCRUMB -->
      <div class="seperator-header layout-top-spacing">
        <h4 class="">Tambah Paket Pekerjaan</h4>
      </div>

      <!-- /FORM TAMBAH -->
      <div class="row">
        <div class="col-xl-12 col-lg-12 col-sm-12 layout-spacing">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Kontrak</h5>
              <form id="input" class="simple-example needs-validation" method="post"
                    action="{{ route('kontrak.store') }}" novalidate>
                @csrf
                <div class="form-row">
                  <div class="row">
                    <div class="col-md-12 mb-4">
                      <label for="pekerjaan">Nama Pekerjaan</label>
                      <select class="select form-control" name="pekerjaan_id" id="select-beast"
                              placeholder="Pilih Sub Kegiatan" autocomplete="off" required="">
                        <option value="">Pilih Pekerjaan</option>
                        @foreach ($pekerjaan as $k)
                          <option value="{{ $k->id }}"> {{ $k->nama_pekerjaan }}</option>
                        @endforeach
                      </select>
                      <div class="invalid-feedback">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-3 mb-4">
                      <label for="pekerjaan">Tanggal Mulai</label>
                      <input type="date" class="ts-control date" placeholder="Tanggal Mulai" name="tgl_mulai">
                      <div class="invalid-feedback">
                      </div>
                    </div>
                    <div class="col-md-3 mb-4">
                      <label for="pekerjaan">Tanggal Selesai</label>
                      <input type="date" class="ts-control" placeholder="Tanggal Selesai" name="tgl_selesai">
                      <div class="invalid-feedback">
                      </div>
                    </div>
                    <div class="col-md-6 mb-4">
                      <label for="pekerjaan">Nilai Kontrak</label>
                      <input type="number" class="ts-control" placeholder="Nilai Kontrak" name="nilai_kontrak">
                      <div class="invalid-feedback">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-4 mb-4">
                      <label for="pelaksana">Pelaksana</label>
                      <select class="select form-control" name="pelaksana_id" id="select-pelaksana"
                              placeholder="Pilih Pelaksana" autocomplete="off" required="">
                        <option value="">Pilih Pelaksana</option>
                        @foreach ($pelaksana as $p)
                          <option value="{{ $p->id }}"> {{ $p->nama }}</option>
                        @endforeach
                      </select>
                      <div class="invalid-feedback">
                      </div>
                    </div>
                    <div class="col-md-4 mb-4">
                      <label for="kode_paket">Kode RUP</label>
                      <input type="number" class="ts-control" id="kode_rup" name="kode_rup" placeholder="Kode RUP"
                             value="" required>
                      <div class="invalid-feedback">
                      </div>
                    </div>
                    <div class="col-md-4 mb-4">
                      <label for="kode_paket">Kode Paket</label>
                      <input type="number" class="ts-control" id="kode_paket" name="kode_paket"
                             placeholder="Kode Paket" value="" required>
                      <div class="invalid-feedback">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6 mb-4">
                      <label for="no_sppbj">No SPPBJ</label>
                      <input type="text" class="ts-control" name="no_sppbj"></input>
                    </div>
                    <div class="col-md-6 mb-4">
                      <label for="tgl_sppbj">Tanggal SPPBJ</label>
                      <input type="date" class="form-control ts-control" name="tgl_sppbj"></input>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6 mb-4">
                      <label for="no_spk">No SPK</label>
                      <input type="text" class="ts-control" name="no_spk"></input>
                    </div>
                    <div class="col-md-6 mb-4">
                      <label for="tgl_spk">Tanggal SPK</label>
                      <input type="date" class="form-control ts-control" name="tgl_spk"></input>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6 mb-4">
                      <label for="no_spmk">No SPMK</label>
                      <input type="text" class="ts-control" name="no_spmk"></input>
                    </div>
                    <div class="col-md-6 mb-4">
                      <label for="tgl_spmk">Tanggal SPMK</label>
                      <input type="date" class="form-control ts-control" name="tgl_spmk"></input>
                    </div>
                  </div>
                </div>
                <button class="btn btn-primary submit-fn mt-2" type="submit">Submit form</button>
              </form>
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
          // Use datepicker on the date inputs
          $("input[type=date]").datepicker({
            dateFormat: 'yy-mm-dd',
            onSelect: function(dateText, inst) {
              $(inst).val(dateText); // Write the value in the input
            }
          });

          // Code below to avoid the classic date-picker
          $("input[type=date]").on('click', function() {
            return false;
          });
        </script>
        </x-slot>
</x-base-layout>
