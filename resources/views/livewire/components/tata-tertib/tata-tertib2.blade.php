<form wire:submit.prevent="save">
    <div class="row">
        <div class="col-12">
            <label for="example-text-input" class="col-md-4 col-form-label">Tata Tertib</label>
            <div class="form-group row" wire:ignore>
                <div class="col-12">
                    <textarea wire:model="tata_tertib" class="form-control" name="tata_tertib"
                        id="tata_tertib">{{ $tata_tertib }}</textarea>
                </div>
            </div>
            <div class="">
                @error('tata_tertib')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="d-flex justify-content-end">
                <button class="btn btn-info" type="submit">Simpan</button>
            </div>
        </div>
    </div>
</form>
@push('scripts')
    <script src="{{ asset('plugins/ckeditor/build/ckeditor.js') }}"></script>

    <script>
        ClassicEditor
            .create(document.querySelector('#tata_tertib'))
            .then(editor => {
                editor.model.document.on('change:data', () => {
                    @this.set('tata_tertib', editor.getData());
                })
            })
            .catch(error => {
                console.error(error);
            });
    </script>
@endpush
