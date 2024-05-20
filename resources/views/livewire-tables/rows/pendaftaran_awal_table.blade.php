<div wire:poll.10s="$refresh">
    @if (session('success_delete'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>
            <i class="mr-2 mdi mdi-check-all"></i>
            {{ session('success_delete') }}
        </strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif

    @if (session('error_delete'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="mr-2 mdi mdi-block-helper"></i>
        {{ session('error_delete') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif
    <x-livewire-tables::bs4.table.cell>
        {{ $row->no_pendaftaran }}
    </x-livewire-tables::bs4.table.cell>
    <x-livewire-tables::bs4.table.cell>
        {{ $row->name }}
    </x-livewire-tables::bs4.table.cell>
    <x-livewire-tables::bs4.table.cell>
        {{ $row->username }}
    </x-livewire-tables::bs4.table.cell>
    <x-livewire-tables::bs4.table.cell>
        @switch($row->kelas_id )
        @case(1)
        <span class="badge badge-success badge-pill" style="font-size: 12px"> {{ $row->jenis_kelas }}</span>
        @break
        @case(2)
        <span class="badge badge-danger badge-pill" style="font-size: 12px"> {{ $row->jenis_kelas }}</span>
        @break
        @case(3)
        <span class="badge badge-primary badge-pill" style="font-size: 12px"> {{ $row->jenis_kelas }}</span>
        @break
        @default
        @endswitch
    </x-livewire-tables::bs4.table.cell>
    <x-livewire-tables::bs4.table.cell>
        {{ $row->created_at->isoFormat('DD-MM-YYYY') }}
    </x-livewire-tables::bs4.table.cell>
    <x-livewire-tables::bs4.table.cell>
        <button wire wire:click="detail({{ $row->id }})" type="button" class="btn btn-primary btn-sm waves-effect waves-light" data-toggle="modal" data-target="#modalDetail">Detail</button>
        <button wire wire:click="edit({{ $row->id }})" type="button" class="btn btn-warning btn-sm waves-effect waves-light" data-toggle="modal" data-target="#modalEdit">Edit</button>
        <button onclick="confirm('Apakah yakin ingin menghapus pendaftaran?') || event.stopImmediatePropagation()" wire:click="delete({{ $row->id }})" type="button" class="btn btn-danger btn-sm waves-effect waves-light">Delete</button>
    </x-livewire-tables::bs4.table.cell>
    <!-- Modal Edit -->
    <div wire:ignore.self class="modal fade" id="modalEdit" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="modalEditLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEditLabel">Edit siswa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form wire:submit.prevent="update">
                    <div wire:ignore.self class="modal-body">
                        @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>
                                <i class="mr-2 mdi mdi-check-all"></i>
                                {{ session('success') }}
                            </strong>
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
                            <label>No Pendaftaran</label>
                            <input type="text" class="form-control bg-light" wire:model="no_pendaftaran" readonly>
                        </div>
                        <div class="form-group">
                            <label>Nama Lengkap</label>
                            <input type="text" class="form-control" wire:model="nama_lengkap" placeholder="Nama Lengkap">
                            @error('nama_lengkap')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>NISN</label>
                            <input type="text" class="form-control" wire:model="nisn" placeholder="NISN">
                            @error('nisn')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="kelas">Kelas</label>
                            <select class="form-control" id="kelas" wire:model="kelas">
                                <option hidden>Pilih Kelas</option>
                                <option value="1">Executive</option>
                                <option value="2">Regular AC</option>
                                <option value="3">Regular Non AC</option>
                            </select>
                            @error('kelas')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="text" class="form-control bg-light" wire:model="token" disabled>
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
                        <button class="mr-3 btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                        <button class="btn btn-info" type="submit">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal Detail -->
    <div wire:ignore.self class="modal fade" id="modalDetail" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="modalDetailLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalDetailLabel">Detail siswa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div wire:ignore.self class="modal-body">
                    <div class="row">
                        <div class="col-md-4">No Pendaftaran</div>
                        <div class="col-md-1">:</div>
                        <div class="col-md-7">{{ $no_pendaftaran }}</div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">Nama Lengkap</div>
                        <div class="col-md-1">:</div>
                        <div class="col-md-7">{{ $nama_lengkap }}</div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">NISN</div>
                        <div class="col-md-1">:</div>
                        <div class="col-md-7">{{ $nisn }}</div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">Kelas</div>
                        <div class="col-md-1">:</div>
                        <div class="col-md-7">
                        @switch($kelas)
                        @case(1)
                        <span class="badge badge-success badge-pill" style="font-size: 12px"> Executive</span>
                        @break
                        @case(2)
                        <span class="badge badge-danger badge-pill" style="font-size: 12px"> Regular AC</span>
                        @break
                        @case(3)
                        <span class="badge badge-primary badge-pill" style="font-size: 12px"> Regular Non AC</span>
                        @break
                        @default
                        @endswitch
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>