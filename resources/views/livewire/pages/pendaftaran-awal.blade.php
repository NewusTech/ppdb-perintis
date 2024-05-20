@slot('title', 'Pendaftaran Awal')

@push('extraCSS')
    {{-- empty --}}
@endpush

@slot('titleBreadcrumb', 'PPDB')

<div class="">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Pendaftaran Awal Siswa</h4>
                    <!-- Nav tabs -->
                    <ul class="nav nav-pills nav-justified border rounded" role="tablist">
                        <li class="nav-item waves-effect waves-light">
                            <a class="nav-link active" data-toggle="tab" href="#home-1" role="tab">
                                <span class="d-block d-sm-none">Siswa Baru</span>
                                <span class="d-none d-sm-block">Siswa Baru</span>
                            </a>
                        </li>
                        <li class="nav-item waves-effect waves-light">
                            <a class="nav-link" data-toggle="tab" href="#profile-1" role="tab">
                                <span class="d-block d-sm-none">Siswa Lama</span>
                                <span class="d-none d-sm-block">Siswa Lama</span>
                            </a>
                        </li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content pt-4 text-muted">
                        <div class="tab-pane active" id="home-1" role="tabpanel">
                            @livewire('components.form-pendaftaran-awal-siswa-baru')
                        </div>
                        <div class="tab-pane" id="profile-1" role="tabpanel">
                            @livewire('components.form-pendaftaran-awal-siswa-lama')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="mb-4 card-title">Tabel Pendaftaran Awal Siswa</h4>
                    @livewire('tables.pendaftaran-awal-table')
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')

@endpush
