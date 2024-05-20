@slot('title', 'Tata Tertib')

@push('extraCSS')

@endpush

@slot('titleBreadcrumb', 'PPDB')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                @if (session('success'))
                    <div class="col-6 fixed-top mx-auto mt-2">
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong><i class="mr-2 mdi mdi-check-all"></i>
                                {{ session('success') }}</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                @endif

                @if (session('info'))
                    <div class="col-6 fixed-top mx-auto mt-2">
                        <div class="alert alert-info alert-dismissible fade show" role="alert">
                            <strong><i class="mdi mdi-alert-circle-outline mr-2"></i>
                                {{ session('info') }}</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                @endif

                @if (session('error'))
                    <div class="col-6 fixed-top mx-auto mt-2">
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="mr-2 mdi mdi-block-helper"></i>
                            {{ session('error') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                @endif
                <ul class="nav nav-pills nav-justified border rounded" role="tablist">
                    <li class="nav-item waves-effect waves-light">
                        <a class="nav-link active" data-toggle="tab" href="#tatatertib1" role="tab">
                            <span class="d-block d-sm-none">1</span>
                            <span class="d-none d-sm-block">Tata Tertib 1</span>
                        </a>
                    </li>
                    <li class="nav-item waves-effect waves-light">
                        <a class="nav-link" data-toggle="tab" href="#tatatertib2" role="tab">
                            <span class="d-block d-sm-none">2</span>
                            <span class="d-none d-sm-block">Tata Tertib 2</span>
                        </a>
                    </li>
                </ul>
                <!-- Tab panes -->
                <div class="tab-content pt-4 text-muted">
                    <div class="tab-pane active" id="tatatertib1" role="tabpanel">
                        @livewire('components.tata-tertib.tata-tertib1')
                    </div>
                    <div class="tab-pane" id="tatatertib2" role="tabpanel">
                        @livewire('components.tata-tertib.tata-tertib2')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
