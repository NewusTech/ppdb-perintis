@slot('title', 'Setting Biaya')

@push('extraCSS')

@endpush

@slot('titleBreadcrumb', 'PPDB')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3 border-right">
                        <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist"
                            aria-orientation="vertical">
                            <a class="nav-link active" id="executive-tab" data-toggle="pill" href="#executive" role="tab"
                                aria-controls="executive" aria-selected="true">Executive</a>
                            <a class="nav-link" id="reguler-ac-tab" data-toggle="pill" href="#reguler-ac"
                                role="tab" aria-controls="reguler-ac" aria-selected="false">Reguler AC</a>
                            <a class="nav-link" id="reguler-non-ac-tab" data-toggle="pill" href="#reguler-non-ac"
                                role="tab" aria-controls="reguler-non-ac" aria-selected="false">Reguler Non AC</a>
                            <a class="nav-link" id="perlengkapan-tab" data-toggle="pill" href="#perlengkapan"
                                role="tab" aria-controls="perlengkapan" aria-selected="false">Perlengkapan</a>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="tab-content text-muted mt-4 mt-md-0" id="v-pills-tabContent">
                            <div class="tab-pane fade show active" id="executive" role="tabpanel"
                                aria-labelledby="executive-tab">
                                @livewire('components.form-biaya-executive', ['kelas_id' => 1])
                            </div>
                            <div class="tab-pane fade" id="reguler-ac" role="tabpanel"
                                aria-labelledby="reguler-ac-tab">
                                @livewire('components.form-biaya-reguler-a-c', ['kelas_id' => 2])

                            </div>
                            <div class="tab-pane fade" id="reguler-non-ac" role="tabpanel"
                                aria-labelledby="reguler-non-ac-tab">
                                @livewire('components.form-biaya-reguler-non-a-c', ['kelas_id' => 3])
                            </div>
                            <div class="tab-pane fade" id="perlengkapan" role="tabpanel"
                                aria-labelledby="perlengkapan-tab">
                                @livewire('components.form-biaya-perlengkapan')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')

@endpush
