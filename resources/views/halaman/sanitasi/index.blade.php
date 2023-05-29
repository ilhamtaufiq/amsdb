<x-base-layout :scrollspy="false">

  <x-slot:pageTitle>
    {{ $title }}
    </x-slot>

    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <x-slot:headerFiles>
      <!--  BEGIN CUSTOM STYLE FILE  -->
      <link rel="stylesheet" href="{{ asset('plugins/apex/apexcharts.css') }}">
      <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css"
            integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI=" crossorigin="" />
      <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"
              integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM=" crossorigin=""></script>

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

      @vite(['resources/scss/light/assets/components/list-group.scss'])
      @vite(['resources/scss/light/assets/widgets/modules-widgets.scss'])

      @vite(['resources/scss/dark/assets/components/list-group.scss'])
      @vite(['resources/scss/dark/assets/widgets/modules-widgets.scss'])
      <!--  END CUSTOM STYLE FILE  -->
      </x-slot>
      <!-- END GLOBAL MANDATORY STYLES -->

      <!-- Analytics -->

      <div class="row layout-top-spacing">
        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">
          <x-widgets._w-card-five title="Total Pagu"
                                  balance="{{ number_format($pekerjaan->sum('pagu'), 0, ',', '.') }}" />
        </div>
        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">
          <x-widgets._w-three title="Summary" jiwa="{{ $pekerjaan->sum('output') * 5 }}"
                              sarpras="{{ $pekerjaan->count() }}" />
        </div>
        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">
          <div class="widget widget-table-one">
            <div class="widget-heading">
              <h5 class="">Output</h5>
            </div>
            <div class="widget-content">
                <x-widgets._w-table-one title="Output Terbangun" icon="MCK" label="MCK" value="{{ $totalMCK }}" />
                <x-widgets._w-table-one title="Output Terbangun" icon="IPL" label="IPAL" value="{{ $totalIpal }}" />
                <x-widgets._w-table-one title="Output Terbangun" icon="TS" label="Tangki Septik Individual" value="{{ $totalTSindividual }}" />
                <x-widgets._w-table-one title="Output Terbangun" icon="TS" label="Tangki Septik Komunal" value="{{ $totalTSkomunal }}" />
                <x-widgets._w-table-one title="Output Terbangun" icon="SR" label="Sambungan Rumah" value="{{ $totalSR }}" />


            </div>
          </div>

        </div>

      </div>
      <div class="row">
        <div class="card">
          <div class="card-body">
            <div class="col-md-12">
              <div class="table-responsive">
                <table class="table-bordered table">
                  <thead>
                    <tr>
                      <th scope="col">Sub Kegiatan</th>
                      <th class="text-center" scope="col">Pagu</th>
                      <th class="text-center" scope="col">Output</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($kegiatan as $kegiatan)
                      <tr>
                        <td>
                          {{ $kegiatan->sub_kegiatan }}
                        </td>
                        <td class="text-center">Rp{{ number_format($kegiatan->pekerjaan->sum('pagu'), 2, ',', '.') }}
                        </td>
                        <td class="text-center">{{ $kegiatan->pekerjaan->sum('output') }} Unit</td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="row layout-top-spacing">
        @empty(!$pekerjaan)
          <div class="col-xl-12 col-lg-12 col-sm-12 layout-spacing">
            <div class="statbox widget box box-shadow">
              <div class="widget-content widget-content-area">
                <table id="html5-extension" class="dt-table-hover">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Kegiatan</th>
                      <th>Nama Pekerjaan</th>
                      <th>Target Output</th>
                      <th>Komponen</th>
                      <th>Pagu</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @php
                      $i = 1;
                    @endphp
                    @foreach ($pekerjaan as $key => $pekerjaan)
                      <tr>
                        <td>{{ $i++ }}</td>
                        <td>
                          {{ $pekerjaan->kegiatan->sub_kegiatan }}
                        </td>
                        <td>{{ $pekerjaan->nama_pekerjaan }} <span
                                class="badge badge-warning">{{ $pekerjaan->pokir == 1 ? 'Pokir' : '' }}</span> <br>
                          Target {{ $pekerjaan->output }} {{ $pekerjaan->satuan_output }}
                        </td>
                        <td>{{ $pekerjaan->output }} {{ $pekerjaan->satuan_output }}</td>
                        <td>
                          <ol type="a">
                            @foreach ($pekerjaan->spek as $item)
                              <li>{{ $item->komponen }} {{ $item->volume }} - {{ $item->satuan }}</li>
                            @endforeach
                            </ul>
                        </td>
                        <td>Rp{{ number_format($pekerjaan->pagu, 0, ',', '.') }}</td>
                        <td>
                          <div class="btn-group">
                            <a href="{{ route('pekerjaan.show', $pekerjaan->id) }}"
                               class="action-btn btn-view bs-tooltip me-2" data-toggle="tooltip" data-placement="top"
                               title="View">
                              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                   fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                   stroke-linejoin="round" class="feather feather-eye">
                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                <circle cx="12" cy="12" r="3"></circle>
                              </svg>
                            </a>
                            <a href="{{ route('pekerjaan.edit', $pekerjaan->id) }}"
                               class="action-btn btn-edit bs-tooltip me-2" data-toggle="tooltip" data-placement="top"
                               title="Edit">
                              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                   fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                   stroke-linejoin="round" class="feather feather-edit-2">
                                <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path>
                              </svg>
                            </a>
                            <form action="{{ route('pekerjaan.destroy', $pekerjaan->id) }}" method="post">
                              @csrf
                              @method('delete')
                              <a type="submit" class="action-btn btn-edit bs-tooltip me-2 hapus"
                                 class="action-btn btn-delete bs-tooltip" data-toggle="tooltip" data-placement="top"
                                 title="Delete">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                     fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                     stroke-linejoin="round" class="feather feather-trash-2">
                                  <polyline points="3 6 5 6 21 6"></polyline>
                                  <path
                                        d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                  </path>
                                  <line x1="10" y1="11" x2="10" y2="17"></line>
                                  <line x1="14" y1="11" x2="14" y2="17"></line>
                                </svg>
                              </a>
                            </form>

                          </div>
                        </td>
                      </tr>
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
        <script src="{{ asset('plugins/apex/apexcharts.min.js') }}"></script>
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
