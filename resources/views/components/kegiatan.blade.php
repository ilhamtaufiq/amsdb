<tr>
    <td>Nomor</td>
    <td>{{ $kegiatan->program }}</td>
    <td>{{ $kegiatan->kegiatan }}</td>
    <td>{{ $kegiatan->sub_kegiatan }}</td>
    <td>{{ $kegiatan->tahun_anggaran }}</td>
    <td>
        <div class="btn-group">
            <button type="button" class="btn btn-dark btn-sm">Open</button>
            <button type="button" class="btn btn-dark btn-sm dropdown-toggle dropdown-toggle-split"
                id="dropdownMenuReference1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                data-reference="parent">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="feather feather-chevron-down">
                    <polyline points="6 9 12 15 18 9"></polyline>
                </svg>
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuReference1">
                <a class="dropdown-item" href="#">Action</a>
                <a class="dropdown-item" href="#">Another action</a>
                <a class="dropdown-item" href="#">Something else here</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">Separated link</a>
            </div>
        </div>
    </td>
</tr>
