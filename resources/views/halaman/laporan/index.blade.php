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
      <link rel="stylesheet" type="text/css" href="{{ asset('plugins/tomSelect/tom-select.default.min.css') }}">
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
            <li class="breadcrumb-item"><a href="#">Laporan</a></li>
            <li class="breadcrumb-item active" aria-current="page">Laporan Triwulan</li>
          </ol>
        </nav>
      </div>
      <!-- /BREADCRUMB -->
      <div class="seperator-header layout-top-spacing">
      </div>
      {{-- <div class="row">
        <div class="col-xl-12 col-lg-12 col-sm-12 layout-spacing">
          <div class="statbox widget box box-shadow">
            <div class="page widget-content widget-content-area">
              <table id="html5-extension" class="dt-table-hover">
                <thead>
                  <tr>
                    <th rowspan="3">No</th>
                    <th rowspan="3">SUB BIDANG/KEGIATAN</th>
                    <th colspan="3">PERENCANAAN KEGIATAN</th>
                    <th colspan="3">MEKANISME PELAKSANAAN</th>
                    <th colspan="4">REALISASI</th>
                    <th colspan="2" rowspan="3">Keterangan</th>
                  </tr>
                  <tr>
                    <th rowspan="2">Volume</th>
                    <th rowspan="2">Satuan</th>
                    <th rowspan="2">Pagu</th>
                    <th colspan="2">Swakelola</th>
                    <th rowspan="2">Metode Pembayaran</th>
                    <th colspan="2">Keuangan</th>
                    <th colspan="2">Fisik</th>
                  </tr>
                  <tr>
                    <th>Volume</th>
                    <th>Rp</th>
                    <th>Rp</th>
                    <th>%</th>
                    <th>Volume</th>
                    <th>%</th>
                  </tr>
                </thead>
                <tbody>
                @php
                    $i = 1;
                @endphp
                 @foreach ($pekerjaan as $item)
                 <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{ $item->nama_pekerjaan }}</td>
                    <td>{{ $item->output }}</td>
                    <td>{{ $item->satuan_output }}</td>
                    <td>{{ $item->pagu }}</td>
                    <td>{{ $item->output }}</td>
                    <td>{{ $item->pagu }}</td>
                    <td>Bertahap</td>
                    <td>9</td>
                    <td>10</td>
                    <td>11</td>
                    <td>12</td>
                    <td>13</td>
                    <td>14</td>
                  </tr>
                 @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div> --}}
      <div class="card">
        <div class="card-body">
            <form action="{{ route('laporan.pdf') }}">
                <div class="row">
                  <div class="col-lg-6">
                    <div class="mb-3">
                      <label>Triwulan</label>
                      <select class="form-control" name="triwulan" required>
                        <option value="">Pilih Triwulan</option>
                        <option value="1">Triwulan 1</option>
                        <option value="2">Triwulan 2</option>
                        <option value="3">Triwulan 3</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="mb-3">
                      <label>Kegiatan</label>
                      <select id="select-state" class="form-control" name="keg_id[]" multiple placeholder="Pilih Kegiatan" autocomplete="off">
                        <option value="">Pilih Kegiatan</option>
                        @foreach ($kegiatan as $key => $value)
                            <option value="{{ $value }}">{{ $key }}</option>
                        @endforeach
                        {{-- <option value="6">Sanitasi DAK</option>
                        <option value="2">AM 1</option>
                        <option value="3">AM 2</option> --}}
                      </select>
                    </div>
                  </div>
                </div>
                <br>
                <div class="row">
                    <p><span class="badge badge-success">Opsional</span></p>
                    <div class="col-md-4">
                        <div class="mb-4">
                            <label>Ukuran Font</label>
                            <input type="number" min="10" max="20" class="form-control" name="font" placeholder="Ukuran Font">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-4">
                            <label>Tanggal Dokumen</label>
                            <input type="date" class="form-control" name="tanggal" placeholder="Tanggal Dokumen">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-2">
                        <div class="mb-3">
                          <button class="btn btn-primary" type="submit">Lihat</button>
                        </div>
                    </div>
                </div>
              </form>

        </div>
      </div>
      <!--  BEGIN CUSTOM SCRIPTS FILE  -->
      <x-slot:footerFiles>
        <script src="https://cdn.jsdelivr.net/npm/tom-select/dist/js/tom-select.complete.min.js"></script>        <script src="{{ asset('plugins/global/vendors.min.js') }}"></script>
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
          new TomSelect("#select-state", {
            maxItems: 2
          });
        </script>
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
