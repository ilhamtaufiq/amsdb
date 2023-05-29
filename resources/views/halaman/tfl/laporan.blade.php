<x-base-layout :scrollspy="false">

  <x-slot:pageTitle>
    Progress
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
      @vite(['resources/scss/light/assets/components/tabs.scss'])
      @vite(['resources/scss/dark/assets/components/tabs.scss'])
      @vite(['resources/scss/light/assets/components/modal.scss'])


      <!--  END CUSTOM STYLE FILE  -->
      </x-slot>
      <!-- END GLOBAL MANDATORY STYLES -->

      <!-- BREADCRUMB -->
      <div class="page-meta">
        <nav class="breadcrumb-style-one" aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">TFL Sanitasi 2023</li>
          </ol>
        </nav>
      </div>
      <!-- /BREADCRUMB -->
      <div class="row layout-top-spacing">
        <div class="col-12">
          <div class="alert alert-arrow-right alert-icon-right alert-light-success alert-dismissible fade show mb-4"
               role="alert">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                 stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                 class="feather feather-alert-circle">
              <circle cx="12" cy="12" r="10"></circle>
              <line x1="12" y1="8" x2="12" y2="12"></line>
              <line x1="12" y1="16" x2="12" y2="16"></line>
            </svg>
            <strong>Laporan Progres Kegiatan</strong> DAK Fisik Bidang Sanitasi 2023
          </div>
        </div>
        <div class="col-md-12">
        </div>
      </div>

      <div class="simple-pill">
        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
          <li class="nav-item" role="presentation">
            <button class="nav-link active" id="pills-kontrak-tab" data-bs-toggle="pill" data-bs-target="#pills-kontrak"
                    type="button" role="tab" aria-controls="pills-kontrak" aria-selected="true">Data Kontrak</button>
          </li>
          <li class="nav-item" role="presentation">
            <button class="nav-link" id="pills-progress-tab" data-bs-toggle="pill" data-bs-target="#pills-progress"
                    type="button" role="tab" aria-controls="pills-progress" aria-selected="false">Data Progress</button>
          </li>
          <li class="nav-item" role="presentation">
            <button class="nav-link" id="pills-foto-tab" data-bs-toggle="pill" data-bs-target="#pills-foto"
                    type="button" role="tab" aria-controls="pills-foto" aria-selected="false">Foto Kegiatan</button>
          </li>
          <li class="nav-item" role="presentation">
            <button class="nav-link" id="pills-penerima-tab" data-bs-toggle="pill" data-bs-target="#pills-penerima"
                    type="button" role="tab" aria-controls="pills-penerima" aria-selected="false">Penerima Manfaat</button>
          </li>

        </ul>
        <div class="tab-content" id="pills-tabContent">
          <div class="tab-pane fade show active" id="pills-kontrak" role="tabpanel" aria-labelledby="pills-kontrak-tab"
               tabindex="0">
            <h2 class="mt-3">{{ $data->nama_pekerjaan }}</h2>
            <form id="input" class="simple-example needs-validation" method="post"
                    action="{{ route('kontrak.store') }}" novalidate>
                @csrf
                <div class="form-row">
                <div class="row">
                    <div class="col-md-12 mb-4">
                        <label for="pekerjaan">Nama Pekerjaan</label>
                        <input type="text" class="form-control" placeholder="{{ $data->nama_pekerjaan }}" disabled>
                        <input type="hidden" name="pekerjaan_id" value="{{ $data->id }}" class="form-control">
                        <div class="invalid-feedback">
                        </div>
                    </div>
                    <div class="col-md-12 mb-12">
                        <label for="pelaksana">Pelaksana</label>
                      <input type="text" placeholder="Nama TPS KSM" value="" class="form-control">
                        <div class="invalid-feedback">
                        </div>
                      </div>
                </div>
                <div class="row layout-top-spacing">
                    <div class="col-md-3 mb-4">
                        <label for="pekerjaan">Tanggal Mulai</label>
                        <input type="date" class="form-control" placeholder="Tanggal Mulai" name="tgl_mulai">
                        <div class="invalid-feedback">
                        </div>
                      </div>
                    <div class="col-md-3 mb-4">
                        <label for="pekerjaan">Tanggal Selesai</label>
                        <input type="date" class="form-control" placeholder="Tanggal Selesai" name="tgl_selesai">
                        <div class="invalid-feedback">
                        </div>
                      </div>
                    <div class="col-md-6 mb-4">
                        <label for="pekerjaan">Nilai Kontrak</label>
                        <input type="number" class="form-control" placeholder="Nilai Kontrak" name="nilai_kontrak">
                        <div class="invalid-feedback">
                        </div>
                      </div>
                </div>
                  <div class="row">
                    <div class="col-md-4 mb-4">
                      <input type="hidden" class="form-control" id="kode_rup" name="kode_rup" placeholder="Kode RUP"
                             value="0" required>
                      <div class="invalid-feedback">
                      </div>
                    </div>
                    <div class="col-md-4 mb-4">
                      <input type="hidden" class="form-control" id="kode_paket" name="kode_paket"
                             placeholder="Kode Paket" value="0" required>
                      <div class="invalid-feedback">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6 mb-4">
                      <input type="hidden" value="swakelola" class="form-control" name="no_sppbj"></input>
                    </div>
                    <div class="col-md-6 mb-4">
                      <input type="hidden" value="2023-01-01" class="form-control form-control" name="tgl_sppbj"></input>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6 mb-4">
                      <label for="no_spk">Nomor Kontrak</label>
                      <input type="text" class="form-control" name="no_spk"></input>
                    </div>
                    <div class="col-md-6 mb-4">
                      <label for="tgl_spk">Tanggal Kontrak</label>
                      <input type="date" class="form-control form-control" name="tgl_spk"></input>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6 mb-4">
                      <input type="text" value="swakelola" class="form-control" name="no_spmk"></input>
                    </div>
                    <div class="col-md-6 mb-4">
                      <input type="date" value="2023-01-01" class="form-control form-control" name="tgl_spmk"></input>
                    </div>
                  </div>
                </div>
                <button class="btn btn-primary submit-fn mt-2" type="submit">Submit form</button>
              </form>
          </div>
          <div class="tab-pane fade" id="pills-progress" role="tabpanel" aria-labelledby="pills-progress-tab"
               tabindex="0">
               <div class="row">
                <div class="col-xl-12 col-lg-12 col-sm-12 layout-spacing">
                  <div class="statbox widget box box-shadow">
                    <div class="widget-content widget-content-area">
                        <div class="btn-group">
                            <a href="javascript:void(0)" id="post" data-id="{{ $data->id }}"
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
                    </div>
                  </div>
                </div>
            </div>
            <div class="modal fade modal-lg" id="modalPost" tabindex="-1" role="dialog" aria-labelledby="postLabel"
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
               <form action="{{ route('output.store') }}" method="post" class="form-horizontal" novalidate="">
                 @csrf
                 <table class="table">
                   <thead>
                     <th>Triwulan</th>
                     <th>Fisik</th>
                     <th>Keuangan</th>
                   </thead>
                   <tbody>
                     <td>
                       <input type="number" class="form-control" id="triwulan" name="triwulan"
                              placeholder="Triwulan" value="">
                     </td>
                     <td>
                       <input type="number" class="form-control" id="fisik" name="fisik"
                              placeholder="Fisik" value="">
                     </td>
                     <td>
                       <input type="number" class="form-control" id="keuangan" name="keuangan"
                              placeholder="Keuangan" value="">
                     </td>
                   </tbody>
                 </table>
                 <input type="hidden" id="pekerjaan_id" name="pekerjaan_id" value="">
             </div>
             <div class="modal-footer">
               <button type="submit" id="btn-save" class="btn btn-primary" value="add">Save</button>
             </div>
             </form>
             <!-- Table -->
             <table id='empTable' class="dt-table-hover table">
               <thead>
                 <tr>
                   <th style="text-align:center;">Triwulan</th>
                   <th style="text-align:center;">Fisik</th>
                   <th style="text-align:center;">Keuangan</th>
                 </tr>
               </thead>
               <tbody></tbody>
             </table>
           </div>
         </div>
       </div>
          </div>
          <div class="tab-pane fade" id="pills-foto" role="tabpanel" aria-labelledby="pills-foto-tab"
               tabindex="0">
            <p class="mt-3">In diam odio, ullamcorper vitae dolor vel, lobortis rhoncus odio. Nullam lacinia euismod
              ex vitae ullamcorper. Integer fringilla arcu nunc, et tempus sapien ornare sed. Nam fringilla velit nec
              bibendum consectetur. Etiam pellentesque eu nulla vel tincidunt. </p>
            <p>Ut nec nunc sed risus viverra vehicula non non purus. Nunc semper sem ut ante suscipit vulputate. Integer
              tempus ornare ligula, sed lacinia leo posuere eu. </p>
          </div>
          <div class="tab-pane fade" id="pills-penerima" role="tabpanel" aria-labelledby="pills-penerima-tab"
               tabindex="0">
            <p class="mt-3">Nullam feugiat, sapien a lacinia condimentum, libero nibh fermentum lectus, eu dictum
              justo ex sit amet neque. Sed felis arcu, efficitur eget diam eget, maximus dapibus enim. Sed vitae varius
              lorem. Fusce non accumsan diam, quis porttitor dolor. </p>
            <p>Aenean ut aliquet dolor. Integer accumsan odio non dignissim lobortis. Sed rhoncus ante eros, vel
              ullamcorper orci molestie congue. Phasellus vel faucibus dolor. Morbi magna eros, vulputate eu sem nec,
              venenatis egestas quam. Maecenas hendrerit mollis eros, eget faucibus quam dignissim vel.</p>
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

              $.ajax({
                url: "{{ route('output.api') }}",
                type: "GET",
                data: {
                  pekerjaan_id: pekerjaan_id,
                },
                dataType: 'json',
                success: function(response) {
                  console.log(response);
                  createRows(response);
                }
              });
            });

            function createRows(response) {
              var len = 0;
              $('#empTable tbody').empty(); // Empty <tbody>
              if (response != null) {
                len = response.length;
              }

              if (len > 0) {
                for (var i = 0; i < len; i++) {
                  var triwulan = response[i].triwulan;
                  var fisik = response[i].fisik;
                  var keuangan = response[i].keuangan;

                  var tr_str = "<tr>" +
                    "<td align='center'>" + triwulan + "</td>" +
                    "<td align='center'>" + fisik + " Unit</td>" +
                    "<td align='center'>" + keuangan + "</td>" +
                    "</tr>";

                  $("#empTable tbody").append(tr_str);
                }
              } else {
                var tr_str = "<tr>" +
                  "<td align='center' colspan='4'>No record found.</td>" +
                  "</tr>";

                $("#empTable tbody").append(tr_str);
              }
            }
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
