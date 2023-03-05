<x-base-layout :scrollspy="false">

  <x-slot:pageTitle>
    {{ $title }}
    </x-slot>

    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <x-slot:headerFiles>
      <!--  BEGIN CUSTOM STYLE FILE  -->
      <link rel="stylesheet" type="text/css" href="{{ asset('plugins/tomSelect/tom-select.default.min.css') }}">
      @vite(['resources/scss/light/assets/forms/switches.scss'])
      @vite(['resources/scss/dark/assets/forms/switches.scss'])
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
              <h5 class="card-title">Pekerjaan</h5>
              <form id="input" class="simple-example needs-validation" method="post"
                    action="{{ route('pekerjaan.update', $pekerjaan->id) }}" novalidate>
                @csrf
                @method('PUT')
                <div class="form-row">
                  <div class="col-md-4 switch form-switch-custom switch-inline form-switch-warning mb-4">
                    <input type="hidden" name="pokir" value="0">
                    <input class="switch-input" type="checkbox" value="1" name="pokir" role="switch"
                           id="form-custom-switch-warning" {{ $pekerjaan->pokir == 1 ? 'checked' : '' }}>
                    <label class="switch-label" for="form-custom-switch-warning">Pokir</label>
                  </div>
                  <div class="col-md-12 mb-4">
                    <label for="pekerjaan">Nama Paket Pekerjaan</label>
                    <input value="{{ $pekerjaan->nama_pekerjaan }}" type="text" class="form-control" id="pekerjaan"
                           name="nama_pekerjaan" placeholder="" value="" required>
                    <div class="valid-feedback">
                    </div>
                  </div>
                  <div class="col-md-12 mb-4">
                    <label for="kegiatan">Nama Sub Kegiatan</label>
                    <select class="form-control" name="keg_id" id="select-beast" placeholder="Pilih Sub Kegiatan"
                            autocomplete="off" required="">
                      <option value="{{ $pekerjaan->keg_id }}">
                        {{ $pekerjaan->kegiatan->sub_kegiatan }}</option>
                      @foreach ($kegiatan as $k)
                        <option value="{{ $k->id }}"> {{ $k->sub_kegiatan }}</option>
                      @endforeach
                    </select>
                    <div class="invalid-feedback">
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-4 mb-4">
                      <label for="kecamatan">Kecamatan</label>
                      <select class="form-control" name="kec_id" id="select-kec" placeholder="Pilih Kecamatan"
                              autocomplete="off" required="">
                        <option value="{{ $pekerjaan->kec_id }}">{{ $pekerjaan->kec->n_kec }}
                        </option>
                        @foreach ($kecamatan as $k)
                          <option value="{{ $k->id }}"> {{ $k->n_kec }}</option>
                        @endforeach
                      </select>
                      <div class="invalid-feedback">
                      </div>
                    </div>
                    <div class="col-md-4 mb-4">
                      <label for="desa">Desa</label>
                      <!-- <input type="text" class="form-control" id="desa" name="desa"
                                                placeholder="" value="" required> -->
                      <select class="form-control desa" name="desa_id" id="desa" class="form-control"
                              placeholder="Pilih Desa" autocomplete="off" required="">
                        <option value="{{ $pekerjaan->desa_id }}">
                          {{ $pekerjaan->desa->n_desa }}</option>
                      </select>
                      <div class="invalid-feedback">
                      </div>
                    </div>
                    <div class="col-md-4 mb-4">
                      <label for="pagu">Pagu</label>
                      <input value={{ $pekerjaan->pagu }} type="number" class="ts-control" id="pagu"
                             name="pagu" placeholder="" value="" required>
                      <div class="invalid-feedback">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-4 mb-4">
                      <label for="pagu">Output</label>
                      <input type="number" class="ts-control" id="output" name="output" placeholder=""
                             value="{{ $pekerjaan->output }}" required>
                      <div class="invalid-feedback">
                      </div>
                    </div>
                    <div class="col-md-4 mb-4">
                      <label for="pagu">Satuan</label>
                      <select name="satuan_output" id="select-output" placeholder="Pilih Satuan Output..." autocomplete="off" required>
                        <option value="">Pilih Satuan Output...</option>
                        <option value="Unit" {{ $pekerjaan->satuan_output == 'TS' ? 'selected' : '' }}>Unit
                        </option>
                        <option value="SR" {{ $pekerjaan->satuan_output == 'SR' ? 'selected' : '' }}>Sambungan Rumah
                        </option>
                        <option value="KU/HU" {{ $pekerjaan->satuan_output == 'KU/HU' ? 'selected' : '' }}>Kran
                          Umum/Hidran Umum</option>
                      </select>
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

      <!--  BEGIN CUSTOM SCRIPTS FILE  -->
      <x-slot:footerFiles>
        @vite(['resources/assets/js/forms/bootstrap_validation/bs_validation_script.js'])

        <script src="{{ asset('plugins/global/vendors.min.js') }}"></script>
        @vite(['resources/assets/js/custom.js'])
        <script src="{{ asset('plugins/tomSelect/tom-select.base.js') }}"></script>
        <script>
          new TomSelect("#select-output", {
            create: false,
            sortField: {
              field: "text",
              direction: "asc"
            }
          });
          new TomSelect("#select-kec", {
            create: false,
            sortField: {
              field: "text",
              direction: "asc"
            }
          });
        </script>
        <script>
          new TomSelect("#select-beast", {
            create: false,
            sortField: {
              field: "text",
              direction: "asc"
            }
          });
        </script>
        <script>
          $(document).ready(function() {
            let desaSelect = new TomSelect(".desa", {
              create: false,
              sortField: {
                field: "text",
                direction: "asc"
              }
            });
            $('#select-kec').on('change', function() {
              var kec_id = this.value;
              $("#desa").html('');
              $.ajax({
                url: "{{ url('data/desa') }}",
                type: "GET",
                data: {
                  kec_id: kec_id,
                },
                dataType: 'json',
                success: function(result) {
                  desaSelect.destroy();
                  $('#desa').html('<option value="">Pilih Desa</option>');
                  $.each(result, function(key, value) {
                    $("#desa").append('<option value="' + value
                      .id + '">' + value.n_desa + '</option>');
                    if ($("#desa").val() != '{{ $pekerjaan->desa_id }}') {
                      $("#desa").append('<option value="' + value
                        .id + '" selected>' + value.n_desa + '</option>'
                      );
                    }
                  });
                  desaSelect = new TomSelect(".desa", {
                    create: false,
                    sortField: {
                      field: "text",
                      direction: "asc"
                    }
                  });
                }
              });
            }).trigger('change');
          });
        </script>
        </x-slot>
        <!--  END CUSTOM SCRIPTS FILE  -->
</x-base-layout>
