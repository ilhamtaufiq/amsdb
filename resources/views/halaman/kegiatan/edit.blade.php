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
                <h4 class="">Tambah Data Kegiatan</h4>
            </div>

            <!-- /FORM TAMBAH -->
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                    <form class="simple-example" method="post" action="{{route('kegiatan.update', $kegiatan->id)}}" novalidate>
                        @csrf
                        @method('PUT')
                        <div class="form-row">
                            <div class="col-md-12 mb-4">
                                <label for="program">Nama Program</label>
                                <input value="{{$kegiatan->program}}" type="text" class="form-control" id="program" name="program" placeholder="" value=""
                                    required>
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                                <div class="invalid-feedback">
                                    Please fill the name
                                </div>
                            </div>
                            <div class="col-md-12 mb-4">
                                <label for="kegiatan">Nama Kegiatan</label>
                                <input value="{{$kegiatan->kegiatan}}" type="text" class="form-control" id="kegiatan" name="kegiatan" placeholder="" value=""
                                    required>
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                                <div class="invalid-feedback">
                                    Please fill the name
                                </div>
                            </div>
                            <div class="col-md-12 mb-4">
                                <label for="sub_kegiatan">Nama Sub Kegiatan</label>
                                <input value="{{$kegiatan->sub_kegiatan}}" type="text" class="form-control" id="sub_kegiatan" name="sub_kegiatan" placeholder="" value=""
                                    required>
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                                <div class="invalid-feedback">
                                    Please fill the name
                                </div>
                            </div>
                            <div class="row">
                            <div class="col-md-2 mb-4">
                                <label for="tahun_anggaran">Tahun Anggaran</label>
                                <input value="{{$kegiatan->tahun_anggaran}}" type="text" class="form-control" id="tahun_anggaran" name="tahun_anggaran" placeholder="" value=""
                                    required>
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                                <div class="invalid-feedback">
                                    Please fill the name
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <label for="sumber_dana">Sumber Dana</label>
                                <input value="{{$kegiatan->sumber_dana}}" type="text" class="form-control" id="sumber_dana" name="sumber_dana" placeholder="" value=""
                                    required>
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                                <div class="invalid-feedback">
                                    Please fill the name
                                </div>
                            </div>
                            </div>
                        </div>
                        <button class="btn btn-primary submit-fn mt-2" type="submit">Simpan</button>
                    </form>
                </div>
            </div>

            <!--  BEGIN CUSTOM SCRIPTS FILE  -->
            <x-slot:footerFiles>
                <script src="{{ asset('plugins/global/vendors.min.js') }}"></script>
                @vite(['resources/assets/js/custom.js'])
                <script>
                    window.addEventListener('load', function() {
                        // Fetch all the forms we want to apply custom Bootstrap validation styles to
                        var forms = document.getElementsByClassName('simple-example');
                        var invalid = $('.simple-example .invalid-feedback');

                        // Loop over them and prevent submission
                        var validation = Array.prototype.filter.call(forms, function(form) {
                            form.addEventListener('submit', function(event) {
                                if (form.checkValidity() === false) {
                                    event.preventDefault();
                                    event.stopPropagation();
                                    invalid.css('display', 'block');
                                } else {

                                    invalid.css('display', 'none');

                                    form.classList.add('was-validated');
                                }
                            }, false);
                        });

                    }, false);
                </script>
                </x-slot>
                <!--  END CUSTOM SCRIPTS FILE  -->
</x-base-layout>
