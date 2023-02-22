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
      @vite(['resources/scss/light/assets/components/modal.scss'])
      <link rel="stylesheet" href="{{ asset('plugins/animate/animate.css') }}">
      @vite(['resources/scss/light/assets/elements/infobox.scss', 'resources/scss/dark/assets/elements/infobox.scss'])


      <!--  END CUSTOM STYLE FILE  -->
      </x-slot>
      <!-- END GLOBAL MANDATORY STYLES -->

      <!-- BREADCRUMB -->
      <div class="page-meta">
        <nav class="breadcrumb-style-one" aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Data</a></li>
            <li class="breadcrumb-item active" aria-current="page">Realisasi Output</li>
          </ol>
        </nav>
      </div>
      <!-- /BREADCRUMB -->
      <div class="seperator-header layout-top-spacing">

        <div class="info-box-2">
          <div class="info-box-2-bg" style="background-image: url({{Vite::asset('resources/images/undraw_1.svg')}});"></div>
          <div class="info-box-2-bg-blur"></div>
          <div class="info-box-2-content-wrapper">
            <h3 class="info-box-2-title">Total Jiwa</h3>
            <div class="info-box-2-content">
                <h3 class="info-box-2-title">{{ $output->sum('realisasi') * 5 }}</h3>
            </div>
          </div>
        </div>
        <div class="row">
            <div class="card">
               <div class="card-body">
                   <div class="col-md-12">
                       <div class="table-responsive">
                         <table class="table table-bordered">
                           <thead>
                             <tr>
                               <th scope="col">Sub Kegiatan</th>
                               <th class="text-center" scope="col">Output</th>
                               <th class="text-center" scope="col">Realisasi</th>
                             </tr>
                           </thead>
                           <tbody>
                               @foreach ($kegiatan as $kegiatan)
                               <tr>
                                   <td>
                                     {{ $kegiatan->sub_kegiatan }}
                                   </td>
                                   <td class="text-center">{{ $kegiatan->pekerjaan->sum('output') }} Unit</td>
                                   <td class="text-center">
                                     <span class="badge badge-light-success">Reserved</span>
                                   </td>
                                 </tr>
                               @endforeach
                           </tbody>
                         </table>
                       </div>
                     </div>
               </div>
            </div>
           </div>

      </div>
      <div class="row">
        @empty(!$output)
          <div class="col-xl-12 col-lg-12 col-sm-12 layout-spacing">
            <div class="statbox widget box box-shadow">
              <div class="widget-content widget-content-area">
                <table id="html5-extension" class="dt-table-hover">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Nama Pekerjaan</th>
                      <th>Output</th>
                      <th>Realisasi</th>
                      <th>Persentase</th>
                      <th>Jiwa</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @php
                      $i = 1;
                    @endphp
                    @foreach ($pekerjaan as $pekerjaan)
                      <tr>
                        <td>{{ $i++ }}</td>
                        <td>{{ $pekerjaan->nama_pekerjaan }}</td>
                        <td>{{ $pekerjaan->output }} {{ $pekerjaan->satuan_output }}</td>
                        <td>{{ $pekerjaan->realisasi_output->realisasi ?? 0 }} {{ $pekerjaan->satuan_output }}</td>
                        <td>
                          @php
                            $realisasi = $pekerjaan->realisasi_output->realisasi ?? 0;
                            if ($realisasi != 0) {
                                # code...
                                $persentase = ($realisasi / $pekerjaan->output) * 1;
                            } else {
                                # code...
                                $persentase = 0;
                            }
                            echo number_format($persentase * 100, 2, ',', '') . '%';
                          @endphp
                        </td>
                        <td>{{ $pekerjaan->realisasi_output->realisasi ?? 0 * 5 }}</td>
                        <td>
                            @role('Master')
                          @if ($pekerjaan->realisasi_output != null)
                            <div class="btn-group">
                              <a href="javascript:void(0)" id="post" data-id="{{ $pekerjaan->id }}"
                                 class="action-btn btn-edit bs-tooltip me-2" data-toggle="tooltip" data-placement="top"
                                 title="Edit">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                     fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                     stroke-linejoin="round" class="feather feather-edit">
                                  <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                  <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                </svg>
                              </a>
                              <form action="{{ route('output.destroy', $pekerjaan->realisasi_output) }}" method="post">
                                @csrf
                                @method('delete')
                                <a type="submit" class="action-btn btn-edit bs-tooltip me-2 hapus"
                                   class="action-btn btn-delete bs-tooltip" data-toggle="tooltip" data-placement="top"
                                   title="Delete">
                                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                       viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                       stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2">
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
                          @else
                            <div class="btn-group">
                              <a href="javascript:void(0)" id="post" data-id="{{ $pekerjaan->id }}"
                                 class="action-btn btn-edit bs-tooltip me-2" data-toggle="tooltip" data-placement="top"
                                 title="Edit">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                     fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                     stroke-linejoin="round" class="feather feather-edit">
                                  <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                  <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                </svg>
                              </a>
                            </div>
                          @endif
                          @endrole
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

      <div class="row layout-top-spacing">
        <div class="modal fade" id="modalPost" tabindex="-1" role="dialog" aria-labelledby="postLabel"
             aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="postLabel">Realisasi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                  <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                       viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                       stroke-linecap="round" stroke-linejoin="round" class="feather feather-x">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                  </svg>
                </button>
              </div>
              <div class="modal-body">
                <form id="formRealisasi" name="formRealisasi" class="form-horizontal" novalidate="">
                  <div class="form-group">
                    <label>Realisasi Output</label>
                    <input type="number" class="form-control" id="realisasi" name="realisasi"
                           placeholder="Volume Output" value="">
                  </div>
                  <input type="hidden" id="pekerjaan_id" name="pekerjaan_id" value="">
                </form>
              </div>
              <div class="modal-footer">
                <button class="btn btn-light-dark" data-bs-dismiss="modal">Discard</button>
                <button type="submit" id="btn-save" class="btn btn-primary" value="add">Save</button>
              </div>
            </div>
          </div>
        </div>
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
          $('body').on('click', '#post', function() {
            //open modal
            var pekerjaan_id = $(this).data('id');
            $('#pekerjaan_id').val(pekerjaan_id);
            $('#modalPost').modal('show');
          });

          //action create post
          $('#btn-save').click(function(e) {
            e.preventDefault();
            //define variable
            let pekerjaan_id = $('#pekerjaan_id').val();
            let realisasi = $('#realisasi').val();
            let token = $("meta[name='csrf-token']").attr("content");

            //ajax
            $.ajax({
              url: `{{ route('output.store') }}`,
              type: "POST",
              cache: false,
              data: {
                "pekerjaan_id": pekerjaan_id,
                "realisasi": realisasi,
                "_token": token
              },
              success: function(response) {
                //show success message
                Swal.fire({
                  icon: 'success',
                  text: "Berhasil Disimpan",
                  showConfirmButton: true,
                  timer: 3000
                }).then(function() {
                  window.location.reload();
                });;


                //close modal
                $('#modal-create').modal('hide');


              },
              error: function(error) {

                if (error.responseJSON.title[0]) {

                  //show alert
                  $('#alert-title').removeClass('d-none');
                  $('#alert-title').addClass('d-block');

                  //add message to alert
                  $('#alert-title').html(error.responseJSON.title[0]);
                }

                if (error.responseJSON.content[0]) {

                  //show alert
                  $('#alert-content').removeClass('d-none');
                  $('#alert-content').addClass('d-block');

                  //add message to alert
                  $('#alert-content').html(error.responseJSON.content[0]);
                }

              }

            });

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
