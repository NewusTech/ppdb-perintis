@slot('title', 'Laporan')

@push('extraCSS')
    {{-- empty --}}
@endpush

@slot('titleBreadcrumb', 'PPDB')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                @if (session('error'))
                    <div class="col-12 col-lg-6 fixed-top mx-auto mt-2 text-left">
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="mr-2 mdi mdi-block-helper"></i>
                            {{ session('error') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                @endif
                <h4 class="mb-4 card-title">Tabel Daftar Pendaftaran Awal Siswa</h4>
                @livewire('tables.laporan-table')
            </div>
        </div>
    </div>
</div>
@push('scripts')

@endpush
