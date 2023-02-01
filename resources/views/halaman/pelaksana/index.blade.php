<x-base-layout :scrollspy="false">

    <x-slot:pageTitle>
        {{ $title }}
        </x-slot>

        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <x-slot:headerFiles>
            <style>
                .top-title {
                    margin-top: 10px;
                }
            </style>
            <!--  BEGIN CUSTOM STYLE FILE  -->
            <link rel="stylesheet" href="{{ asset('plugins/table/datatable/datatables.css') }}">
            <link rel="stylesheet" href="{{ asset('plugins/sweetalerts2/sweetalerts2.css') }}">
            @vite(['resources/scss/light/plugins/sweetalerts2/custom-sweetalert.scss'])
            @vite(['resources/scss/dark/plugins/sweetalerts2/custom-sweetalert.scss'])
            @vite(['resources/scss/light/plugins/table/datatable/dt-global_style.scss'])
            @vite(['resources/scss/light/plugins/table/datatable/custom_dt_miscellaneous.scss'])
            @vite(['resources/scss/dark/plugins/table/datatable/dt-global_style.scss'])
            @vite(['resources/scss/dark/plugins/table/datatable/custom_dt_miscellaneous.scss'])
            @vite(['resources/scss/light/assets/components/font-icons.scss'])
            @vite(['resources/scss/dark/assets/components/font-icons.scss'])
            <!--  END CUSTOM STYLE FILE  -->
            </x-slot>
            <!-- END GLOBAL MANDATORY STYLES -->

            <!-- BREADCRUMB -->
            <div class="page-meta">
                <nav class="breadcrumb-style-one" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Data</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Program Kegiatan</li>
                    </ol>
                </nav>
            </div>
            <!-- /BREADCRUMB -->
            <div class="seperator-header layout-top-spacing">
                <a type="button" class="btn btn-success" href="{{ route('pelaksana.create') }}">Tambah</a>
            </div>
            <div class="row">
                @empty(!$pelaksana)
                    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                        <div class="statbox widget box box-shadow">
                            <div class="widget-content widget-content-area">
                                <table id="html5-extension" class="table dt-table-hover" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Nama</th>
                                            <th>Alamat</th>
                                            <th>NPWP</th>
                                            <th>Direktur</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($pelaksana as $pelaksana)
                                            <x-pelaksana.index :pelaksana="$pelaksana" />
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="alert alert-info">Tidak ada data</div>
                @endempty
            </div>




            <!--  BEGIN CUSTOM SCRIPTS FILE  -->
            <x-slot:footerFiles>
                <script src="{{ asset('plugins/global/vendors.min.js') }}"></script>
                @vite(['resources/assets/js/custom.js'])
                <script src="{{ asset('plugins/table/datatable/datatables.js') }}"></script>
                <script src="{{ asset('plugins/table/datatable/button-ext/dataTables.buttons.min.js') }}"></script>
                <script src="{{ asset('plugins/table/datatable/button-ext/jszip.min.js') }}"></script>
                <script src="{{ asset('plugins/table/datatable/button-ext/buttons.html5.min.js') }}"></script>
                <script src="{{ asset('plugins/table/datatable/button-ext/buttons.print.min.js') }}"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
                <script src="{{ asset('plugins/sweetalerts2/sweetalerts2.min.js') }}"></script>
                <script type="module" src="{{asset('plugins/font-icons/feather/feather.min.js')}}"></script>
                <script>
                    $('#html5-extension').DataTable({
                        "dom": "<'dt--top-section'<'row'<'col-sm-12 col-md-6 d-flex justify-content-md-start justify-content-center'B><'col-sm-12 col-md-6 d-flex justify-content-md-end justify-content-center mt-md-0 mt-3'f>>>" +
                            "<'table-responsive'tr>" +
                            "<'dt--bottom-section d-sm-flex justify-content-sm-between text-center'<'dt--pages-count  mb-sm-0 mb-3'i><'dt--pagination'p>>",
                        buttons: {
                            buttons: [{
                                    extend: 'copy',
                                    className: 'btn'
                                },
                                {
                                    extend: 'csv',
                                    className: 'btn'
                                },
                                {
                                    extend: 'excel',
                                    className: 'btn'
                                },
                                {
                                    extend: 'print',
                                    customize: function(win) {
                                        $(win.document.body).find('h1').css('text-align', 'left');
                                        $(win.document.body)
                                            .css("height", "auto")
                                            .css("min-height", "0");

                                        $(win.document.body).find('h1')
                                            .addClass('top-title')
                                    },
                                    className: 'btn',
                                }
                            ]
                        },
                        "oLanguage": {
                            "oPaginate": {
                                "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>',
                                "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>'
                            },
                            "sInfo": "Halaman _PAGE_ dari _PAGES_",
                            "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
                            "sSearchPlaceholder": "Cari...",
                            "sLengthMenu": "Hasil :  _MENU_",
                        },
                        "stripeClasses": [],
                        "lengthMenu": [7, 10, 20, 50],
                        "pageLength": 10
                    });
                </script>
                <script>
                    @if (session()->has('status'))
                        Swal.fire({
                            title: 'Info',
                            text: '{{ session('status') }}',
                            icon: 'success',
                            timer: 3000,
                        });
                    @endif
                </script>
                <script>
                    $('.hapus').click(function(event) {
                        event.preventDefault();
                        Swal.fire({
                            title: 'Are you sure?',
                            text: "You won't be able to revert this!",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Yes, delete it!'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $(this).closest("form").submit();
                            }
                        })
                    });
                </script>
                </x-slot>
                <!--  END CUSTOM SCRIPTS FILE  -->
</x-base-layout>
