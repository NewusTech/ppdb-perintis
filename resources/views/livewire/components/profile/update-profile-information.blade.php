<form wire:submit.prevent="saveData">
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
    <div class="row">
        <div class="col-12">
            <div class="form-group row">
                <label for="example-text-input" class="col-md-4 col-form-label">Foto</label>
                <div class="col-md-8">
                    <div class="d-flex justify-content-center">
                        @if ($foto_profil)
                            <img class="rounded-pill" src="{{ $foto_profil->temporaryUrl() }}"
                                style="width: 100px; height:100px">
                        @else
                            <img class="rounded-circle header-profile-user"
                                src="{{ auth()->user()->profile_photo_url }}" alt="{{ auth()->user()->name }}"
                                style="width: 100px; height: 100px;">
                        @endif
                    </div>

                    <input wire:model="foto_profil" class="form-control mt-2" type="file">
                    @error('foto_profil')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label for="example-text-input"
                    class="col-md-4 col-form-label">{{ auth()->user()->roles->first()->name == 'siswa'? 'Nama Lengkap (tidak dapat diubah)': 'Nama Lengkap' }}</label>
                <div class="col-md-8">
                    <input wire:model="nama_lengkap" class="form-control" type="text"
                        {{ auth()->user()->roles->first()->name == 'siswa'? 'disabled': '' }}
                        placeholder="Nama Lengkap">
                    @error('nama_lengkap')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label for="example-text-input"
                    class="col-md-4 col-form-label">{{ auth()->user()->roles->first()->name == 'siswa'? 'NISN/Username (tidak dapat diubah)': 'Username' }}</label>
                <div class="col-md-8">
                    <input wire:model="username" class="form-control" type="text"
                        {{ auth()->user()->roles->first()->name == 'siswa'? 'disabled': '' }} placeholder="Username">
                    @error('username')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="d-flex justify-content-end">
                <button wire:click="cleanForm" class="mr-3 btn btn-secondary" type="button">Batal</button>
                <button class="btn btn-info" type="submit">Simpan</button>
            </div>
        </div>
    </div>
</form>
