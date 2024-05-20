<x-livewire-tables::bs4.table.cell>
    {{ $row->no_pendaftaran }}
</x-livewire-tables::bs4.table.cell>
<x-livewire-tables::bs4.table.cell>
    {{ $row->name }}
</x-livewire-tables::bs4.table.cell>
<x-livewire-tables::bs4.table.cell>
    {{ $row->username }}
</x-livewire-tables::bs4.table.cell>
<x-livewire-tables::bs4.table.cell>
    {{ $row->created_at->isoFormat('D-MM-YYYY') }}
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
    @if ($row->status_pengisian_biodata == 0)
        <span class="badge badge-danger badge-pill" style="font-size: 12px">Belum Di Isi</span>
    @else
        <span class="badge badge-success badge-pill" style="font-size: 12px">Sudah Di Isi</span>
    @endif
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell>
    @if ($row->lolos_verifikasi === 0)
        <span class="badge badge-danger badge-pill" style="font-size: 12px">Tidak Lolos</span>
    @elseif ($row->lolos_verifikasi === 1)
        <span class="badge badge-success badge-pill" style="font-size: 12px">Lolos</span>
    @else
        <span class="badge badge-danger badge-pill" style="font-size: 12px">-</span>
    @endif
</x-livewire-tables::bs4.table.cell>

<?php
$role = auth()
    ->user()
    ->roles->first()->name;
?>

@if ($role !== 'siswa')
    <x-livewire-tables::bs4.table.cell>
        @if ($row->biodata && $row->lolos_verifikasi === 1)
            <a href="{{ url('download-biodata-siswa', $row->id) }}" target="_blank">
                <button class="btn btn-info btn-sm">
                    Unduh
                </button>
            </a>
        @elseif($row->lolos_verifikasi == false)
            <button class="btn btn-secondary btn-sm">
                Tidak Tersedia
            </button>
        @else
            <button class="btn btn-secondary btn-sm">
                Belum Tersedia
            </button>
        @endif
    </x-livewire-tables::bs4.table.cell>
@endif

<x-livewire-tables::bs4.table.cell>
    @if ($row->biodata)
        <a href="{{ url('biodata', $row->id) }}">
            <button class="btn btn-info btn-sm">
                Detail
            </button>
        </a>
    @else
        <a href="{{ url('biodata', $row->id) }}">
            <button class="btn btn-info btn-sm">
                Isi form
            </button>
        </a>
    @endif
</x-livewire-tables::bs4.table.cell>
