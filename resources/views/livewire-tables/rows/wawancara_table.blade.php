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
    {{ $row->created_at->isoFormat('DD-MM-YYYY') }}
</x-livewire-tables::bs4.table.cell>
<x-livewire-tables::bs4.table.cell>
    @if ($row->status_wawancara === 0)
        <span class="badge badge-danger badge-pill" style="font-size: 12px">Tidak Lolos</span>
    @elseif($row->status_wawancara === 1)
        <span class="badge badge-success badge-pill" style="font-size: 12px">Lolos</span>
    @else
        <span class="badge badge-danger badge-pill" style="font-size: 12px">Belum Wawancara</span>
    @endif
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
    @if ($row->status_wawancara === 1)
        <span class="badge badge-pill"
            style="font-size: 12px; background-color: {{ $color }}; color: white;">{{ $row->jurusan }}</span>
    @else
        <span class="badge badge-danger badge-pill" style="font-size: 12px;">-</span>
    @endif
</x-livewire-tables::bs4.table.cell>
<?php
$role = auth()
    ->user()
    ->roles->first()->name;
?>

@if ($role !== 'siswa')
    <x-livewire-tables::bs4.table.cell>
        @if ($row->pernyataan_siswa_baru !== null && $row->status_wawancara === 1)
            <a href="{{ url('download-surat-pernyataan-siswa-baru', $row->id) }}" target="_blank">
                <button class="btn btn-info btn-sm">
                    Unduh
                </button>
            </a>
        @elseif($row->status_wawancara === 0)
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
    @if ($row->pernyataan_siswa_baru)
        <a href="{{ url('wawancara', $row->id) }}">
            <button class="btn btn-info btn-sm">
                Detail
            </button>
        </a>
    @else
        <a href="{{ url('wawancara', $row->id) }}">
            <button class="btn btn-info btn-sm">
                Isi form
            </button>
        </a>
    @endif
</x-livewire-tables::bs4.table.cell>
