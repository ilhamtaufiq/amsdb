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
        <div class="row">
            {{ $output }}
            <table id="html5-extension" class="table" style="width:100%">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Pekerjaan</th>
                    <th>Target Output</th>
                    <th>Realisasi Fisik</th>
                    <th>Realisai Keuangan</th>
                    <th>% Fisik</th>
                    <th>% Keuangan</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @php
                    $i = 1;
                  @endphp

                  @foreach ($output as $output)
                    <tr>
                      <td>{{ $i++ }}</td>
                      <td>{{ $output->pekerjaan->nama_pekerjaan }}</td>
                      <td>{{ $output->pekerjaan->output }}</td>
                      <td>{{ $output->fisik }}</td>
                      <td>{{ $output->keuangan }}</td>
                      <td></td>
                      <td></td>
                      <td>
                          @role('Master')

                        <div class="btn-group">
                          <a href="{{ route('output.show', $output->id) }}" class="action-btn btn-view bs-tooltip me-2"
                             data-toggle="tooltip" data-placement="top" title="View">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                 fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                 stroke-linejoin="round" class="feather feather-printer">
                              <polyline points="6 9 6 2 18 2 18 9"></polyline>
                              <path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2">
                              </path>
                              <rect x="6" y="14" width="12" height="8"></rect>
                            </svg>
                          </a>
                          <a href="{{ route('output.edit', $output->id) }}" class="action-btn btn-edit bs-tooltip me-2"
                             data-toggle="tooltip" data-placement="top" title="Edit">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                 fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                 stroke-linejoin="round" class="feather feather-edit-2">
                              <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path>
                            </svg>
                          </a>
                          <form action="{{ route('output.destroy', $output->id) }}" method="post">
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
                        @endrole

                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
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
                  <form action="{{ route('output.store') }}"  method="post" class="form-horizontal" novalidate="">
                      @csrf
                    <div class="form-group">
                      <label>Realisasi Output</label>
                      <input type="number" class="form-control" id="triwulan" name="realisasi[0][triwulan]"
                      placeholder="Volume Output" value="">
                      <input type="number" class="form-control" id="realisasi" name="realisasi[0][volume]"
                             placeholder="Volume Output" value="">
                             <input type="number" class="form-control" id="realisasi" name="realisasi[0][keuangan]"
                             placeholder="Volume Output" value="">
                    </div>
                    <input type="hidden" id="pekerjaan_id" name="pekerjaan_id" value="">
                </div>
                <div class="modal-footer">
                  <button class="btn btn-light-dark" data-bs-dismiss="modal">Discard</button>
                  <button type="submit" id="btn-save" class="btn btn-primary" value="add">Save</button>
                </div>
              </form>
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
          //   $('#btn-save').click(function(e) {
          //     e.preventDefault();
          //     //define variable
          //     let pekerjaan_id = $('#pekerjaan_id').val();
          //     let realisasi = $('#realisasi').val();
          //     let token = $("meta[name='csrf-token']").attr("content");

          //     //ajax
          //     $.ajax({
          //       url: `{{ route('output.store') }}`,
          //       type: "POST",
          //       cache: false,
          //       data: {
          //         "pekerjaan_id": pekerjaan_id,
          //         "realisasi": JSON.stringify(realisasi),
          //         "_token": token
          //       },
          //       success: function(response) {
          //         //show success message
          //         Swal.fire({
          //           icon: 'success',
          //           text: "Berhasil Disimpan",
          //           showConfirmButton: true,
          //           timer: 3000
          //         }).then(function() {
          //           window.location.reload();
          //         });;


          //         //close modal
          //         $('#modal-create').modal('hide');


          //       },
          //       error: function(error) {

          //         if (error.responseJSON.title[0]) {

          //           //show alert
          //           $('#alert-title').removeClass('d-none');
          //           $('#alert-title').addClass('d-block');

          //           //add message to alert
          //           $('#alert-title').html(error.responseJSON.title[0]);
          //         }

          //         if (error.responseJSON.content[0]) {

          //           //show alert
          //           $('#alert-content').removeClass('d-none');
          //           $('#alert-content').addClass('d-block');

          //           //add message to alert
          //           $('#alert-content').html(error.responseJSON.content[0]);
          //         }

          //       }

          //     });

          //   });
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
