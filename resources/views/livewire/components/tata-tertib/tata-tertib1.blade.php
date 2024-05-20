<div>
    <div class="row">
        <div class="col-12">
            <form wire:submit.prevent="save">
                <div class="row">
                    <div class="col-12">
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label">Tata Tertib Sekolah</label>
                            <div class="col-md-8">
                                <input wire:model="tata_tertib_sekolah" class="form-control" type="file">
                                @error('tata_tertib_sekolah')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="d-flex justify-content-between">
                            <a href="{{ url('download-tata-tertib-sekolah') }}" target="_blank">
                                <button type="button" class="btn btn-info">Lihat</button>
                            </a>
                            <div class="">
                                <button wire:click="cancel" class="mr-3 btn btn-secondary" type="button">Batal</button>
                                <button class="btn btn-info" type="submit">Simpan</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <hr>
        </div>
    </div>
    <embed src="{{ asset('storage/' . $tata_tertib->path) }}" class="w-100 mt-3" height="768px" />
</div>
