<form wire:submit.prevent="create">
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong><i class="mr-2 mdi mdi-check-all"></i>
                {{ session('success.status') }}</strong>
            <table class="">
                <tbody>
                    <tr>
                        <td>No Pendaftaran</td>
                        <td> : {{ session('success.no_pendaftaran') }}</td>
                    </tr>
                    <tr>
                        <td>Nama</td>
                        <td> : {{ session('success.nama') }}</td>
                    </tr>
                    <tr>
                        <td>NISN</td>
                        <td> : {{ session('success.nisn') }}</td>
                    </tr>
                    <tr>
                        <td>Kelas</td>
                        <td> :
                            @switch(session('success.kelas'))
                                @case(1)
                                    Executive
                                @break
                                @case(2)
                                    Regular AC
                                @break
                                @default
                                    Regular Non AC
                            @endswitch
                        </td>
                    </tr>
                    <tr>
                        <td>Password</td>
                        <td> : {{ session('success.password') }}</td>
                    </tr>
                </tbody>
            </table>
            <button wire:click="$refresh" type="button" class="close" data-dismiss="alert" aria-label="Close">
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
    <div class="row">
        <div class="col-12">
            <div class="form-group row">
                <label for="example-text-input" class="col-md-2 col-form-label">Nama</label>
                <div class="col-md-10">
                    <input name="nama" wire:model="nama" class="form-control" type="text" placeholder="Nama" disabled>
                    @error('nama')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label for="example-search-input" class="col-md-2 col-form-label">NISN</label>
                <div class="col-md-10">
                    <input wire:model="nisn" name="nisn" class="form-control" type="text" placeholder="NISN">
                    @error('nisn')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label for="example-search-input" class="col-md-2 col-form-label">Kelas</label>
                <div class="col-md-10">
                    <select wire:model="kelas" name="kelas" class="form-control">
                        <option hidden>Pilih Kelas</option>
                        <option value="1">Executive</option>
                        <option value="2">Regular AC</option>
                        <option value="3">Regular Non AC</option>
                    </select>
                    @error('kelas')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="d-flex justify-content-end">
                @if (session('success'))
                    <button type="button" class="btn btn-success waves-effect waves-light">
                        <i class="mr-2 align-middle ri-check-line"></i> Berhasil
                    </button>
                @else
                    <button wire:click="cancel" class="mr-3 btn btn-secondary" type="button">Batal</button>
                    <button class="btn btn-info" type="submit">Simpan</button>
                @endif
            </div>
        </div>
    </div>
</form>
