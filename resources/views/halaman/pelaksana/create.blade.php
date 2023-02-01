<x-base-layout :scrollspy="false">

    <x-slot:pageTitle>
        {{ $title }}
        </x-slot>

        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <x-slot:headerFiles>
            <!--  BEGIN CUSTOM STYLE FILE  -->

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
                <h4 class="">Tambah Data Pelaksana</h4>
            </div>

            <!-- /FORM TAMBAH -->
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">

                    <form class="simple-example needs-validation" method="post" action="{{ route('pelaksana.store') }}"
                        novalidate>
                        @csrf
                        <div class="form-row">
                            <div class="col-md-12 mb-4">
                                <label for="nama">Nama Pelaksana</label>
                                <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Pelaksana"
                                    value="" required>
                                     <div class="valid-feedback">
                            </div>
                            </div>
                            <div class="col-md-12 mb-4">
                                <label for="alamat">Alamat Pelaksana</label>
                                <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Alamat Pelaksana"
                                    value="" required>
                                <div class="invalid-feedback">
                                </div>
                            </div>
                            <div class="col-md-12 mb-4">
                                <label for="npwp">NPWP Pelaksana</label>
                                <input type="text" class="form-control" id="npwp" name="npwp"
                                    placeholder="NPWP Pelaksana" value="" required>
                                <div class="invalid-feedback">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label for="direktur">Nama Direktur</label>
                                    <input type="text" class="form-control" id="direktur" name="direktur"
                                        placeholder="Nama Direktur" value="" required>
                                    <div class="invalid-feedback">
                                    </div>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label for="kontak">Kontak</label>
                                    <input type="text" class="form-control" id="kontak" name="kontak"
                                        placeholder="Nomor Kontak" value="">
                                    <div class="invalid-feedback">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-primary submit-fn mt-2" type="submit">Submit form</button>
                    </form>
                </div>
            </div>

            <!--  BEGIN CUSTOM SCRIPTS FILE  -->
            <x-slot:footerFiles>
                @vite(['resources/assets/js/forms/bootstrap_validation/bs_validation_script.js'])

                <script src="{{ asset('plugins/global/vendors.min.js') }}"></script>
                @vite(['resources/assets/js/custom.js'])
                </x-slot>
                <!--  END CUSTOM SCRIPTS FILE  -->
</x-base-layout>
