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
                      <select name="satuan_output" id="select-output" placeholder="Pilih Satuan Output..."
                              autocomplete="off" required>
                        <option value="">Pilih Satuan Output...</option>
                        <option value="Unit" {{ $pekerjaan->satuan_output == 'Unit' ? 'selected' : '' }}>Unit
                        </option>
                        <option value="SR" {{ $pekerjaan->satuan_output == 'SR' ? 'selected' : '' }}>Sambungan
                          Rumah
                        </option>
                        <option value="KU/HU" {{ $pekerjaan->satuan_output == 'KU/HU' ? 'selected' : '' }}>Kran
                          Umum/Hidran Umum</option>
                      </select>
                      <div class="invalid-feedback">
                      </div>
                    </div>
                  </div>
                  <label>Spesifikasi Teknis <button type="button" name="add" id="dynamic-ar"
                            class="btn btn-sm btn-outline-primary">Tambah</button></label>
                  @php
                    $nol = 0;
                    if ($pekerjaan->spek != null) {
                        # code...
                        $index = array_key_last($pekerjaan->spek->spek);
                    } else {
                        # code...
                        $index = $nol;
                    }

                  @endphp
                  <input class="form-control" type="hidden" id="index" value="{{ $index }}">
                  @empty(!$pekerjaan->spek)
                    @foreach ($pekerjaan->spek->spek as $index => $item)
                      <div class="row" id="">
                        <div class="col-lg-4">
                          <div class="mb-3">
                            <input type="number" id="volume" name="spek[{{ $index }}][volume]"
                                   class="form-control" placeholder="Volume" value="{{ $item['volume'] ?? '' }}">
                            <div class="invalid-feedback">
                            </div>
                          </div>
                        </div>
                        <div class="col-lg-3">
                          <div class="mb-3">
                            <select class="form-control" id="satuan{{ $index }}"
                                    name="spek[{{ $index }}][satuan]">
                              <option value="Sambungan Rumah"
                                      {{ $item['satuan'] == 'Sambungan Rumah' ? 'selected' : '' }}>Sambungan Rumah
                              </option>
                              <option value="Jaringan Perpipaan" {{ $item['satuan'] == 'Jaringan Perpipaan' ? 'selected' : '' }}>Jaringan Perpipaan</option>
                              <option value="Tangki Septik" {{ $item['satuan'] == 'Tangki Septik' ? 'selected' : '' }}>
                                Tangki Septik</option>
                              <option value="Tangki Septik Komunal"
                                      {{ $item['satuan'] == 'Tangki Septik Komunal' ? 'selected' : '' }}>Tangki Septik
                                Komunal</option>
                              <option value="IPAL" {{ $item['satuan'] == 'IPAL' ? 'selected' : '' }}>IPAL</option>
                            </select>
                            {{-- <input type="text" id="satuan" name="spek[{{ $index }}][satuan]" class="form-control"
                               placeholder="Satuan" value="{{ $item['satuan'] ?? '' }}"> --}}
                          </div>
                        </div>
                        <div class="col-lg-3">
                            <select class="form-control" id="unit{{ $index }}" name="spek[{{ $index }}][unit]">
                                <option value="">Pilih Unit</option>
                                <option value="Meter" {{ $item['unit'] == 'Meter' ? 'selected' : '' }}>Meter</option>
                                <option value="Unit" {{ $item['unit'] == 'Unit' ? 'selected' : '' }}>Unit</option>
                                <option value="m3" {{ $item['unit'] == 'm3' ? 'selected' : '' }}>Meter Kubik</option>
                                <option value="m2" {{ $item['unit'] == 'm2' ? 'selected' : '' }}>Meter Persegi</option>
                            </select>
                          </div>
                      </div>
                    @endforeach
                  @else
                    <div class="row" id="">
                      <div class="col-lg-4">
                        <div class="mb-3">
                          <input type="number" id="volume" name="spek[0][volume]" class="form-control"
                                 placeholder="Volume">
                          <div class="invalid-feedback">
                          </div>
                        </div>
                      </div>
                      <div class="col-lg-3">
                        <div class="mb-3">
                          <select class="form-control" id="satuan0" name="spek[0][satuan]" placeholder="Komponen">
                            <option value="">Pilih Komponen</option>
                            <option value="Sambungan Rumah">Sambungan Rumah</option>
                            <option value="Jaringan Perpipaan">Jaringan Perpipaan</option>
                            <option value="Tangki Septik">Tangki Septik</option>
                            <option value="Tangki Septik Komunal">Tangki Septik Komunal</option>
                            <option value="IPAL">IPAL</option>
                          </select>
                          {{-- <input type="text" id="satuan" name="spek[0][satuan]" class="form-control"
                               placeholder="Satuan"> --}}
                        </div>
                      </div>
                      <div class="col-lg-3">
                        <select class="form-control" id="unit0" name="spek[0][unit]">
                            <option value="">Pilih Unit</option>
                            <option value="Meter">Meter</option>
                            <option value="Unit">Unit</option>
                            <option value="m3">Meter Kubik</option>
                            <option value="m2">Meter Persegi</option>
                        </select>
                      </div>
                    </div>
                    @endif
                  </div>
                  <div id="dynamicAddRemove">
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
            var i = document.querySelector('#index').value;
            $("#dynamic-ar").click(function() {
              ++i;
              $("#dynamicAddRemove").append(`
            <div class="row" id="field">
                    <div class="col-lg-4">
                      <div class="mb-3">
                        <input type="number" id="volume" name="spek[${i}][volume]" class="form-control"
                               placeholder="Volume">
                        <div class="invalid-feedback">
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-3">
                      <div class="mb-3">
                        <select class="form-control" id="satuan${i}" name="spek[${i}][satuan]">
                            <option value="">Pilih Komponen</option>
                            <option value="Sambungan Rumah">Sambungan Rumah</option>
                            <option value="Jaringan Perpipaan">Jaringan Perpipaan</option>
                            <option value="Tangki Septik">Tangki Septik</option>
                            <option value="Tangki Septik Komunal">Tangki Septik Komunal</option>
                            <option value="IPAL">IPAL</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-lg-3">
                        <select class="form-control" id="unit${i}" name="spek[${i}][unit]">
                            <option value="">Pilih Unit</option>
                            <option value="Meter">Meter</option>
                            <option value="Unit">Unit</option>
                            <option value="m3">Meter Kubik</option>
                            <option value="m2">Meter Persegi</option>
                        </select>
                      </div>
                    <div class="col-lg-2">
                                <div class="mb-3">
                                    <button type="button" name="add" id="dynamic-ar" class="btn btn-outline-danger remove-input-field">x</button>
                                </div>
                    </div>
                  </div>
            `);
            });
            $(document).on('click', '.remove-input-field', function() {
              $(this).parents('#field').remove();
            });
          </script>
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
