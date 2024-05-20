@slot('title', 'Daftar Ulang')

@push('extraCSS')
    {{-- empty --}}
@endpush

@slot('titleBreadcrumb', 'PPDB')

<div class="">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    {{-- notif --}}
                    <?php
                    $role = auth()
                        ->user()
                        ->roles->first()->name;
                    ?>

                    @if ($role == 'siswa' && $pendaftar->lolos_wawancara === 1)
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong><i class="mr-2 mdi mdi-check-all"></i>
                                Selamat</strong>
                            <p>Silahkan lanjut ke tahap pengisian biodata</p>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    <h4 class="mb-4 card-title">Tabel Daftar Ulang Siswa</h4>
                    <!-- Nav tabs -->
                    <ul class="nav nav-pills nav-justified border rounded" role="tablist">
                        <li class="nav-item waves-effect waves-light">
                            <a class="nav-link active bg-success text-white" data-toggle="tab" href="#executive"
                                role="tab">
                                <span class="d-block d-sm-none">Exe</span>
                                <span class="d-none d-sm-block">Executive</span>
                            </a>
                        </li>
                        <li class="nav-item waves-effect waves-light">
                            <a class="nav-link bg-danger text-white" data-toggle="tab" href="#reguler-ac" role="tab">
                                <span class="d-block d-sm-none">AC</span>
                                <span class="d-none d-sm-block">Reguler AC</span>
                            </a>
                        </li>
                        <li class="nav-item waves-effect waves-light">
                            <a class="nav-link bg-primary text-white" data-toggle="tab" href="#reguler-non-ac"
                                role="tab">
                                <span class="d-block d-sm-none">Non AC</span>
                                <span class="d-none d-sm-block">Reguler Non AC</span>
                            </a>
                        </li>
                    </ul>
                    <!-- Tab panes -->
                    <div class="tab-content pt-4 text-muted">
                        <div class="tab-pane active" id="executive" role="tabpanel">
                            <div class="d-flex justify-center">
                                <h4
                                    class="mb-4 card-title text-center text-uppercase text-success font-weight-bold col-4">
                                    Kelas
                                    Executive</h4>
                            </div>
                            <hr class="mt-n1">
                            @livewire('tables.daftar-ulang-table', ['kelas_id' => 1])
                        </div>
                        <div class="tab-pane" id="reguler-ac" role="tabpanel">
                            <div class="d-flex justify-center">
                                <h4
                                    class="mb-4 card-title text-center text-uppercase text-danger font-weight-bold col-12">
                                    Kelas
                                    Reguler AC</h4>
                            </div>
                            <hr class="mt-n1">
                            @livewire('tables.daftar-ulang-table', ['kelas_id' => 2])
                        </div>
                        <div class="tab-pane" id="reguler-non-ac" role="tabpanel">
                            <div class="d-flex justify-content-end">
                                <h4
                                    class="mb-4 card-title text-center text-uppercase text-primary font-weight-bold col-4">
                                    Kelas
                                    Reguler Non AC</h4>
                            </div>
                            <hr class="mt-n1">
                            @livewire('tables.daftar-ulang-table', ['kelas_id' => 3])
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')

@endpush
