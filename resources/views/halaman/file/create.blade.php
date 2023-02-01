<x-base-layout :scrollspy="false">

  <x-slot:pageTitle>
    {{ $title }}
    </x-slot>

    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <x-slot:headerFiles>
      <!--  BEGIN CUSTOM STYLE FILE  -->
      <link rel="stylesheet" href="{{ asset('plugins/filepond/filepond.min.css') }}">
      <link rel="stylesheet" href="{{ asset('plugins/filepond/FilePondPluginImagePreview.min.css') }}">
      <link rel="stylesheet" href="{{ asset('plugins/tagify/tagify.css') }}">
      <link rel="stylesheet" type="text/css" href="{{ asset('plugins/tomSelect/tom-select.default.min.css') }}">
      @vite(['resources/scss/light/assets/forms/switches.scss'])
      @vite(['resources/scss/light/plugins/tagify/custom-tagify.scss'])
      @vite(['resources/scss/light/plugins/filepond/custom-filepond.scss'])

      @vite(['resources/scss/dark/assets/forms/switches.scss'])
      @vite(['resources/scss/dark/plugins/tagify/custom-tagify.scss'])
      @vite(['resources/scss/dark/plugins/filepond/custom-filepond.scss'])

      @vite(['resources/scss/light/assets/apps/ecommerce-create.scss'])
      @vite(['resources/scss/dark/assets/apps/ecommerce-create.scss'])
      <!--  END CUSTOM STYLE FILE  -->
      </x-slot>

      <!-- END GLOBAL MANDATORY STYLES -->
      <div class="row layout-spacing layout-top-spacing">
        <div class="col">
          @if (count($errors) > 0)
            <div class="alert alert-danger">
              <ul>
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif
        </div>
      </div>

      <form id="fileUpload" class="simple-example needs-validation" method="post" action="{{ route('upload.store') }}"
            enctype="multipart/form-data" novalidate>
        @csrf
        <div class="row layout-spacing layout-top-spacing mb-4">
          <div class="col-xxl-9 col-xl-12 col-lg-12 col-md-12 col-sm-12">
            <div class="widget-content widget-content-area ecommerce-create-section">
              <div class="row mb-4">
                <div class="col-sm-12">
                  <label for="pekerjaan_id">Paket Pekerjaan</label>
                  <select class="form-control" name="pekerjaan_id" id="pekerjaan_id" name="pekerjaan_id">
                    <option value="">Pilih Pekerjaan</option>
                    @foreach ($pekerjaan as $p)
                      <option value="{{ $p->id }}">{{ $p->nama_pekerjaan }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="row">
                <div class="col-md-8">
                  <label for="product-images">Upload File</label><br>
                  <span class="">Tunggu proses hingga selesai, lalu klik upload.</span>
                  <div class="multiple-file-upload">
                    <div class="img-uploader-content">
                      <input type="file" class="filepond" name="file"
                             accept="application/vnd.openxmlformats-officedocument.wordprocessingml.document, image/jpg, image/png, application/pdf" />
                    </div>
                  </div>
                </div>
              </div>
            </div>

          </div>
          <div class="col-xxl-3 col-xl-12 col-lg-12 col-md-12 col-sm-12">
            <div class="row">
              <div class="col-xxl-12 col-xl-8 col-lg-8 col-md-7 mt-xxl-0 mt-4">
                <div class="widget-content widget-content-area ecommerce-create-section">
                  <div class="row">
                    <div class="col-xxl-12 col-md-6 mb-4">
                      <label for="jenis">Jenis File</label>
                      <select class="form-select" id="jenis" name="jenis">
                        <option value="">Pilih Jenis File</option>
                        <option value="RAB">RAB</option>
                        <option value="gambar">Gambar</option>
                        <option value="foto">Foto Progress</option>
                      </select>
                    </div>
                    <div class="col-sm-12">
                      <button type="submit" class="btn btn-success w-100">Upload</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </form>
      <!--  BEGIN CUSTOM SCRIPTS FILE  -->
      <x-slot:footerFiles>
        @vite(['resources/assets/js/forms/bootstrap_validation/bs_validation_script.js'])
        <script src="{{ asset('plugins/filepond/filepond.min.js') }}"></script>
        <script src="{{ asset('plugins/filepond/FilePondPluginFileValidateType.min.js') }}"></script>
        <script src="{{ asset('plugins/filepond/FilePondPluginImageExifOrientation.min.js') }}"></script>
        <script src="{{ asset('plugins/filepond/FilePondPluginImagePreview.min.js') }}"></script>
        <script src="{{ asset('plugins/filepond/FilePondPluginImageCrop.min.js') }}"></script>
        <script src="{{ asset('plugins/filepond/FilePondPluginImageResize.min.js') }}"></script>
        <script src="{{ asset('plugins/filepond/FilePondPluginImageTransform.min.js') }}"></script>
        <script src="{{ asset('plugins/filepond/filepondPluginFileValidateSize.min.js') }}"></script>
        <script src="{{ asset('plugins/tagify/tagify.min.js') }}"></script>
        <script src="{{ asset('plugins/tomSelect/tom-select.base.js') }}"></script>
        <script>
          const inputElement = document.querySelector('input[type="file"]');

          // Create a FilePond instance
          const pond = FilePond.create(inputElement);
          // FilePond.setOptions({
          //     server: {
          //         url: '{{ route('upload.store') }}',
          //         headers: {
          //             'X-CSRF-TOKEN': '{{ csrf_token() }}'
          //         }

          //     }
          // });
          FilePond.setOptions({
            server: {
              process: '/tmp-upload',
              revert: '/tmp-delete',
              headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
              }
            },
          });
        </script>
        <script>
          new TomSelect("#pekerjaan_id", {
            create: false,
            sortField: {
              field: "text",
              direction: "asc"
            }
          });
        </script>
        </x-slot>
        <!--  END CUSTOM SCRIPTS FILE  -->
</x-base-layout>
