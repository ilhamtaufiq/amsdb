<tr>
    <td>{{ $kontrak->kode_rup }}</td>
    <td>{{ $kontrak->kode_paket }}</td>
    <td>{{ $kontrak->pekerjaan->nama_pekerjaan }}</td>
    <td>{{ $kontrak->pelaksana->nama }}</td>
    <td>Rp{{ number_format($kontrak->nilai_kontrak, 0, ',', '.') }}</td>
    <td>{{ $kontrak->tgl_mulai }}</td>
    <td>{{ $kontrak->tgl_selesai }}</td>
    <td>{{ $kontrak->no_sppbj }} - {{ $kontrak->tgl_sppbj }}</td>
    <td>{{ $kontrak->no_spk }} - {{ $kontrak->tgl_spk }}</td>
    <td>{{ $kontrak->no_spmk }} - {{ $kontrak->tgl_spmk }}</td>
    <td>
        <div class="btn-group">
            <a href="{{route('kontrak.edit',$kontrak->id)}}" class="action-btn btn-edit bs-tooltip me-2" data-toggle="tooltip"
                data-placement="top" title="Edit">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="feather feather-edit-2">
                    <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path>
                </svg>
            </a>
            <form action="{{ route('kontrak.destroy', $kontrak->id) }}" method="post">
                @csrf
                @method('delete')
                <a type="submit" class="action-btn btn-edit bs-tooltip me-2 hapus" class="action-btn btn-delete bs-tooltip" data-toggle="tooltip"
                    data-placement="top" title="Delete">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="feather feather-trash-2">
                        <polyline points="3 6 5 6 21 6"></polyline>
                        <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                        <line x1="10" y1="11" x2="10" y2="17"></line>
                        <line x1="14" y1="11" x2="14" y2="17"></line>
                    </svg>
                </a>
            </form>

        </div>
    </td>
</tr>
