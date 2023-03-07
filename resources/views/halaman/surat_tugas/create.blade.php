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
            <li class="breadcrumb-item active" aria-current="page">Surat Tugas</li>
          </ol>
        </nav>
      </div>
      <!-- /BREADCRUMB -->
      <div class="seperator-header layout-top-spacing">
        <h4 class="">Buat Surat Tugas</h4>
      </div>

      <!-- /FORM TAMBAH -->
      <div class="row">
        <div class="col-xl-12 col-lg-12 col-sm-12 layout-spacing">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Surat Tugas</h5>
              <form action="{{ route('tugas.store') }}" method="POST">
                @csrf
                <div class="form-group">
                  <input type="hidden" id="id" name="id" value="">
                  <div class="row">
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label>Nomor Surat</label>
                            <input type="text" class="form-control" name="nomor">
                        </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-12">
                      <div class="mb-3">
                        <label>Dasar Surat</label>
                        {{-- <input type="text" id="dasar" name="dasar" class="form-control"
                               placeholder="Dasar Surat Tugas"> --}}
                               <textarea type="text" id="dasar" name="dasar" class="form-control"
                               placeholder="Dasar Surat Tugas">Dokumen Pelaksanaan Anggaran (DPA) Dinas Perumahan Dan Kawasan Permukiman Kabupaten Cianjur Nomor: 900/Kep.01/BKAD/2023 Tanggal 2 Januari 2023 Tentang Pengesahan Dokumen Pelaksanaan Anggaran Perangkat Daerah (DPA-PD) Tahun Anggaran 2023.</textarea>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-2">
                        <div class="mb-3">
                          <label style="padding-top: 7%">Tanggal Surat</label>
                          <br>
                          <input type="date" id="tanggal" name="tanggal" class="form-control" placeholder="tanggal">
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="mb-3">
                            <label>Pilih Nama <button type="button" name="add" id="dynamic-ar"
                                    class="btn btn-sm btn-outline-primary">Tambah</button>
                            </label>
                            <select class="form-control" id="select-pegawai" placeholder="Pilih Nama" autocomplete="off"
                                    required="">
                            <option value="">Pilih Nama</option>
                            @foreach ($pegawai as $p)
                                <option value="{{ $p->id }}"> {{ $p->nama }}</option>
                            @endforeach
                            </select>
                        </div>
                    </div>
                  </div>
                  <div class="row" id="">
                    <div class="col-lg-4">
                      <div class="mb-3">
                        <input type="text" id="nama0" name="kepada[0][nama]" class="form-control"
                               placeholder="Nama" readonly>
                        <div class="invalid-feedback">
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-3">
                      <div class="mb-3">
                        <input type="text" id="nip0" name="kepada[0][nip]" class="form-control"
                               placeholder="NIP" readonly>
                      </div>
                    </div>
                    <div class="col-lg-3">
                      <div class="mb-3">
                        <input type="hidden" id="pangkat0" name="kepada[0][pangkat]" class="form-control"
                        placeholder="Pangkat" readonly>

                        <input type="text" id="jabatan0" name="kepada[0][jabatan]" class="form-control"
                               placeholder="Jabatan" readonly>
                      </div>
                    </div>
                    <div class="col-lg-2">
                      <div class="mb-3">
                      </div>
                    </div>
                  </div>
                  <div id="dynamicAddRemove">

                  </div>

                  <div class="row" id="">
                    <div class="col-lg-10">
                      <div class="mb-3">
                        <label>Keperluan Untuk <button type="button" name="add" id="dynamic-ar1"
                                  class="btn btn-sm btn-outline-primary">Tambah</button>
                        </label>
                        <input type="text" id="tujuan" name="tujuan[0][untuk]" class="form-control"
                               placeholder="Keperluan">
                      </div>
                    </div>
                    <div class="col-lg-2">
                      <div class="mb-3">
                      </div>
                    </div>
                  </div>
                  <div id="dynamicAddRemove1">

                  </div>

                </div>
                <div class="row">
                    <div class="mb-3">
                        <label>Pilih Tanda Tangan</label>
                        <div class="col-lg-6">
                            <select class="form-control" name="ttd">
                                <option>Pilih</option>
                                <option class="kabid">Kepala Bidang</option>
                                <option class="kadis">Kepala Dinas</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div>
                  <input class="btn btn-danger" type="submit">
                </div>
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
        <script>
          $(document).ready(function() {


          });
        </script>
        <script type="text/javascript">
          var i = 0;
          $('#select-pegawai').on('change', function() {
            var id = this.value;
            $.ajax({
              url: "{{ route('pegawai.index') }}",
              type: "GET",
              data: {
                id: id,
              },
              dataType: 'json',
              success: function(result) {
                console.log(i);
                $('#nama' + i).val(result.nama);
                $('#nip' + i).val(result.nip);
                $('#pangkat' + i).val(result.pangkat);
                $('#jabatan' + i).val(result.jabatan);

              }
            });
          });
          $("#dynamic-ar").click(function() {
            ++i;
            $("#dynamicAddRemove").append(`
            <div class="row" id="field">
                <div class="col-lg-4">
                                <div class="mb-4">
                                    <input type="text" id="nama${i}" name="kepada[${i}][nama]"
                                        class="form-control" placeholder="Nama" readonly>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="mb-3">
                                    <input type="text" id="nip${i}" name="kepada[${i}][nip]"
                                        class="form-control" placeholder="NIP" readonly>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="mb-3">
                                    <input type="hidden" id="pangkat${i}" name="kepada[${i}][pangkat]" class="form-control"
                        placeholder="Pangkat" readonly>
                                    <input type="text" id="jabatan${i}" name="kepada[${i}][jabatan]"
                                        class="form-control" placeholder="Jabatan" readonly>
                                </div>
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
        <script type="text/javascript">
          var j = 0;
          $("#dynamic-ar1").click(function() {
            ++j;
            $("#dynamicAddRemove1").append(`
            <div class="row" id="field1">
                <div class="col-lg-10">
                                <div class="mb-3">
                                    <input type="text" id="tujuan" name="tujuan[${j}][untuk]"
                                        class="form-control" placeholder="Keperluan">
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="mb-3">
                                    <button type="button" name="add" id="dynamic-ar1" class="btn btn-outline-danger remove-input-field1">x</button>
                                </div>
                            </div>
             </div>
            `);
          });
          $(document).on('click', '.remove-input-field1', function() {
            $(this).parents('#field1').remove();
          });
        </script>

        </x-slot>
</x-base-layout>
