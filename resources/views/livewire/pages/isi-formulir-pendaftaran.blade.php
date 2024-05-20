@slot('title', 'Isi Formulir Pendaftaran')

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
            <h4 class="card-title bg-{{ $color }} text-light text-center py-3">Formulir Pendaftaran Awal Siswa
                Kelas
                {{ $kelas }}</h4>
            <div class="card-body">
                @if (session('success'))
                    <div class="col-6 fixed-top mx-auto mt-2">
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong><i class="mr-2 mdi mdi-check-all"></i>
                                {{ session('success') }}</strong>
                            <button wire:click="cancel({{ $pendaftar->id }})" type="button" class="close"
                                data-dismiss="alert" aria-label="Close">
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
                <h5 class="text-uppercase text-{{ $color }} text-center">FORMULIR PENDAFTARAN PESERTA DIDK BARU
                    {{ $kelas }}</h5>
                <h5 class="text-uppercase text-center">sma perintis 2 bandar lampung</h5>
                <h5 class="text-uppercase text-center">tahun pelajaran 2022/2023</h5>
                <h4 class="card-title"><strong>A.Identitas Siswa</strong></h4>
                <form wire:submit.prevent="save({{ $pendaftar->id }})">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Nama</label>
                                <div class="col-md-9">
                                    <input wire:model="nama_lengkap" class="form-control" type="text"
                                        placeholder="Nama Lengkap">
                                    @error('nama_lengkap')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Tempat, Tanggal
                                    Lahir</label>
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
                                <label class="col-md-3 col-form-label">Alamat</label>
                                <div class="col-md-9">
                                    <input wire:model="alamat_lengkap" class="form-control" type="text"
                                        placeholder="Alamat Lengkap">
                                    @error('alamat_lengkap')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Jenis Kelamin</label>
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
                                <label class="col-md-3 col-form-label">Agama</label>
                                <div class="col-md-9">
                                    <select wire:model="agama" class="form-control">
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
                                <label class="col-md-3 col-form-label">No. Hp Siswa (*wajib
                                    yang aktif)</label>
                                <div class="col-md-9">
                                    <input wire:model="no_hp_siswa" class="form-control" type="text"
                                        placeholder="No. Hp Siswa">
                                    @error('no_hp_siswa')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">NISN</label>
                                <div class="col-md-9">
                                    <input wire:model="nisn" class="form-control bg-light" type="text"
                                        placeholder="NISN" readonly>
                                    @error('nisn')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Asal Sekolah</label>
                                <div class="col-md-9">
                                    <input wire:model="asal_sekolah" class="form-control" type="text"
                                        placeholder="Asal Sekolah">
                                    @error('asal_sekolah')
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
                            <hr>
                            <div class="row">
                                <div class="col-md text-center text-sm-center text-md-left mt-2">
                                    <a href="{{ url('formulir-pendaftaran') }}">
                                        <button type="button" class="btn btn-secondary">
                                            <i class="ri-arrow-left-line align-middle mr-2"></i>Kembali</button>
                                    </a>
                                </div>
                                <div
                                    class="col-md d-flex flex-column flex-md-row justify-content-center align-items-center mt-2">
                                    @if ($role != 'siswa' && $pendaftar->formulir_pendaftaran)
                                        <a href="{{ url('unduh-bukti-pendaftaran-awal', $pendaftar->id) }}"
                                            target="_blank">
                                            <button class="mr-md-3 btn btn-info" type="button">Unduh
                                                Formulir</button>
                                        </a>
                                    @endif
                                    @if ($role != 'siswa' && $pendaftar->status_pengisian_formulir == true)
                                        <a href="{{ url('cetak-bukti-pendaftaran-awal-dan-informasi-daftar-ulang', $pendaftar->id) }}"
                                            class="mt-2 mt-md-0">
                                            <button class="mr-md-3 btn btn-info" type="button">Generate
                                                Formulir</button>
                                        </a>
                                    @endif
                                </div>
                                <div class="col-md text-center text-md-right mt-2">
                                    @if ($pendaftar->formulir_pendaftaran == null && $role == 'siswa')
                                        @if (session('success'))
                                            <button type="button" class="btn btn-success waves-effect waves-light">
                                                <i class="mr-2 align-middle ri-check-line"></i> Berhasil
                                            </button>
                                        @else
                                            <button wire:click="cancel({{ $pendaftar->id }})"
                                                class="mr-3 btn btn-secondary" type="button">Batal</button>
                                            <button class="btn btn-info" type="submit">Simpan</button>
                                        @endif
                                    @elseif($pendaftar->formulir_pendaftaran != null && $role == 'siswa')
                                        <a href="{{ url('unduh-bukti-pendaftaran-awal', $pendaftar->id) }}"
                                            target="_blank">
                                            <button class="btn btn-info" type="button">Unduh
                                                Formulir</button>
                                        </a>
                                    @endif
                                    @if ($role != 'siswa' && $role != 'pimpinan')
                                        @if (session('success'))
                                            <button type="button" class="btn btn-success waves-effect waves-light">
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
