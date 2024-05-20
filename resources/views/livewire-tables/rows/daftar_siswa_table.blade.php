<x-livewire-tables::bs4.table.cell>
    {{ $row->name }}
</x-livewire-tables::bs4.table.cell>
<x-livewire-tables::bs4.table.cell>
    {{ $row->username }}
</x-livewire-tables::bs4.table.cell>
<x-livewire-tables::bs4.table.cell>
    <?php
    if ($row->kelas_id == 1 && $row->jurusan == 'IPA') {
        $color = '#000';
    } elseif ($row->kelas_id == 1 && $row->jurusan == 'IPS') {
        $color = '#8359A3';
    } elseif ($row->kelas_id == 2 && $row->jurusan == 'IPA') {
        $color = '#757575';
    } elseif ($row->kelas_id == 2 && $row->jurusan == 'IPS') {
        $color = '#964b00';
    } elseif ($row->kelas_id == 3 && $row->jurusan == 'IPA') {
        $color = '#FF1493';
    } elseif ($row->kelas_id == 3 && $row->jurusan == 'IPS') {
        $color = '#00FF00';
    }
    ?>
    <span class="badge badge-pill"
        style="font-size: 12px; background-color: {{ $color }}; color: white;">{{ $row->jurusan }}</span>
</x-livewire-tables::bs4.table.cell>
<x-livewire-tables::bs4.table.cell>
    <?php
    if ($row->kelas_id === 1 && $row->lunas === 1) {
        $color = '#FFE900';
        $keterangan = 'Lunas';
        // dd('exe lunas');
    } elseif ($row->kelas_id === 2 && $row->lunas === 1) {
        $color = '#800000';
        $keterangan = 'Lunas';
        // dd('ac lunas');
    } elseif ($row->kelas_id === 2 && $row->angsuran === 1) {
        $color = '#FF5000';
        $keterangan = 'Angsuran';
        // dd('ac lunas');
    } elseif ($row->kelas_id === 3 && $row->lunas === 1) {
        $color = '#H7CEFA';
        $keterangan = 'Lunas';
        // dd('non ac lunas');
    } elseif ($row->kelas_id === 3 && $row->angsuran === 1) {
        $color = '#000080';
        $keterangan = 'Angsuran';
        // dd('non ac lunas');
    }
    ?>
    @if ($row->status_daftar_ulang === 1)
        <span class="badge badge-pill"
            style="font-size: 12px; background-color: {{ $color }}; color: white;">{{ $keterangan }}</span>
    @else
        <span class="badge badge-danger badge-pill" style="font-size: 12px">-</span>
    @endif
</x-livewire-tables::bs4.table.cell>
<x-livewire-tables::bs4.table.cell>
    @if ($row->foto)
        <img class="rounded-circle header-profile-user" src="{{ asset('storage/' . $row->foto) }}"
            alt="{{ $row->name }}">
    @else
        <img class="rounded-circle header-profile-user"
            src="https://ui-avatars.com/api/?name={{ $row->name }}&color=7F9CF5&background=EBF4FF"
            alt="{{ $row->name }}">
    @endif
</x-livewire-tables::bs4.table.cell>
<x-livewire-tables::bs4.table.cell>
    <button type="button" class="btn btn-info btn-sm waves-effect waves-light mr-2" data-toggle="modal"
        data-target="#modalDetail{{ $row->id }}">
        Detail File
    </button>
</x-livewire-tables::bs4.table.cell>

<div wire:ignore.self class="modal fade" id="modalDetail{{ $row->id }}" data-backdrop="static" tabindex="-1"
    role="dialog" aria-labelledby="modalDetailLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalDetailLabel">Detail File {{ $row->name }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="d-flex justify-content-center mb-4">
                    @if ($row->foto === null)
                        <img src="{{ asset('assets/images/3x4.png') }}" style="width: 105px; height:144px">
                    @else
                        <img src="{{ asset('storage/' . $row->foto) }}" style="width: 105px; height:144px">
                    @endif
                </div>
                <div class="d-flex justify-content-between align-items-center">
                    <label class="col-6">Formulir Pendaftaran</label>
                    <div class="">
                        <a href="{{ url('unduh-bukti-pendaftaran-awal', $row->id) }}" target="_blank"
                            class="col-6"><button class="btn btn-info">Unduh</button></a>
                    </div>
                </div>
                <hr>
                <div class="d-flex justify-content-between">
                    <label class="col-6">Surat Pernyataan Siswa Baru</label>
                    <div class="">
                        <a href="{{ url('download-surat-pernyataan-siswa-baru', $row->id) }}" target="_blank"
                            class="col-6"><button class="btn btn-info">Unduh</button></a>
                    </div>
                </div>
                <hr>
                <div class="d-flex justify-content-between">
                    <label class="col-6">Lembar Perjanjian</label>
                    <div class="">
                        <a href="{{ url('download-lembar-perjanjian', $row->id) }}" target="_blank"
                            class="col-6"><button class="btn btn-info">Unduh</button></a>
                    </div>
                </div>
                <hr>
                <div class="d-flex justify-content-between">
                    <label class="col-6">Biodata</label>
                    @if ($row->biodata)
                        <div class="">
                            <a href="{{ url('download-biodata-siswa', $row->id) }}" target="_blank"
                                class="col-6"><button class="btn btn-info">Unduh</button></a>
                        </div>
                    @else
                        <button class="btn btn-secondary">Belum Tersedia</button>
                    @endif
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
