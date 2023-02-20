<x-base-layout :scrollspy="false">

  <x-slot:pageTitle>
    {{ $title }}
    </x-slot>

    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <x-slot:headerFiles>
      <!--  BEGIN CUSTOM STYLE FILE  -->
      <link rel="stylesheet" href="{{ asset('plugins/apex/apexcharts.css') }}">

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
          <x-widgets._w-card-five title="Total Pagu" balance="{{ number_format($pekerjaan->sum('pagu'), 0, ',', '.') }}" />
        </div>
        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">
          <x-widgets._w-three title="Summary" jiwa="{{ $pekerjaan->sum('output') * 5 }}"
            sarpras="{{ $pekerjaan->count() }}" />
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
                            <th class="text-center" scope="col">Pagu</th>
                            <th class="text-center" scope="col">Status</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($kegiatan as $kegiatan)
                            <tr>
                                <td>
                                  {{ $kegiatan->sub_kegiatan }}
                                </td>
                                <td class="text-center">Rp{{ number_format($kegiatan->pekerjaan->sum('pagu'),2,',','.') }}</td>
                                <td class="text-center">
                                  <span class="badge badge-light-success">OK</span>
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

      <!--  BEGIN CUSTOM SCRIPTS FILE  -->
      <x-slot:footerFiles>
        <script src="{{ asset('plugins/apex/apexcharts.min.js') }}"></script>

        {{-- Analytics --}}

        </x-slot>
        <!--  END CUSTOM SCRIPTS FILE  -->
</x-base-layout>
