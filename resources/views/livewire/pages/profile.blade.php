@slot('title', 'Profile')

@push('extraCSS')
    {{-- empty --}}
@endpush

@slot('titleBreadcrumb', 'PPDB')

<div class="">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Ubah Profile</h4>
                    @livewire('components.profile.update-profile-information')

                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Ubah Password</h4>
                    @livewire('components.profile.update-password')
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Keluar Dari Browser Lain</h4>
                    @livewire('components.profile.logout-other-browser-session')
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')

@endpush
