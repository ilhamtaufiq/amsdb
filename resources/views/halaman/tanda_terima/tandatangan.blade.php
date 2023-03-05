<x-base-layout :scrollspy="false">

    <x-slot:pageTitle>
      {{ $title ?? 'Sign' }}
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
                <form action="{{ route('signing') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <label for="myfile">Select a sertifikat:</label>
                    <input type="file" id="pfxUploadedFile" name="pfxUploadedFile">
                    <label for="myfile">Select a pdf:</label>
                    <input type="file" id="pdf" name="pdf">
                    <label>Password</label>
                    <input type="password" name="password" id="password" required="true"><br>
                    <button type="submit" class="btn btn-success btn-block">Sign File</button><br>
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

