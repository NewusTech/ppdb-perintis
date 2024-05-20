@slot('title', 'Formulir Wawancara')

@push('styles')
    {{-- empty --}}
@endpush

@slot('titleBreadcrumb', 'PPDB')

<div class="row">
    <div class="col-12">
        <div class="card">
            <?php
            $role = auth()
                ->user()
                ->roles->first()->name;
            if ($kelas == 'Executive') {
                $color = 'success';
            } elseif ($kelas == 'Regular AC') {
                $color = 'danger';
            } else {
                $color = 'primary';
            }
            ?>
            <h4 class="card-title bg-{{ $color }} text-light text-center py-3">Formulir Wawancara Siswa Kelas
                {{ $kelas }}</h4>
            <div class="card-body">
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
                <h5 class="text-uppercase text-{{ $color }} text-center">FORMULIR WAWANCARA PESERTA DIDK BARU
                    {{ $kelas }}</h5>
                <h5 class="text-uppercase text-center">sma perintis 2 bandar lampung</h5>
                <h5 class="text-uppercase text-center">tahun pelajaran 2022/2023</h5>
                <h4 class="card-title"><strong>A.Identitas Siswa</strong></h4>
                <form wire:submit.prevent="save({{ $pendaftar->id }})">
                    <div class="row">
                        <div class="col-12">
                            <div class="d-flex justify-content-center">
                                @if ($pendaftar->foto === null)
                                    <img src="{{ asset('assets/images/3x4.png') }}"
                                        style="width: 105px; height:144px">
                                @else
                                    @if ($foto === null)
                                        <img src="{{ asset('storage/' . $pendaftar->foto) }}"
                                            style="width: 105px; height:144px">
                                    @else
                                        <img class="" src="{{ $foto->temporaryUrl() }}"
                                            style="width: 105px; height:144px">
                                    @endif
                                @endif
                            </div>
                            <div class="form-group row mt-3">
                                <label class="col-md-3 col-form-label">Foto 3x4 Berwarna</label>
                                <div class="col-md-9">
                                    <div class="d-flex">
                                        <input wire:model="foto" class="form-control" type="file">
                                        @if ($foto)
                                            <button wire:click="deleteFoto" type="button"
                                                class="btn btn-info ml-2">Batal</button>
                                        @endif
                                    </div>
                                    @error('foto')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Nama Lengkap <span
                                        class="text-danger">*</span></label>
                                <div class="col-md-9">
                                    <input wire:model="nama_lengkap" class="form-control" type="text"
                                        placeholder="Nama Lengkap">
                                    @error('nama_lengkap')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Jenis Kelamin <span
                                        class="text-danger">*</span></label>
                                <div class="col-md-9">
                                    <select wire:model="jenis_kelamin" class="form-control">
                                        <option hidden>Pilih</option>
                                        <option value="L">Laki-laki</option>
                                        <option value="P">Perempuan</option>
                                    </select>
                                    @error('jenis_kelamin')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Tempat, Tanggal
                                    Lahir <span class="text-danger">*</span></label>
                                <div class="col-md-9 d-flex">
                                    <div class="w-25 mr-2">
                                        <input wire:model="tempat_lahir" class="form-control" type="text"
                                            placeholder="Tempat">
                                        @error('tempat_lahir')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="w-75">
                                        <input wire:model="tanggal_lahir" class="form-control" type="date">
                                        @error('tanggal_lahir')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Agama <span class="text-danger">*</span></label>
                                <div class="col-md-9">
                                    <select wire:model="agama" name="agama" class="form-control">
                                        <option hidden>Pilih</option>
                                        <option value="Islam">Islam</option>
                                        <option value="Protestan">Protestan</option>
                                        <option value="Katolik">Katolik</option>
                                        <option value="Hindu">Hindu</option>
                                        <option value="Buddha">Buddha</option>
                                        <option value="Khonghucu">Khonghucu</option>
                                    </select>
                                    @error('agama')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Nama Ayah <span
                                        class="text-danger">*</span></label>
                                <div class="col-md-9">
                                    <input wire:model="nama_ayah" class="form-control" type="text"
                                        placeholder="Nama Ayah">
                                    @error('nama_ayah')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Pekerjaan Ayah <span
                                        class="text-danger">*</span></label>
                                <div class="col-md-9">
                                    <input wire:model="pekerjaan_ayah" class="form-control" type="text"
                                        placeholder="Pekerjaan Ayah">
                                    @error('pekerjaan_ayah')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Nama Ibu <span
                                        class="text-danger">*</span></label>
                                <div class="col-md-9">
                                    <input wire:model="nama_ibu" class="form-control" type="text"
                                        placeholder="Nama Ibu">
                                    @error('nama_ibu')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Pekerjaan Ibu <span
                                        class="text-danger">*</span></label>
                                <div class="col-md-9">
                                    <input wire:model="pekerjaan_ibu" class="form-control" type="text"
                                        placeholder="Pekerjaan Ibu">
                                    @error('pekerjaan_ibu')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">No. Hp Orang
                                    Tua <span class="text-danger">*</span></label>
                                <div class="col-md-9">
                                    <input wire:model="no_hp_orang_tua" class="form-control" type="text"
                                        placeholder="No. Hp Orang Tua">
                                    @error('no_hp_orang_tua')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Alamat Orang Tua <span
                                        class="text-danger">*</span></label>
                                <div class="col-md-9">
                                    <input wire:model="alamat_orang_tua" class="form-control" type="text"
                                        placeholder="Alamat Orang Tua">
                                    @error('alamat_orang_tua')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Nama Wali</label>
                                <div class="col-md-9">
                                    <input wire:model="nama_wali" class="form-control" type="text"
                                        placeholder="Nama Wali">
                                    @error('nama_wali')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Pekerjaan Wali</label>
                                <div class="col-md-9">
                                    <input wire:model="pekerjaan_wali" class="form-control" type="text"
                                        placeholder="Pekerjaan Wali">
                                    @error('pekerjaan_wali')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">No. Hp Wali</label>
                                <div class="col-md-9">
                                    <input wire:model="no_hp_wali" class="form-control" type="text"
                                        placeholder="No. Hp Wali">
                                    @error('no_hp_wali')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Agama Wali</label>
                                <div class="col-md-9">
                                    <select wire:model="agama_wali" class="form-control">
                                        <option hidden>Pilih</option>
                                        <option value="Islam">Islam</option>
                                        <option value="Protestan">Protestan</option>
                                        <option value="Katolik">Katolik</option>
                                        <option value="Hindu">Hindu</option>
                                        <option value="Buddha">Buddha</option>
                                        <option value="Khonghucu">Khonghucu</option>
                                    </select>
                                    @error('agama_wali')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Status Hubungan Wali</label>
                                <div class="col-md-9">
                                    <input wire:model="status_hubungan_wali" class="form-control" type="text"
                                        placeholder="Status Hubungan Wali">
                                    @error('status_hubungan_wali')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Alamat Wali</label>
                                <div class="col-md-9">
                                    <input wire:model="alamat_wali" class="form-control" type="text"
                                        placeholder="Alamat Wali">
                                    @error('alamat_wali')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Jurusan <span
                                        class="text-danger">*</span></label>
                                <div class="col-md-9">
                                    <select wire:model="jurusan" class="form-control">
                                        <option hidden>Pilih</option>
                                        <option value="IPA">IPA</option>
                                        <option value="IPS">IPS</option>
                                    </select>
                                    @error('jurusan')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <?php
                            $role = auth()
                                ->user()
                                ->roles->first()->name;
                            ?>
                            @if ($role !== 'siswa' && $role !== 'admin pendaftran awal')
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Catatan <span
                                            class="text-danger">*</span></label>
                                    <div class="col-md-9">
                                        <input wire:model="catatan" class="form-control" type="text"
                                            placeholder="Catatan">
                                        @error('catatan')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Keputusan
                                        Wawancara <span class="text-danger">*</span></label>
                                    <div class="col-md-9">
                                        <select wire:model="status_wawancara" class="form-control">
                                            <option hidden>Pilih</option>
                                            <option value="1">Lolos</option>
                                            <option value="0">Tidak Lolos</option>
                                        </select>
                                        @error('status_wawancara')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            @endif
                            <hr>
                            <div class="row">
                                <div class="col-md text-center text-sm-center text-md-left mt-2">
                                    <a href="{{ url('wawancara') }}">
                                        <button type="button" class="btn btn-secondary">
                                            <i class="ri-arrow-left-line align-middle mr-2"></i>Kembali</button>
                                    </a>
                                </div>
                                <div class="col-md text-center mt-2">
                                    @if ($role != 'siswa' && $pendaftar->pernyataan_siswa_baru && $pendaftar->status_wawancara === 1)
                                        <a href="{{ url('download-surat-pernyataan-siswa-baru', $pendaftar->id) }}"
                                            target="_blank">
                                            <button class="mr-3 btn btn-info" type="button">Unduh
                                                Surat</button>
                                        </a>
                                    @endif
                                    @if ($role != 'siswa' && $pendaftar->status_wawancara === 1)
                                        <a href="{{ url('cetak-surat-pernyataan-siswa-baru', $pendaftar->id) }}"
                                            class="mt-2">
                                            <button class="mr-md-3 btn btn-info" type="button">Generate
                                                Surat</button>
                                        </a>
                                    @endif
                                </div>
                                <div class="col-md text-center text-md-right mt-2">
                                    @if ($pendaftar->status_wawancara === 0 && $role === 'siswa')
                                        <button type="button" class="btn btn-secondary">
                                            Simpan
                                        </button>
                                    @elseif ($pendaftar->pernyataan_siswa_baru === null && $role === 'siswa')
                                        @if (session('success'))
                                            <button type="button" class="btn btn-success waves-effect waves-light">
                                                <i class="mr-2 align-middle ri-check-line"></i> Berhasil
                                            </button>
                                        @else
                                            <button wire:click="cancel({{ $pendaftar->id }})"
                                                class="mr-3 btn btn-secondary" type="button">Batal</button>
                                            <button class="btn btn-info" type="submit">Simpan</button>
                                        @endif
                                        {{-- @elseif($pendaftar->pernyataan_siswa_baru !== null && $role === 'siswa')
                                        <a href="{{ url('download-surat-pernyataan-siswa-baru', $pendaftar->id) }}"
                                            target="_blank">
                                            <button class="btn btn-info" type="button">Unduh
                                                Surat</button>
                                        </a> --}}
                                    @endif
                                    @if ($role == 'super admin' || $role == 'admin wawancara')
                                        @if (session('success'))
                                            <button wire:click="closeAlert" type="button"
                                                class="btn btn-success waves-effect waves-light">
                                                <i class="mr-2 align-middle ri-check-line"></i> Berhasil
                                            </button>
                                        @else
                                            <button wire:click="cancel({{ $pendaftar->id }})"
                                                class="mr-3 btn btn-secondary" type="button">Batal</button>
                                            <button class="btn btn-info" type="submit">Simpan</button>
                                        @endif
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    {{-- empty --}}
@endpush
