<style>
  .tg {
    border: 1px solid;
    font-family: 'arial';
    border: 0px solid;

  }

  .tg td {
    border: 0px solid;
    font-size: {{ $font }}px;


  }


  .tg .tg-0lax {

}

  .center {
    margin-left: auto;
    margin-right: auto;
  }

  table,
  td,
  th {
    border: 1px solid;
    font-family: 'arial';
    font-size: {{ $font }}px;
  }

  table {
    width: 90%;
    border-collapse: collapse;
  }
</style>
<div class="row">
  <div style="text-align:right; width:95%">
    {{-- Cianjur, {{ \Carbon\Carbon::parse($data->tanggal)->isoFormat('D MMMM Y') }} --}}
  </div>
</div>
<h4 style="text-align: center;">LAPORAN KEMAJUAN PELAKSANAAN KEGIATAN <br>
    @if ($kegiatan[0]['sumber_dana'] == "Dana Alokasi Khusus (DAK)")
    DANA ALOKASI KHUSUS (DAK) <br>
    @endif
   TAHUN ANGGARAN 2023
</h4>
<table class="center tg">
  <thead>
    <tr>
      <td class="" style="width:8%">Provinsi</td>
      <td class="" style="width:2%">:</td>
      <td class="">Jawa Barat<br></td>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td class="" style="width:8%">Kabupaten</td>
      <td class="" style="width:2%">:</td>
      <td class="">Cianjur</td>
    </tr>
    <tr>
      <td class="">Triwulan</td>
      <td class="">:</td>
      <td class="">{{ $triwulan }}</td>
    </tr>
    <tr>
      <td class="">SKPD</td>
      <td class="">:</td>
      <td class="">Dinas Perumahan dan Kawasan Permukiman</td>
    </tr>
    <tr>
      <td class="">Bidang</td>
      <td class="">:</td>
      <td class="">
        {{ $kegiatan[0]['bidang'] }}
      </td>
    </tr>
  </tbody>
</table>
<br>
{{-- <h4 style="text-align: center;">TRIWULAN {{ $triwulan }}</h4>
  @if ($keg_id == 6)
      <p style="padding-left: 40;">Bidang: Sanitasi</p>
  @else
      <p style="padding-left: 40;">Bidang: Air Minum</p>
  @endif --}}
<table id="html5-extension" class="center">
  <thead>
    <tr>
      <th rowspan="3">No</th>
      <th rowspan="3">KEGIATAN</th>
      <th colspan="4">PERENCANAAN KEGIATAN</th>
      <th colspan="3">MEKANISME PELAKSANAAN</th>
      <th colspan="4">REALISASI</th>
      <th rowspan="3">Keterangan</th>
    </tr>
    <tr>
      <th rowspan="2">Volume</th>
      <th rowspan="2">Satuan</th>
      <th rowspan="2">Penerima Manfaat</th>
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
    @foreach ($pekerjaan as $index => $item)
      <tr>
        <td>{{ $i++ }}</td>
        <td>
          {{ $item->nama_pekerjaan }} <br>
          <br>
          @empty(!$item->spek)
            @foreach ($item->spek->spek as $s)
              {{ $s['satuan'] }} : {{ $s['volume'] }} <br>
            @endforeach
          @endempty
        </td>
        <td>{{ $item->output }}</td>
        <td>{{ $item->satuan_output }}</td>
        <td>{{ $item->output * 5 }} Jiwa</td>
        <td>Rp{{ number_format($item->pagu, 2, ',', '.') }}</td>
        <td>{{ $item->output }}</td>
        <td>Rp{{ number_format($item->pagu, 2, ',', '.') }}</td>
        <td>Bertahap</td>
        <td>Rp{{ number_format($item->realisasi_output[0]['keuangan'] ?? 0, 2, ',', '.') }}</td>
        <td>
          @php
            $realisasi = $item->realisasi_output->sum('keuangan') ?? 0;
            if ($realisasi != 0) {
                # code...
                $persentase = ($realisasi / $item->pagu) * 1;
            } else {
                # code...
                $persentase = 0;
            }
            echo number_format($persentase * 100, 2, ',', '') . '%';
          @endphp
        </td>
        <td>{{ $item->realisasi_output[0]['fisik'] ?? 0 }}</td>
        <td>
          @php
            $realisasi = $item->realisasi_output->sum('fisik') ?? 0;
            if ($realisasi != 0) {
                # code...
                $persentase = ($realisasi / $item->output) * 1;
            } else {
                # code...
                $persentase = 0;
            }
            echo number_format($persentase * 100, 2, ',', '') . '%';
          @endphp
        </td>
        <td>13</td>
      </tr>
    @endforeach
  </tbody>
</table>

<div class="row" style="margin-top: 0%;">
    <p style="text-align: center; padding-left: 50%;">Cianjur, {{ \Carbon\Carbon::parse($tanggal)->isoFormat('D MMMM Y') }}</p>
    <p style="text-align: center; padding-left: 50%;">Kepala Dinas</p>
    <p style="text-align: center; padding-left: 50%; margin-top: 80"><b><u>CEPI RAHMAT FADIANA, ST., MT</u></b></p>
    <p style="text-align: center; padding-left: 50%; margin-top: -10;">NIP.19700218 199803 1 006</p>

</div>
