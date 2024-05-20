<form wire:submit.prevent="saveBiayaPerlengkapan">
    @if (session('success'))
        <div class="col-6 fixed-top mx-auto mt-2">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong><i class="mr-2 mdi mdi-check-all"></i>
                    {{ session('success') }}</strong>
                <button wire:click="$refresh" type="button" class="close" data-dismiss="alert"
                    aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
    @endif
    @if (session('info'))
        <div class="col-6 fixed-top mx-auto mt-2">
            <div class="alert alert-info alert-dismissible fade show" role="alert">
                <strong><i class="mr-2 mdi mdi-alert-circle-outline"></i>
                    {{ session('info') }}</strong>
                <button wire:click="$refresh" type="button" class="close" data-dismiss="alert"
                    aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
    @endif
    @if (session('error'))
        <div class="col-6 fixed-top mx-auto mt-2">
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong><i class="mr-2 mdi mdi-block-helper"></i>
                    {{ session('error') }}</strong>
                <button wire:click="$refresh" type="button" class="close" data-dismiss="alert"
                    aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
    @endif
    <div class="row">
        <div class="col-12">
            <div class="form-group">
                <label>Kaos Olahraga (Kaos + Training)</label>
                <input type="text" class="form-control" wire:model="kaos_olahraga" placeholder="Nominal">
                @error('kaos_olahraga')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label>Bed, Lokasi, Topi dan Dasi OSIS</label>
                <input type="text" class="form-control" wire:model="bed_lokasi_dll" placeholder="Nominal">
                @error('bed_lokasi_dll')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label>Baju Seragam Sekolah + Dasi</label>
                <input type="text" class="form-control" wire:model="baju_seragam" placeholder="Nominal">
                @error('baju_seragam')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="col-md text-center text-md-right mt-2">
            @if (session('success'))
                <button type="button" class="btn btn-success waves-effect waves-light">
                    <i class="mr-2 ri-check-line align-middle"></i> Berhasil
                </button>
            @elseif(session('info'))
                <button type="button" class="btn btn-info waves-effect waves-light">
                    <i class="mr-2 ri-information-line align-middle"></i> Info
                </button>
            @elseif(session('error'))
                <button type="button" class="btn btn-danger waves-effect waves-light">
                    <i class="mr-2 ri-close-line align-middle"></i> Gagal
                </button>
            @else
                <button wire:click="cancel" class="mr-3 btn btn-secondary" type="button">Batal</button>
                <button class="btn btn-info" type="submit">Simpan</button>
            @endif
        </div>
    </div>
</form>
