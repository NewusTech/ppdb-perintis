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
    @if ($row->status_pengisian_formulir == null)
        <span class="badge badge-danger badge-pill" style="font-size: 12px">Belum Di Isi</span>
    @else
        <span class="badge badge-success badge-pill" style="font-size: 12px">Sudah Di Isi</span>
    @endif
</x-livewire-tables::bs4.table.cell>
<x-livewire-tables::bs4.table.cell>
    @if ($row->formulir_pendaftaran)
        <a href="{{ url('unduh-bukti-pendaftaran-awal', $row->id) }}" target="_blank">
            <button class="btn btn-info btn-sm">
                Unduh
            </button>
        </a>
    @else
        <button class="btn btn-secondary btn-sm">
            Belum Tersedia
        </button>
    @endif
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell>
    @if ($row->formulir_pendaftaran)
        <a href="{{ url('formulir-pendaftaran', $row->id) }}">
            <button class="btn btn-info btn-sm">
                Detail
            </button>
        </a>
    @else
        <a href="{{ url('formulir-pendaftaran', $row->id) }}">
            <button class="btn btn-info btn-sm">
                Isi form
            </button>
        </a>
    @endif
</x-livewire-tables::bs4.table.cell>
