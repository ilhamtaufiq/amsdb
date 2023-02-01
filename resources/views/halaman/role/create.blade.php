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
                        <li class="breadcrumb-item active" aria-current="page">Role</li>
                    </ol>
                </nav>
            </div>
            <!-- /BREADCRUMB -->
            <div class="seperator-header layout-top-spacing">
                <h4 class="">Tambah Role</h4>
            </div>

            <!-- /FORM TAMBAH -->
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                    {!! Form::open(array('route' => 'role.store','method'=>'POST')) !!}
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 mb-4">
                            <div class="form-group">
                                <strong>Nama</strong>
                                {!! Form::text('name', null, array('placeholder' => 'Nama Role','class' => 'form-control')) !!}
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 mb-4">
                            <div class="form-group">
                                <strong>Permission:</strong>
                                {!! Form::select('permission[]', $permission,'id', array('class' => 'select form-control','multiple')) !!}
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 text-center mb-4">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                    {!! Form::close() !!}

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
                <!--  END CUSTOM SCRIPTS FILE  -->
</x-base-layout>
