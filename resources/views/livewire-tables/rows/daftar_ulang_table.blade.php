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
    @if ($row->status_daftar_ulang == 1)
        <span class="badge badge-success badge-pill" style="font-size: 12px">Sudah Daftar Ulang</span>
    @else
        <span class="badge badge-danger badge-pill" style="font-size: 12px">Belum Daftar Ulang</span>
    @endif
</x-livewire-tables::bs4.table.cell>
<x-livewire-tables::bs4.table.cell>
    <?php
    if ($row->lunas == null && $row->angsuran == null) {
        $color = '#800000';
        $keterangan = '-';
    } 
    if ($row->lunas == 1 && $row->angsuran == NULL) {
        $color = '#FFE900';
        $keterangan = 'Lunas';
        // dd('exe lunas');
    } 
    if ($row->lunas == null && $row->angsuran == 1) {
        $color = '#FF5000';
        $keterangan = 'Angsuran';
        // dd('ac lunas');
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
    <a href="{{ url('daftar-ulang', $row->id) }}">
        <button class="btn btn-info btn-sm">
            Detail
        </button>
    </a>
</x-livewire-tables::bs4.table.cell>
