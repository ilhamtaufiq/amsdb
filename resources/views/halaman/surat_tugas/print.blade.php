<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<style type="text/css">
  .tg {
    border-collapse: collapse;
    border-spacing: 0;
  }

  .tg td {
    border-color: black;
    border-style: solid;
    border-width: 1px;
    font-family: Arial, sans-serif;
    font-size: 14px;
    overflow: hidden;
    padding: 10px 5px;
    word-break: normal;
  }

  .tg th {
    border-color: black;
    border-style: solid;
    border-width: 1px;
    font-family: Arial, sans-serif;
    font-size: 14px;
    font-weight: normal;
    overflow: hidden;
    padding: 10px 5px;
    word-break: normal;
  }

  .tg .tg-0lax {
    text-align: left;
    vertical-align: top
  }

  .tg .tg-0pky {
    border-color: inherit;
    text-align: left;
    vertical-align: top
  }

  .center {
    margin-left: auto;
    margin-right: auto;
  }

  .right {
    margin-left: auto;
    margin-right: 50%;
  }


  table,
  td,
  th {
    border: 1px solid;
    vertical-align: top;
  }

  table {
    border: 0px;
    width: 90%;
    border-collapse: collapse;
  }
</style>

<head>

</head>

<body>

  <img src="{{ public_path('/storage/files/kop.png') }}" style="width:100%;">
  <table style="border: 0px;" class="center">
    <thead>
      <tr>
        <td style="border: 0px; text-align: center;">
            <u><b>SURAT PERINTAH TUGAS</b></u><br>
            Nomor   :    800/         /Bid.ABS
        </td>
      </tr>
    </thead>
    <tbody style="">

    </tbody>
  </table>
<br>
  <table class="tg center">
    <thead>
      <tr>
        <th class="" style="width: 12%; border-width: 0px; text-align: left;">Dasar</th>
        <th class="" style="width: 3%; border-width: 0px;">:</th>
        <th class="tg-0lax" style="border-width: 0px;">
            {{ $data->dasar }}
        </th>
      </tr>
    </thead>
  </table>
  <h4 style="text-align: center;">MEMERINTAHKAN KEPADA:</h4>
  <div class="row">
    <div class="col">
      <table class="tg center">
        <thead>
            @php
            $i = 1;
            @endphp

            @foreach ($data->kepada as $item)
            <tr>
                <td class="tg-0lax" style="border-width: 0px;" rowspan="3">
                @if ($i == 1)
                    Kepada
                @endif
                </td>
                <td class="tg-0lax" style="border-width: 0px;" rowspan="3">
                @if ($i == 1)
                    :
                @endif
                </td>
                <td class="tg-0lax" style="border-width: 0px;" rowspan="3">{{ $i++ }}</td>
                <td class="tg-0pky" style="border-width: 0px;">Nama</td>
                <td class="tg-0pky" style="border-width: 0px;">:</td>
                <td class="tg-0pky" style="border-width: 0px;">{{ $item['nama'] }}<br></td>
              </tr>
              <tr>
                <td class="tg-0pky" style="border-width: 0px;">NIP</td>
                <td class="tg-0pky" style="border-width: 0px;">:</td>
                <td class="tg-0pky" style="border-width: 0px;">{{ $item['nip'] }}<br></td>
              </tr>
              <tr>
                <td class="tg-0pky" style="border-width: 0px;">Pangkat, Gol. Ruang</td>
                <td class="tg-0pky" style="border-width: 0px;">:</td>
                <td class="tg-0pky" style="border-width: 0px;">{{ $item['jabatan'] }}</td>
              </tr>
            @endforeach

          {{-- <tr>
            <td class="tg-0lax">Kepada</td>
            <td class="tg-0lax">:</td>
            <td class="tg-0lax">2</td>
            <td class="tg-0pky">Nama</td>
            <td class="tg-0pky">:</td>
            <td class="tg-0pky">ISI NAMA<br></td>
          </tr>
          <tr>
            <td class="tg-0pky"></td>
            <td class="tg-0pky"></td>
            <td class="tg-0pky"></td>
            <td class="tg-0pky">NIP</td>
            <td class="tg-0pky">:</td>
            <td class="tg-0pky">ISI NIP<br></td>
          </tr>
          <tr>
            <td class="tg-0pky"></td>
            <td class="tg-0pky"></td>
            <td class="tg-0pky"></td>
            <td class="tg-0pky">Pangkat, Gol. Ruang</td>
            <td class="tg-0pky">:</td>
            <td class="tg-0pky">JF Teknik Penyehatan Lingkungan</td>
          </tr> --}}
        </thead>
      </table>
    </div>
  </div>
  <table class="tg center">
    <thead>
      <tr>
        <th class="" style="width: 12%; border-width: 0px; text-align: left;">Untuk</th>
        <th class="" style="width: 3%; border-width: 0px;">:</th>
        <th class="tg-0lax" style="border-width: 0px;">
            @php
                $i = 1;
            @endphp
            @foreach ($data->tujuan as $item)
           {{ $i++ }}. {{ $item['untuk'] }} <br>
           @endforeach
        </th>
      </tr>
    </thead>
  </table>
  <table style="border: 0px;" class="center">
    <thead>
    <tr>
        <td style="border: 1px; padding-left: 66%;text-align: left;">Dikeluarkan di</td>
        <td style="border: 1px; padding-left: 33%;">:</td>
        <td style="border: 1px; padding-left: 20%;">Cianjur</td>
    </tr>
    <tr>
        <td style="border: 1px; padding-left: 66%; text-align: left;">Pada Tanggal</td>
        <td style="border: 1px; padding-left: 33%;">:</td>
        <td style="border: 1px; padding-left: 20%;">22 Februari 2023</td>
    </tr>

    </thead>
  </table>
  <br>
  <table style="border: 0px;" class="center">
    <thead>
      <tr>
        <td style="border: 0px; padding-left: 50%; text-align: center;">KEPALA DINAS</td>
      </tr>
    </thead>
    <tbody style="">
      <tr>
        <td style="border: 0px; padding-top:6%; padding-left: 50%; text-align: center;">
            <u><b>CEPI RAHMAT FADIANA, ST, MT</b></u><br>
            NIP. 19700218 1998031 006
        </td>
      </tr>
    </tbody>
  </table>
</body>

</html>
