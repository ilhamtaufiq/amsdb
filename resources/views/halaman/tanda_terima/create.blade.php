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
              <li class="breadcrumb-item active" aria-current="page">Surat Tanda Terima</li>
            </ol>
          </nav>
        </div>
        <!-- /BREADCRUMB -->
        <div class="seperator-header layout-top-spacing">
          <h4 class="">Tambah Surat Tanda Terima</h4>
        </div>

        <!-- /FORM TAMBAH -->
        <div class="row">
          <div class="col-xl-12 col-lg-12 col-sm-12 layout-spacing">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Tanda Terima</h5>
                <form action="{{ route("tandaterima.store") }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <input type="hidden" id="id" name="id" value="">
                        <div class="row" id="">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <input type="text" id="nama_berkas" name="berkas[0][nama]"
                                        class="form-control" placeholder="Nama Berkas">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <input type="number" id="jumlah" name="berkas[0][jumlah]"
                                        class="form-control" placeholder="Jumlah">
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="mb-3">
                                    <button type="button" name="add" id="dynamic-ar" class="btn btn-outline-primary">+</button>
                                </div>
                            </div>
                        </div>
                        <div id="dynamicAddRemove">

                        </div>
                        <div class="row">
                            <div class="col-lg-5">
                                <div class="mb-3">
                                    <input type="text" id="dari" name="dari"
                                        class="form-control" placeholder="yang menyerahkan">
                                </div>
                            </div>
                            <div class="col-lg-5">
                                <div class="mb-3">
                                    <input type="text" id="penerima" name="penerima"
                                        class="form-control" placeholder="Penerima">
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="mb-3">
                                    <input type="date" id="tanggal" name="tanggal"
                                        class="form-control" placeholder="tanggal">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <input class=" btn btn-danger" type="submit">
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
          <script type="text/javascript">
            var i = 0;
            $("#dynamic-ar").click(function () {
                ++i;
                $("#dynamicAddRemove").append(`
            <div class="row" id="field">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <input type="text" id="nama_berkas" name="berkas[${i}][nama]"
                                        class="form-control" placeholder="Nama Berkas">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <input type="number" id="jumlah" name="berkas[${i}][jumlah]"
                                        class="form-control" placeholder="Jumlah">
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
            $(document).on('click', '.remove-input-field', function () {
                $(this).parents('#field').remove();
            });
        </script>

          </x-slot>
  </x-base-layout>
