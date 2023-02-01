<x-base-layout :scrollspy="false">

  <x-slot:pageTitle>
    {{ $title }}
    </x-slot>

    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <x-slot:headerFiles>
      <!--  BEGIN CUSTOM STYLE FILE  -->
      <link rel="stylesheet" href="{{ asset('plugins/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css') }}">
      <link rel="stylesheet" href="{{ asset('plugins/glightbox/glightbox.min.css') }}">
      <link rel="stylesheet" href="{{ asset('plugins/splide/splide.min.css') }}">

      @vite(['resources/scss/light/assets/components/tabs.scss'])
      @vite(['resources/scss/light/assets/components/accordions.scss'])
      @vite(['resources/scss/light/assets/apps/ecommerce-details.scss'])
      @vite(['resources/scss/dark/assets/components/tabs.scss'])
      @vite(['resources/scss/dark/assets/components/accordions.scss'])
      @vite(['resources/scss/dark/assets/apps/ecommerce-details.scss'])
      <!--  END CUSTOM STYLE FILE  -->
      </x-slot>
      <!-- END GLOBAL MANDATORY STYLES -->

      <div class="row layout-top-spacing">

        <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12 mb-4">
          <div class="widget-content widget-content-area br-8">
            <div class="row justify-content-center">
              <div class="col-xxl-5 col-xl-6 col-lg-7 col-md-7 col-sm-9 col-12 pe-3">
                <!-- Swiper -->
                <div id="main-slider" class="splide">
                  <div class="splide__track">
                    <ul class="splide__list">
                      @foreach ($pekerjaan->file as $item)
                        <li class="splide__slide">
                          <a href="/storage/{{ $item->path }}" class="glightbox">
                            <img alt="ecommerce" src="/storage/{{ $item->path }}">
                          </a>
                        </li>
                      @endforeach
                    </ul>
                  </div>
                </div>

                <div id="thumbnail-slider" class="splide">
                  <div class="splide__track">
                    <ul class="splide__list">
                      @foreach ($pekerjaan->file as $item)
                        <li class="splide__slide"><img alt="ecommerce" src="/storage/{{ $item->path }}"></li>
                      @endforeach
                    </ul>
                  </div>
                </div>

              </div>

              <div class="col-xxl-4 col-xl-5 col-lg-12 col-md-12 col-12 mt-xl-0 align-self-center mt-5">

                <div class="product-details-content">

                  <span class="badge badge-light-warning mb-3">{{ $pekerjaan->pokir == 1 ? 'Pokir':'' }}</span>

                  <h3 class="product-title mb-0">{{ $pekerjaan->nama_pekerjaan }}</h3>

                  <div class="review mb-4">

                  </div>

                  <div class="row">

                    <div class="col-md-9 col-sm-9 col-9">

                      <div class="pricing">

                        <span class="discounted-price">Rp{{ number_format($pekerjaan->kontrak->nilai_kontrak ?? '0', 0, ',', '.') }}</span>
                        <!-- <span class="regular-price">$30</span> -->
                      </div>

                    </div>
                    <div class="col-md-3 col-sm-3 col-3 text-end">
                      <div class="product-share">
                        <button class="btn btn-light-success btn-icon btn-rounded">
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                               fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                               stroke-linejoin="round" class="feather feather-share-2">
                            <circle cx="18" cy="5" r="3"></circle>
                            <circle cx="6" cy="12" r="3"></circle>
                            <circle cx="18" cy="19" r="3">
                            </circle>
                            <line x1="8.59" y1="13.51" x2="15.42" y2="17.49"></line>
                            <line x1="15.41" y1="6.51" x2="8.59" y2="10.49"></line>
                          </svg>
                        </button>
                      </div>
                    </div>

                  </div>

                  <hr class="mb-4">
                  <div class="row color-swatch mb-4">
                    <div class="col-xl-3 col-lg-6 col-sm-6 align-self-center">Pelaksana</div>
                    <div class="col-xl-9 col-lg-6 col-sm-6">
                      <div class="color-options text-xl-end">
                        <div class="form-check form-check-inline">
                          <span>{{ $pekerjaan->kontrak->pelaksana->nama ?? '' }}</span>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row color-swatch mb-4">
                    <div class="col-xl-3 col-lg-6 col-sm-6 align-self-center">Kegiatan</div>
                    <div class="col-xl-9 col-lg-6 col-sm-6">
                      <div class="color-options text-xl-end">
                        <div class="form-check form-check-inline">
                          <span>{{ $pekerjaan->kegiatan->sub_kegiatan }}</span>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row color-swatch mb-4">
                    <div class="col-xl-3 col-lg-6 col-sm-6 align-self-center">Kecamatan</div>
                    <div class="col-xl-9 col-lg-6 col-sm-6">
                      <div class="color-options text-xl-end">
                        <div class="form-check form-check-inline">
                          <span>{{ $pekerjaan->kec->n_kec }}</span>
                        </div>

                      </div>
                    </div>
                  </div>
                  <div class="row color-swatch mb-4">
                    <div class="col-xl-3 col-lg-6 col-sm-6 align-self-center">Desa</div>
                    <div class="col-xl-9 col-lg-6 col-sm-6">
                      <div class="color-options text-xl-end">
                        <div class="form-check form-check-inline">
                          <span>{{ $pekerjaan->desa->n_desa }}</span>
                        </div>

                      </div>
                    </div>
                  </div>

                  <hr class="mb-5 mt-4">

                </div>

              </div>
            </div>

          </div>

        </div>

        <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12 mb-4">

          <div class="widget-content widget-content-area br-8">

            <div class="production-descriptions simple-pills">

              <div class="pro-des-content">
                <div id="iconsAccordion" class="accordion-icons accordion">

                  <div class="card">
                    <div class="card-header" id="headingTwo3">
                      <section class="mb-0 mt-0">
                        <div role="menu" class="collapsed" data-bs-toggle="collapse"
                             data-bs-target="#iconAccordionTwo" aria-expanded="false"
                             aria-controls="iconAccordionTwo">
                          <div class="accordion-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24"
                                 height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                 stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                 class="feather feather-message-circle">
                              <path
                                    d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z">
                              </path>
                            </svg></div>
                          Kontrak <div class="icons"><svg xmlns="http://www.w3.org/2000/svg" width="24"
                                 height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                 stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                 class="feather feather-chevron-down">
                              <polyline points="6 9 12 15 18 9"></polyline>
                            </svg></div>
                        </div>
                      </section>
                    </div>
                    <div id="iconAccordionTwo" class="collapse" aria-labelledby="headingTwo3"
                         data-bs-parent="#iconsAccordion">
                      <div class="card-body">

                        <div class="row">

                          <div class="col-md-12 mx-auto">

                            <div class="media mb-4">
                              <div class="media-body">
                                 <table>
                                    <tr>
                                        <th style="width: 50%">Kode RUP</th>
                                        <td>{{ $pekerjaan->kontrak->kode_rup ?? '' }}</td>
                                    </tr>
                                    <tr>
                                        <th style="width: 50%">Kode Paket</th>
                                        <td>{{ $pekerjaan->kontrak->kode_paket ?? '' }}</td>
                                    </tr>
                                    <tr>
                                        <th style="width: 50%">Masa Pelaksanaan</th>
                                        <td>{{ $pekerjaan->kontrak->tgl_mulai ?? '' }} Sampai {{ $pekerjaan->kontrak->tgl_selesai ?? '' }}</td>
                                    </tr>
                                    <tr>
                                        <th style="width: 50%">SPK</th>
                                        <td>{{ $pekerjaan->kontrak->no_spk ?? '' }} Tanggal {{ $pekerjaan->kontrak->tgl_spk ?? '' }}</td>
                                    </tr>
                                    <tr>
                                        <th style="width: 50%">SPMK</th>
                                        <td>{{ $pekerjaan->kontrak->no_spmk ?? '' }} Tanggal {{ $pekerjaan->kontrak->tgl_spmk ?? ''}}</td>
                                    </tr>
                                    <tr>
                                        <th style="width: 50%">SPPBJ</th>
                                        <td>{{ $pekerjaan->kontrak->no_sppbj ?? '' }} Tanggal {{ $pekerjaan->kontrak->tgl_sppbj ?? ''  }}</td>
                                    </tr>
                                 </table>
                              </div>
                            </div>

                          </div>

                        </div>
                      </div>
                    </div>
                  </div>

                </div>
              </div>
            </div>

          </div>

        </div>

      </div>

      <!--  BEGIN CUSTOM SCRIPTS FILE  -->
      <x-slot:footerFiles>
        <script src="{{ asset('plugins/global/vendors.min.js') }}"></script>
        <script src="{{ asset('plugins/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js') }}"></script>
        <script src="{{ asset('plugins/glightbox/glightbox.min.js') }}"></script>
        <script src="{{ asset('plugins/splide/splide.min.js') }}"></script>
        @vite(['resources/assets/js/apps/ecommerce-details.js'])
        </x-slot>
        <!--  END CUSTOM SCRIPTS FILE  -->
</x-base-layout>
