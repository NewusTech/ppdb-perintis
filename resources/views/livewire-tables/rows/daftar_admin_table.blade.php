<x-livewire-tables::bs4.table.cell>
    {{ $row->name }}
</x-livewire-tables::bs4.table.cell>
<x-livewire-tables::bs4.table.cell>
    {{ $row->username }}
</x-livewire-tables::bs4.table.cell>
<x-livewire-tables::bs4.table.cell>
    {{ $row->roles->first()->name }}
</x-livewire-tables::bs4.table.cell>
<x-livewire-tables::bs4.table.cell>
    <img class="rounded-circle header-profile-user" src="{{ $row->profile_photo_url }}" alt="{{ $row->name }}">
</x-livewire-tables::bs4.table.cell>
<x-livewire-tables::bs4.table.cell>
    <button wire:click="edit({{ $row->id }})" type="button" class="btn btn-info btn-sm waves-effect waves-light"
        data-toggle="modal" data-target="#modalEdit">
        <i class="ri-edit-line"></i>
    </button>
    <button wire:click="delete({{ $row->id }})" type="button"
        class="btn btn-danger btn-sm waves-effect waves-light mr-2" data-toggle="modal" data-target="#modalDelete">
        <i class="ri-delete-bin-line"></i>
    </button>
</x-livewire-tables::bs4.table.cell>

<!-- Modal Delete -->
<div wire:ignore.self class="modal fade" id="modalDelete" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="modalDeleteLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalDeleteLabel">Hapus Admin</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form wire:submit.prevent="destroy">
                <div class="modal-body">
                    <div class="form-group">
                        Hapus <input type="text" wire:model="nama_lengkap" class="bg-white border-0" disabled>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light waves-effect" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-info waves-effect waves-light">Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit -->
<div wire:ignore.self class="modal fade" id="modalEdit" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="modalEditLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditLabel">Edit siswa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form wire:submit.prevent="update">
                <div class="modal-body">
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>
                                <i class="mr-2 mdi mdi-check-all"></i>
                                Berhasil
                            </strong>
                            {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="mr-2 mdi mdi-block-helper"></i>
                            {{ session('error') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    <div class="form-group">
                        <label>Nama Lengkap</label>
                        <input type="text" class="form-control" wire:model="nama_lengkap" placeholder="Nama Lengkap">
                        @error('nama_lengkap')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" class="form-control" wire:model="username" placeholder="Username">
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
                    <div class="form-group">
                        <label for="resetPassword">Reset Password</label>
                        <select class="form-control" wire:model="password">
                            <option value="0">Tidak</option>
                            <option value="1">Ya</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light waves-effect" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary waves-effect waves-light">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
