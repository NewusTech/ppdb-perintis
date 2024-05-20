@slot('title', 'Daftar Admin')

@push('extraCSS')
    {{-- empty --}}
@endpush

@slot('titleBreadcrumb', 'PPDB')

<div class="">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-4 ">
                        <h4 class="card-title">Tabel Daftar Admin</h4>
                        <button type="button" class="btn btn-info btn-sm waves-effect waves-light" data-toggle="modal"
                            data-target="#modalAdd">Tambah</button>
                        <!--- Modal tambah admin -->
                        <div wire:ignore.self class="modal fade" id="modalAdd" data-backdrop="static" tabindex="-1"
                            role="dialog" aria-labelledby="modalAddLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalAddLabel">Tambah Admin</h5>
                                        <button type="button" class="close" data-dismiss="modal"
                                            aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>

                                    <form wire:submit.prevent="save">
                                        <div class="modal-body">
                                            @if (session('success'))
                                                <div class="alert alert-success alert-dismissible fade show"
                                                    role="alert">
                                                    <strong>
                                                        <i class="mr-2 mdi mdi-check-all"></i>
                                                        Berhasil
                                                    </strong>
                                                    {{ session('success') }}
                                                    <button wire:click="cleanForm" type="button" class="close"
                                                        data-dismiss="alert" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                            @endif

                                            @if (session('error'))
                                                <div class="alert alert-danger alert-dismissible fade show"
                                                    role="alert">
                                                    <i class="mr-2 mdi mdi-block-helper"></i>
                                                    {{ session('error') }}
                                                    <button type="button" class="close" data-dismiss="alert"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                            @endif
                                            <div class="form-group">
                                                <label>Nama Lengkap</label>
                                                <input type="text" class="form-control" wire:model="nama_lengkap"
                                                    placeholder="Nama Lengkap">
                                                @error('nama_lengkap')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label>Username</label>
                                                <input type="text" class="form-control" wire:model="username"
                                                    placeholder="Username">
                                                @error('username')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label>Role</label>
                                                <select class="form-control" wire:model="role">
                                                    <option hidden>Pilih Role</option>
                                                    <option value="pimpinan">Pimpinan</option>
                                                    <option value="admin pendaftaran awal">Admin Pendaftaran Awal
                                                    </option>
                                                    <option value="admin wawancara">Admin Wawancara</option>
                                                    <option value="admin daftar ulang">Admin Daftar Ulang</option>
                                                    <option value="admin verifikasi">Admin Verifikasi</option>
                                                </select>
                                                @error('kelas')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button wire:click="cleanForm" type="button"
                                                class="btn btn-light waves-effect" data-dismiss="modal">Tutup</button>
                                            <button type="submit"
                                                class="btn btn-primary waves-effect waves-light">Tambah</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>
                    @livewire('tables.daftar-admin-table')
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script>
        // window.addEventListener('closeAddModal', e => {
        //     $("#modalAdd").modal('hide');
        //     $('.modal-backdrop').remove();
        // });
        window.addEventListener('closeDeleteModal', e => {
            $("#modalDelete").modal('hide');
            $('.modal-backdrop').remove();
        });
    </script>
@endpush
