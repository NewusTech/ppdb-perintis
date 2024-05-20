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
    @switch($row->kelas_id )
        @case(1)
            <span class="badge badge-success badge-pill" style="font-size: 12px"> {{ $row->jenis_kelas }}</span>
        @break
        @case(2)
            <span class="badge badge-danger badge-pill" style="font-size: 12px"> {{ $row->jenis_kelas }}</span>
        @break
        @case(3)
            <span class="badge badge-primary badge-pill" style="font-size: 12px"> {{ $row->jenis_kelas }}</span>
        @break
        @default
    @endswitch
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
    @if ($row->jurusan)
        <span class="badge badge-pill"
            style="font-size: 12px; background-color: {{ $color }}; color: white;">{{ $row->jurusan }}</span>
    @else
        <span class="badge badge-danger badge-pill" style="font-size: 12px">-</span>
    @endif
</x-livewire-tables::bs4.table.cell>
<x-livewire-tables::bs4.table.cell>
    @if ($row->status_pengisian_formulir)
        <span class="badge badge-pill badge-success" style="font-size: 12px;">Sudah</span>
    @else
        <span class="badge badge-danger badge-pill" style="font-size: 12px">Belum</span>
    @endif
</x-livewire-tables::bs4.table.cell>
<x-livewire-tables::bs4.table.cell>
    @if ($row->status_wawancara)
        <span class="badge badge-pill badge-success" style="font-size: 12px;">Sudah</span>
    @else
        <span class="badge badge-danger badge-pill" style="font-size: 12px">Belum</span>
    @endif
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
    @if ($row->status_pengisian_biodata)
        <span class="badge badge-pill badge-success" style="font-size: 12px;">Sudah</span>
    @else
        <span class="badge badge-danger badge-pill" style="font-size: 12px">Belum</span>
    @endif
</x-livewire-tables::bs4.table.cell>
