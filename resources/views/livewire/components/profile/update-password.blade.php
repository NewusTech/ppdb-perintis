<form wire:submit.prevent="saveData">
    @if (session('success'))
        <div class="col-6 fixed-top mx-auto mt-2">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong><i class="mr-2 mdi mdi-check-all"></i>
                    {{ session('success') }}</strong>
                <a href="{{ url('profile') }}">
                    <button type="button" class="close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </a>
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
                <label for="example-text-input" class="col-md-4 col-form-label">Password Saat Ini</label>
                <div class="col-md-8">
                    <input wire:model="password_saat_ini" class="form-control" type="password"
                        placeholder="Password Saat Ini">
                    @error('password_saat_ini')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label for="example-text-input" class="col-md-4 col-form-label">Password Baru</label>
                <div class="col-md-8">
                    <input wire:model="password_baru" class="form-control" type="password"
                        placeholder="Password Baru">
                    @error('password_baru')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label for="example-text-input" class="col-md-4 col-form-label">Konfirmasi Password Baru</label>
                <div class="col-md-8">
                    <input wire:model="konfirmasi_password_baru" class="form-control" type="password"
                        placeholder="Password Baru">
                    @error('konfirmasi_password_baru')
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
