<style>
  .center {
    margin-left: auto;
    margin-right: auto;
  }

  table,
  td,
  th {
    border: 1px solid;
  }

  table {
    width: 90%;
    border-collapse: collapse;
  }
</style>
<img src="{{ public_path('/storage/files/kop.png') }}" style="width:100%;">
<div class="row">
  <div style="text-align:right; width:95%">
    Cianjur, {{ \Carbon\Carbon::parse($data->tanggal)->isoFormat('D MMMM Y') }}
  </div>
</div>
<h4 style="text-align: center;">Tanda Terima Penyerahan Berkas</h4>
<table class="center">
  <thead>
    <th style="width: 10%">No</th>
    <th>Berkas</th>
    <th>Jumlah</th>
  </thead>
  <tbody>
    @php
        $i = 1;
    @endphp
    @foreach ($data->berkas as $item)
      <tr>
        <td>{{ $i++ }}</td>
        <td>
          {{ $item['nama'] }}
        </td>
        <td>
            {{ $item['jumlah'] }}
        </td>
    @endforeach

    </tr>
  </tbody>
</table>

<div class="row" style="margin-top: 10%;">
  <table style="border: 0px;" class="center">
    <thead>
      <tr>
        <td style="border: 0px; text-align: center;">yang Menyerahkan</th>
        <td style="border: 0px; text-align: center;">Penerima</th>
      </tr>
    </thead>
    <tbody style="text-align: center;">
      <tr>
        <td style="border: 0px; padding-top:6%">{{ $data->dari }}</td>
        <td style="border: 0px; padding-top:6%"> {{ $data->penerima }} </td>
      </tr>
    </tbody>
  </table>
</div>
