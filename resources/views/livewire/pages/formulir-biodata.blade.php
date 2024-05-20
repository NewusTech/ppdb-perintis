@slot('title', 'Formulir Biodata')

@push('styles')
@endpush

@slot('titleBreadcrumb', 'PPDB')

<div class="row">
    <div class="col-12">
        <div class="card">
            <?php
            $role = auth()
                ->user()
                ->roles->first()->name;
            if ($pendaftar->kelas_id === 1) {
                $color = 'success';
            } elseif ($pendaftar->kelas_id == 2) {
                $color = 'danger';
            } else {
                $color = 'primary';
            }
            ?>
            <h4 class="card-title bg-{{ $color }} text-light text-center py-3">Formulir Biodata Siswa Kelas
                {{ $pendaftar->kelas->jenis_kelas }}</h4>
            <div class="card-body">
                {{-- @if ($errors->any())
                    <div class="col-6 fixed-top mx-auto mt-2">
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong><i class="mr-2 mdi mdi-check-all"></i>
                                salah</strong>
                            {{ $errors }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                @endif --}}
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
                <h5 class="text-uppercase text-{{ $color }} text-center">FORMULIR BIODATA PESERTA DIDIK BARU
                    KELAS
                    {{ $pendaftar->kelas->jenis_kelas }}
                </h5>
                <h5 class="text-uppercase text-center">sma perintis 2 bandar lampung</h5>
                <h5 class="text-uppercase text-center">tahun pelajaran 2022/2023</h5>
                <form wire:submit.prevent="save({{ $pendaftar->id }})" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <h6 class="text-uppercase font-weight-bold">a. keterangan pribadi</h6>
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
                                    <input wire:model="pendaftar.user.name" class="form-control" type="text"
                                        placeholder="Nama Lengkap">
                                    @error('pendaftar.user.name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Nama Panggilan <span
                                        class="text-danger">*</span></label>
                                <div class="col-md-9">
                                    <input wire:model="pendaftar.nama_panggilan" class="form-control" type="text"
                                        placeholder="Nama Panggilan">
                                    @error('pendaftar.nama_panggilan')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Jenis Kelamin <span
                                        class="text-danger">*</span></label>
                                <div class="col-md-9">
                                    <select wire:model="pendaftar.jenis_kelamin" class="form-control">
                                        <option hidden>Pilih</option>
                                        <option value="L">Laki-laki</option>
                                        <option value="P">Perempuan</option>
                                    </select>
                                    @error('pendaftar.jenis_kelamin')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Tempat, Tanggal
                                    Lahir <span class="text-danger">*</span></label>
                                <div class="col-md-9 d-flex">
                                    <div class="w-25 mr-2">
                                        <input wire:model="pendaftar.tempat_lahir" class="form-control" type="text"
                                            placeholder="Tempat Lahir">
                                        @error('pendaftar.tempat_lahir')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="w-75">
                                        <input wire:model="pendaftar.tanggal_lahir" class="form-control" type="date">
                                        @error('pendaftar.tanggal_lahir')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">NIK (Nomor Induk
                                    Kependudukan) <span class="text-danger">*</span></label>
                                <div class="col-md-9">
                                    <input wire:model="pendaftar.nik" class="form-control" type="text"
                                        placeholder="NIK (Nomor Induk Kependudukan)">
                                    @error('pendaftar.nik')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Agama <span
                                        class="text-danger">*</span></label>
                                <div class="col-md-9">
                                    <select wire:model="pendaftar.agama" class="form-control">
                                        <option hidden>Pilih</option>
                                        <option value="Islam">Islam</option>
                                        <option value="Protestan">Protestan</option>
                                        <option value="Katolik">Katolik</option>
                                        <option value="Hindu">Hindu</option>
                                        <option value="Buddha">Buddha</option>
                                        <option value="Khonghucu">Khonghucu</option>
                                    </select>
                                    @error('pendaftar.agama')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Kewarganegaraan <span
                                        class="text-danger">*</span></label>
                                <div class="col-md-9">
                                    <input wire:model="pendaftar.kewarganegaraan" class="form-control" type="text"
                                        placeholder="Kewarganegaraan">
                                    @error('pendaftar.kewarganegaraan')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Anak Ke <span
                                        class="text-danger">*</span></label>
                                <div class="col-md-4">
                                    <input wire:model="pendaftar.anak_ke" class="form-control" type="text"
                                        placeholder="Anak Ke">
                                    @error('pendaftar.anak_ke')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <label class="col-md-1 col-form-label">Dari <span
                                        class="text-danger">*</span></label>
                                <div class="col-md-4">
                                    <input wire:model="pendaftar.dari_bersaudara" class="form-control" type="text"
                                        placeholder="Dari">
                                    @error('pendaftar.dari_bersaudara')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Status Dalam
                                    Keluarga <span class="text-danger">*</span></label>
                                <div class="col-md-9">
                                    <select wire:model="pendaftar.status_dalam_keluarga" class="form-control">
                                        <option hidden>Pilih</option>
                                        <option value="Anak Kandung">Anak Kandung</option>
                                        <option value="Anak Angkat">Anak Angkat</option>
                                        <option value="Anak Tiri">Anak Tiri</option>
                                    </select>
                                    @error('pendaftar.status_dalam_keluarga')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Jumlah Saudara Kandung
                                    <span class="text-danger">*</span></label>
                                <div class="col-md-9">
                                    <input wire:model="pendaftar.jumlah_saudara_kandung" class="form-control"
                                        type="text" placeholder="Jumlah Saudara Kandung">
                                    @error('pendaftar.jumlah_saudara_kandung')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Bahasa
                                    Sehari-hari <span class="text-danger">*</span></label>
                                <div class="col-md-9">
                                    <input wire:model="pendaftar.bahasa_sehari_hari" class="form-control" type="text"
                                        placeholder="Bahasa Sehari-Hari">
                                    @error('pendaftar.bahasa_sehari_hari')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Sekolah Asal <span
                                        class="text-danger">*</span></label>
                                <div class="col-md-9">
                                    <input wire:model="pendaftar.asal_sekolah" class="form-control" type="text"
                                        placeholder="Sekolah Asal">
                                    @error('pendaftar.asal_sekolah')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Alamat Sekolah
                                    Asal <span class="text-danger">*</span></label>
                                <div class="col-md-9">
                                    <input wire:model="pendaftar.alamat_asal_sekolah" class="form-control"
                                        type="text" placeholder="Alamat Sekolah Asal">
                                    @error('pendaftar.alamat_asal_sekolah')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">NISN <span
                                        class="text-danger">*</span></label>
                                <div class="col-md-9">
                                    <input wire:model="pendaftar.user.username" class="form-control" type="text"
                                        placeholder="NISN">
                                    @error('pendaftar.user.username')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Nomor Ijazah (jika
                                    sudah ada)</label>
                                <div class="col-md-4">
                                    <input wire:model="pendaftar.no_ijazah" class="form-control" type="text"
                                        placeholder="Nomor Ijazah">
                                    @error('pendaftar.no_ijazah')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <label class="col-md-1 col-form-label">Tahun </label>
                                <div class="col-md-4">
                                    <input wire:model="pendaftar.tahun_ijazah" class="form-control" type="text"
                                        placeholder="Tahun">
                                    @error('pendaftar.tahun_ijazah')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Nomor SKHU (jika sudah
                                    ada)</label>
                                <div class="col-md-4">
                                    <input wire:model="pendaftar.no_skhu" class="form-control" type="text"
                                        placeholder="Nomor SKHU">
                                    @error('pendaftar.no_skhu')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <label class="col-md-1 col-form-label">Tahun </label>
                                <div class="col-md-4">
                                    <input wire:model="pendaftar.tahun_skhu" class="form-control" type="text"
                                        placeholder="Tahun">
                                    @error('pendaftar.tahun_skhu')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <h6 class="text-uppercase font-weight-bold mt-5">b. keterangan tempat tinggal</h6>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Alamat Lengkap <span
                                        class="text-danger">*</span></label>
                                <div class="col-md-9">
                                    <input wire:model="pendaftar.alamat_lengkap" class="form-control" type="text"
                                        placeholder="Alamat Lengkap">
                                    @error('pendaftar.alamat_lengkap')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">No. Telepon /
                                    HP <span class="text-danger">*</span></label>
                                <div class="col-md-9">
                                    <input wire:model="pendaftar.no_hp_siswa" class="form-control" type="text"
                                        placeholder="No. Telepon /  HP">
                                    @error('pendaftar.no_hp_siswa')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Alamat
                                    Tersebut <span class="text-danger">*</span></label>
                                <div class="col-md-9">
                                    <select wire:model="pendaftar.alamat_tersebut" class="form-control">
                                        <option hidden>Pilih</option>
                                        <option value="Rumah Orang Tua">1. Rumah Orang Tua</option>
                                        <optgroup label="2. Rumah Wali">
                                            <option value="Paman">a. Paman</option>
                                            <option value="Kakak">b. Kakak</option>
                                            <option value="Kakek">c. Kakek</option>
                                        </optgroup>
                                        <option value="Asrama/Kost">3. Asrama/Kost</option>
                                    </select>
                                    @error('pendaftar.alamat_tersebut')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <h6 class="text-uppercase font-weight-bold mt-5">C. Keterangan Kesehatan</h6>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Golongan
                                    Darah <span class="text-danger">*</span></label>
                                <div class="col-md-9">
                                    <select wire:model="pendaftar.golongan_darah" class="form-control">
                                        <option hidden>Pilih</option>
                                        <option value="A">1. A</option>
                                        <option value="B">2. B</option>
                                        <option value="AB">3. AB</option>
                                        <option value="O">4. O</option>
                                    </select>
                                    @error('pendaftar.golongan_darah')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Penyakit Yang Pernah
                                    Diderita <span class="text-danger">*</span></label>
                                <div class="col-md-9">
                                    <input wire:model="pendaftar.penyakit_yang_pernah_diderita" class="form-control"
                                        type="text" placeholder="Penyakit Yang Pernah Diderita">
                                    @error('pendaftar.penyakit_yang_pernah_diderita')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Kelainan Jasmani <span
                                        class="text-danger">*</span></label>
                                <div class="col-md-9">
                                    <input wire:model="pendaftar.kelainan_jasmani" class="form-control" type="text"
                                        placeholder="Kelainan Jasmani">
                                    @error('pendaftar.kelainan_jasmani')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Tinggi/Berat Badan
                                    <span class="text-danger">*</span></label>
                                <div class="col-md-9">
                                    <input wire:model="pendaftar.tinggi_berat_badan" class="form-control" type="text"
                                        placeholder="Tinggi/Berat Badan">
                                    @error('pendaftar.tinggi_berat_badan')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>


                            <h6 class="text-uppercase font-weight-bold mt-5">D. Keterangan Orang Tua/Wali</h6>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Nama Ayah <span
                                        class="text-danger">*</span></label>
                                <div class="col-md-9">
                                    <input wire:model="pendaftar.nama_ayah" class="form-control" type="text"
                                        placeholder="Nama Ayah">
                                    @error('pendaftar.nama_ayah')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Pekerjaan Ayah <span
                                        class="text-danger">*</span></label>
                                <div class="col-md-9">
                                    <input wire:model="pendaftar.pekerjaan_ayah" class="form-control" type="text"
                                        placeholder="Pekerjaan Ayah">
                                    @error('pendaftar.pekerjaan_ayah')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Tempat, Tanggal
                                    Lahir <span class="text-danger">*</span></label>
                                <div class="col-md-9 d-flex">
                                    <div class="w-25 mr-2">
                                        <input wire:model="pendaftar.tempat_lahir_ayah" class="form-control"
                                            type="text" placeholder="Tempat Lahir Ayah">
                                        @error('pendaftar.tempat_lahir_ayah')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="w-75">
                                        <input wire:model="pendaftar.tanggal_lahir_ayah" name="tanggal_lahir_ayah"
                                            class="form-control" type="date">
                                        @error('pendaftar.tanggal_lahir_ayah')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Penghasilan Ayah (Per
                                    Bulan) <span class="text-danger">*</span></label>
                                <div class="col-md-9">
                                    <select wire:model="pendaftar.penghasilan_ayah" name="penghasilan_ayah"
                                        class="form-control">
                                        <option hidden>Pilih</option>
                                        <option value="A">A. &lt; 500.000</option>
                                        <option value="B">B. 500.000-2.000.000</option>
                                        <option value="C">C. 2.000.000-4.000.000</option>
                                        <option value="D">D. 4.000.000-6.000.000</option>
                                        <option value="E">E. 6.000.000-8.000.000</option>
                                        <option value="F">F. &gt; 8.000.000</option>
                                    </select>
                                    @error('pendaftar.penghasilan_ayah')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Nama Ibu <span
                                        class="text-danger">*</span></label>
                                <div class="col-md-9">
                                    <input wire:model="pendaftar.nama_ibu" class="form-control" type="text"
                                        placeholder="Nama Ibu">
                                    @error('pendaftar.nama_ibu')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Pekerjaan Ibu <span
                                        class="text-danger">*</span></label>
                                <div class="col-md-9">
                                    <input wire:model="pendaftar.pekerjaan_ibu" class="form-control" type="text"
                                        placeholder="Pekerjaan Ibu">
                                    @error('pendaftar.pekerjaan_ibu')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Tempat, Tanggal
                                    Lahir <span class="text-danger">*</span></label>
                                <div class="col-md-9 d-flex">
                                    <div class="w-25 mr-2">
                                        <input wire:model="pendaftar.tempat_lahir_ibu" class="form-control"
                                            type="text" placeholder="Tempat Lahir Ibu">
                                        @error('pendaftar.tempat_lahir_ibu')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="w-75">
                                        <input wire:model="pendaftar.tanggal_lahir_ibu" class="form-control"
                                            type="date">
                                        @error('pendaftar.tanggal_lahir_ibu')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Penghasilan Ibu (Per
                                    Bulan) <span class="text-danger">*</span></label>
                                <div class="col-md-9">
                                    <select wire:model="pendaftar.penghasilan_ibu" class="form-control">
                                        <option hidden>Pilih</option>
                                        <option value="A">A. &lt; 500.000</option>
                                        <option value="B">B. 500.000-2.000.000</option>
                                        <option value="C">C. 2.000.000-4.000.000</option>
                                        <option value="D">D. 4.000.000-6.000.000</option>
                                        <option value="E">E. 4.000.000-8.000.000</option>
                                        <option value="F">F. &gt; 8.000.000</option>
                                    </select>
                                    @error('pendaftar.penghasilan_ibu')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Alamat Orang
                                    Tua <span class="text-danger">*</span></label>
                                <div class="col-md-9">
                                    <input wire:model="pendaftar.alamat_orang_tua" class="form-control" type="text"
                                        placeholder="Alamat Orang Tua">
                                    @error('pendaftar.alamat_orang_tua')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">No. Telepon /
                                    Hp <span class="text-danger">*</span></label>
                                <div class="col-md-9">
                                    <input wire:model="pendaftar.no_hp_orang_tua" class="form-control" type="text"
                                        placeholder="No. Telepon / Hp">
                                    @error('pendaftar.no_hp_orang_tua')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Nama Wali</label>
                                <div class="col-md-9">
                                    <input wire:model="pendaftar.nama_wali" class="form-control" type="text"
                                        placeholder="Nama Wali">
                                    @error('pendaftar.nama_wali')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Pekerjaan Wali</label>
                                <div class="col-md-9">
                                    <input wire:model="pendaftar.pekerjaan_wali" class="form-control" type="text"
                                        placeholder="Pekerjaan Wali">
                                    @error('pendaftar.pekerjaan_wali')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Tempat, Tanggal
                                    Lahir</label>
                                <div class="col-md-9 d-flex">
                                    <div class="w-25 mr-2">
                                        <input wire:model="pendaftar.tempat_lahir_wali" class="form-control"
                                            type="text" placeholder="Tempat Lahir Wali">
                                        @error('pendaftar.tempat_lahir_wali')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="w-75">
                                        <input wire:model="pendaftar.tanggal_lahir_wali" class="form-control"
                                            type="date">
                                        @error('pendaftar.tanggal_lahir_wali')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Penghasilan Wali (Per
                                    Bulan)</label>
                                <div class="col-md-9">
                                    <select wire:model="pendaftar.penghasilan_wali" class="form-control">
                                        <option hidden>Pilih</option>
                                        <option value="A">A. &lt; 500.000</option>
                                        <option value="B">B. 500.000-2.000.000</option>
                                        <option value="C">C. 2.000.000-4.000.000</option>
                                        <option value="D">D. 4.000.000-6.000.000</option>
                                        <option value="E">E. 4.000.000-8.000.000</option>
                                        <option value="F">F. &gt; 8.000.000</option>
                                    </select>
                                    @error('pendaftar.penghasilan_wali')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Alamat Wali</label>
                                <div class="col-md-9">
                                    <input wire:model="pendaftar.alamat_wali" class="form-control" type="text"
                                        placeholder="Alamat Wali">
                                    @error('pendaftar.alamat_wali')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">No. Telepon /
                                    Hp</label>
                                <div class="col-md-9">
                                    <input wire:model="pendaftar.no_hp_wali" class="form-control" type="text"
                                        placeholder="No. Telepon / Hp">
                                    @error('pendaftar.no_hp_wali')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Status Hubungan
                                    Wali</label>
                                <div class="col-md-9">
                                    <input wire:model="pendaftar.status_hubungan_wali" class="form-control"
                                        type="text" placeholder="Status Hubungan Wali">
                                    @error('pendaftar.status_hubungan_wali')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <h6 class="text-uppercase font-weight-bold mt-5">E. keterangan kegemaran/hobi</h6>
                            <h6 class="text-capitalize font-weight-bold">Kelas khusus dan prestasi menonjol dalam
                                bidang</h6>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Kesenian <span
                                        class="text-danger">*</span></label>
                                <div class="col-md-9">
                                    <input wire:model="pendaftar.kesenian" class="form-control" type="text"
                                        placeholder="Kesenian">
                                    @error('pendaftar.kesenian')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Olah Raga <span
                                        class="text-danger">*</span></label>
                                <div class="col-md-9">
                                    <input wire:model="pendaftar.olahraga" class="form-control" type="text"
                                        placeholder="Olah Raga">
                                    @error('pendaftar.olahraga')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Organisasi <span
                                        class="text-danger">*</span></label>
                                <div class="col-md-9">
                                    <input wire:model="pendaftar.organisasi" class="form-control" type="text"
                                        placeholder="Organisasi">
                                    @error('pendaftar.organisasi')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Lain-lain <span
                                        class="text-danger">*</span></label>
                                <div class="col-md-9">
                                    <input wire:model="pendaftar.lain_lain" class="form-control" type="text"
                                        placeholder="Lain-lain">
                                    @error('pendaftar.lain_lain')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            @if ($role == 'super admin' || $role == 'admin varifikasi')
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Lolos
                                        Verifikasi<span class="text-danger">*</span></label>
                                    <div class="col-md-9">
                                        <select wire:model="lolos_verifikasi" class="form-control">
                                            <option hidden>Pilih</option>
                                            <option value="1">Ya</option>
                                            <option value="0">Tidak</option>
                                        </select>
                                        @error('lolos_verifikasi')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            @endif

                            <hr>
                            <div class="row">
                                <div class="col-md text-center text-sm-center text-md-left mt-2">
                                    <a href="{{ url('biodata') }}">
                                        <button type="button" class="btn btn-secondary">
                                            <i class="ri-arrow-left-line align-middle mr-2"></i>Kembali</button>
                                    </a>
                                </div>
                                <div
                                    class="col-md d-flex flex-column flex-md-row justify-content-center align-items-center mt-2">
                                    @if ($role != 'siswa' && $pendaftar->biodata && $pendaftar->lolos_verifikasi == true)
                                        <a href="{{ url('download-biodata-siswa', $pendaftar->id) }}"
                                            target="_blank">
                                            <button class="mr-md-3 btn btn-info" type="button">Unduh
                                                Biodata</button>
                                        </a>
                                    @endif
                                    @if ($role != 'siswa' && $pendaftar->lolos_verifikasi == true)
                                        <a href="{{ url('cetak-biodata-siswa', $pendaftar->id) }}"
                                            class="mt-2 mt-md-0">
                                            <button class="mr-md-3 btn btn-info" type="button">Generate
                                                Biodata</button>
                                        </a>
                                    @endif
                                </div>

                                <div class="col-md text-center text-md-right mt-2">
                                    @if ($pendaftar->biodata == null && $role == 'siswa')
                                        @if (session('success'))
                                            <button type="button" class="btn btn-success waves-effect waves-light">
                                                <i class="mr-2 align-middle ri-check-line"></i> Berhasil
                                            </button>
                                        @else
                                            <button wire:click="cancel({{ $pendaftar->id }})"
                                                class="mr-3 btn btn-secondary" type="button">Batal</button>
                                            <button class="btn btn-info" type="submit">Simpan</button>
                                        @endif
                                    @elseif($pendaftar->biodata != null && $role == 'siswa' && $pendaftar->lolos_verifikasi == true)
                                        <a href="{{ url('download-biodata-siswa', $pendaftar->id) }}"
                                            target="_blank">
                                            <button class="btn btn-info" type="button">Unduh
                                                Biodata</button>
                                        </a>
                                    @endif

                                    @if ($role == 'super admin' || $role == 'admin verifikasi')
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
</div>

@push('scripts')
@endpush
