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

      <style>
        html,
        body {
          height: 100%;
          margin: 0;
        }

        .leaflet-container {
          height: 400px;
          width: 600px;
          max-width: 100%;
          max-height: 100%;
        }
      </style>

      <style>
        #map {
          width: auto;
          height: 500px;
        }

        .info {
          padding: 6px 8px;
          font: 14px/16px Arial, Helvetica, sans-serif;
          background: white;
          background: rgba(255, 255, 255, 0.8);
          box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
          border-radius: 5px;
        }

        .info h4 {
          margin: 0 0 5px;
          color: #777;
        }

        .legend {
          text-align: left;
          line-height: 18px;
          color: #555;
        }

        .legend i {
          width: 18px;
          height: 18px;
          float: left;
          margin-right: 8px;
          opacity: 0.7;
        }
      </style>

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
                        <th class="text-center" scope="col">Status</th>
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
      <div class="row layout-top-spacing">
        <div class="row">
          <div class="card">
            <div class="card-body">
              <div id='map'></div>
            </div>
          </div>
        </div>
      </div>

      <!--  BEGIN CUSTOM SCRIPTS FILE  -->
      <x-slot:footerFiles>
        <script>
          var jsonObj = {
            members: {
              host: "hostName",
              viewers: {
                user1: "value1",
                user2: "value2",
                user3: "value3"
              }
            }
          }
        </script>
        <script src="{{ asset('plugins/apex/apexcharts.min.js') }}"></script>
        <script src="{{ asset('plugins/cianjur.js') }}"></script>

        <script type="text/javascript">
          // statesData.features.properties[newUser] = newValue;
          statesData.features.forEach(function(feature) {
            feature.properties["newUser"] = "newValue";
            console.log(feature.properties);
          });

          //   console.log(statesData);


          const map = L.map('map').setView([-6.816229055059188, 107.14214847311646], 9);

          const tiles = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
          }).addTo(map);

          var marker = L.marker([-6.816996070711276, 107.14232013448189]).addTo(map);
          // control that shows state info on hover
          const info = L.control();

          info.onAdd = function(map) {
            this._div = L.DomUtil.create('div', 'info');
            this.update();
            return this._div;
          };

          info.update = function(props) {
            const contents = props ? `<b>Kecamatan ${props.nama_kec}</b><br />` : 'Klik Kecamatan';
            this._div.innerHTML = `<h4>Kabupaten Cianjur</h4>${contents}`;
            bindPopup(props ? `<b>Kecamatan ${props.nama_kec}</b><br />` : 'Klik Kecamatan').openPopup();
          };

          info.addTo(map);


          function style(feature) {
            return {
              weight: 2,
              opacity: 1,
              color: 'white',
              dashArray: '3',
              fillOpacity: 0.7,
              fillColor: feature.properties.fillColor
            };
          }

          function highlightFeature(e) {
            const layer = e.target;

            layer.setStyle({
              weight: 5,
              color: '#666',
              dashArray: '',
              fillOpacity: 0.7
            });

            layer.bringToFront();

            info.update(layer.feature.properties);
          }

          /* global statesData */
          const geojson = L.geoJson(statesData, {
            style,
            onEachFeature
          }).addTo(map);

          function resetHighlight(e) {
            geojson.resetStyle(e.target);
            info.update();
          }

        //   function onMapMoveEnd(e) {
        //     const layer = e.target;
        //     console.log(layer);
        //     this.bindPopup(this.layer.feature.properties).openPopup();
        //   }

          function zoomToFeature(e) {
            // map.once('moveend', onMapMoveEnd, this);
            map.fitBounds(e.target.getBounds());

          }

          function onEachFeature(feature, layer) {
            layer.on({
              mouseover: highlightFeature,
              mouseout: resetHighlight,
              click: zoomToFeature
            });
          }

          // map.attributionControl.addAttribution('Population data &copy; <a href="http://census.gov/">US Census Bureau</a>');


          // const legend = L.control({position: 'bottomright'});

          // legend.onAdd = function (map) {

          // 	const div = L.DomUtil.create('div', 'info legend');
          // 	const grades = [0, 10, 20, 50, 100, 200, 500, 1000];
          // 	const labels = [];
          // 	let from, to;

          // 	for (let i = 0; i < grades.length; i++) {
          // 		from = grades[i];
          // 		to = grades[i + 1];

          // 		labels.push(`<i style="background:${getColor(from + 1)}"></i> ${from}${to ? `&ndash;${to}` : '+'}`);
          // 	}

          // 	div.innerHTML = labels.join('<br>');
          // 	return div;
          // };

          // legend.addTo(map);
        </script>

        {{-- Analytics --}}

        </x-slot>
        <!--  END CUSTOM SCRIPTS FILE  -->
</x-base-layout>
