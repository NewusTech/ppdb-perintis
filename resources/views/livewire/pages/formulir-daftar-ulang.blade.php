@slot('title', 'Formulir Daftar Ulang')

@push('styles')
{{-- empty --}}
@endpush

@slot('titleBreadcrumb', 'PPDB')

<div class="row" wire:poll.1000ms>
    <div class="col-12">
        <div class="card">
            <?php
            $role = auth()
                ->user()
                ->roles->first()->name;
            if ($pendaftar->kelas->jenis_kelas == 'Executive') {
                $color = 'success';
            } elseif ($pendaftar->kelas->jenis_kelas == 'Regular AC') {
                $color = 'danger';
            } else {
                $color = 'primary';
            }
            ?>
            <h4 class="card-title bg-{{ $color }} text-light text-center py-3">Formulir Daftar Ulang Siswa Kelas
                {{ $pendaftar->kelas->jenis_kelas }}
            </h4>
            <div class="card-body">
                @if (session('success'))
                <div class="col-6 fixed-top mx-auto mt-2">
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong><i class="mr-2 mdi mdi-check-all"></i>
                            {{ session('success') }}</strong>
                        <button wire:click="$refresh" type="button" class="close" data-dismiss="alert" aria-label="Close">
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
                <h5 class="text-uppercase text-{{ $color }} text-center">FORMULIR DAFTAR ULANG PESERTA DIDIK BARU
                    KELAS
                    {{ $pendaftar->kelas->jenis_kelas }}
                </h5>
                <h5 class="text-uppercase text-center">sma perintis 2 bandar lampung</h5>
                <h5 class="text-uppercase text-center">tahun pelajaran 2022/2023</h5>
                <form wire:submit.prevent="save({{ $pendaftar->id }})">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Nama Lengkap</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="nama_lengkap" wire:model="nama_lengkap" placeholder="Nama Lengkap" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">NISN</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="nisn" wire:model="nisn" placeholder="NISN" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Kelas</label>
                                <div class="col-md-4">
                                    <select class="form-control" id="kelas" wire:model="kelas" disabled>
                                        <option hidden>Pilih Kelas</option>
                                        <option value="1">Executive</option>
                                        <option value="2">Regular AC</option>
                                        <option value="3">Regular Non AC</option>
                                    </select>
                                </div>
                                <div class="col-md-5">
                                    <input type="text" class="form-control" wire:model="biaya_pendaftaran" placeholder="Nominal" disabled>
                                    @error('biaya_pendaftaran')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Surat Perjanjian</label>
                                <div class="col-md-9 d-flex justify-content-between">
                                    @if ($pendaftar->lembar_perjanjian)
                                    <a href="{{ url('download-lembar-perjanjian', $pendaftar->id) }}" target="_blank">
                                        <button class="mr-3 btn btn-info" type="button">Unduh
                                            Surat</button>
                                    </a>
                                    @else
                                    <button class="mr-3 btn btn-secondary" type="button">Belum Tersedia</button>
                                    @endif
                                    @if ($role !== 'siswa' && $pendaftar->status_daftar_ulang == true)
                                    <a href="{{ url('cetak-lembar-perjanjian', $pendaftar->id) }}" class="mt-2">
                                        <button class="mr-3 btn btn-info" type="button">Generate
                                            Surat</button>
                                    </a>
                                    @endif
                                </div>
                            </div>

                            <!-- <div class="d-flex justify-content-between align-items-center mb-2 "> -->
                            <h5 class="text-uppercase text-center">RIWAYAT PEMBAYARAN</h5>

                            <!-- </div> -->

                            <table class="table table-striped">
                                <thead>
                                    <tr class="text-center">
                                        <td>
                                            @if($pendaftar->lunas == null)
                                            <button class="btn btn-info btn-sm" type="button" data-toggle="modal" data-target="#modalTambah"><i class="fa fa-plus"></i></button>
                                            @endif
                                        </td>
                                        <td>Tanggal/Tipe</td>
                                        <td>Uang Pangkal</td>
                                        <td>Uang SPP(bulan)</td>
                                        <td>Kaos Olahraga (Kaos + Training)</td>
                                        <td>Bed, Lokasi, Topi dan Dasi OSIS</td>
                                        <td>Baju Seragam Sekolah + Dasi</td>
                                        <td>Total</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $total = 0;
                                    ?>
                                    @foreach($biaya_daftar_ulang_id as $k => $v)
                                    <tr class="text-center">
                                        <td>
                                            <a href="{{ url('download-kwitansi',[ $pendaftar->id, $v['id']]) }}" target="_blank">
                                                <i class="fa fa-download" role="button"></i>
                                            </a>
                                        </td>
                                        <td>{{ $v['date'] }}/{{$v['pilihan_pembayaran']}}</td>
                                        <td>Rp.{{ number_format($v['uang_pangkal'], 0, ',', '.') }},-</td>
                                        <td>Rp.{{ number_format($v['uang_spp'] * 2, 0, ',', '.') }},-</td>
                                        <td>Rp.{{ number_format($v['kaos_olahraga'], 0, ',', '.') }},-</td>
                                        <td>Rp.{{ number_format($v['bed_lokasi_dll'], 0, ',', '.') }},-</td>
                                        <td>Rp.{{ number_format($v['baju_seragam'], 0, ',', '.') }},-</td>
                                        <td>Rp.{{ number_format(($v['uang_pangkal'] + ($v['uang_spp'] * 2) + $v['kaos_olahraga'] + $v['bed_lokasi_dll'] + $v['baju_seragam']), 0, ',', '.') }},-</td>
                                    </tr>
                                    <?php 
                                        $total += ($v['uang_pangkal'] + ($v['uang_spp'] * 2) + $v['kaos_olahraga'] + $v['bed_lokasi_dll'] + $v['baju_seragam']); 
                                    ?>
                                    @endforeach
                                    <tr>
                                        <td colspan="7" class="text-right">
                                            Biaya Pendaftaran
                                        </td>
                                        <td>
                                            Rp.{{ number_format($biaya_pendaftaran, 0, ',', '.') }},-
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="7" class="text-right">
                                            Total
                                        </td>
                                        <td>
                                            Rp.{{ number_format(($biaya_pendaftaran + $total), 0, ',', '.') }},-
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                            @if($pendaftar->lunas == null)
                            <div wire:ignore.self class="modal fade" id="modalTambah" data-backdrop="false" tabindex="-1" role="dialog" aria-labelledby="modalTambahLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="modalTambahLabel">Tambah Pembayaran</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div wire:ignore.self class="modal-body">
                                            @if (session('success_biaya'))
                                            <div class="col-6 fixed-top mx-auto mt-2">
                                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                                    <strong><i class="mr-2 mdi mdi-check-all"></i>
                                                        {{ session('success_biaya') }}</strong>
                                                    <button wire:click="$refresh" type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                            </div>
                                            @endif

                                            @if (session('error_biaya'))
                                            <div class="col-6 fixed-top mx-auto mt-2">
                                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                    <i class="mr-2 mdi mdi-block-helper"></i>
                                                    {{ session('error_biaya') }}
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                            </div>
                                            @endif
                                            <div class="row">
                                                @if ($role !== 'siswa')
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label>Pilih Pembayaran</label>
                                                        <select class="form-control" id="kelas" wire:model="pembayaran_daftar_ulang" wire:change="changeEvent($event.target.value)">
                                                            <option>Pilih Pembayaran</option>
                                                            <option value="Lunas">Lunas</option>
                                                            <option value="Angsuran">Angsuran</option>
                                                        </select>
                                                        @error('pembayaran_daftar_ulang')
                                                        <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                </div>
                                                @endif
                                            </div>
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label>Uang Pangkal</label>
                                                        <input type="text" class="form-control" wire:model="uang_pangkal" placeholder="Nominal">
                                                        @error('uang_pangkal')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Uang SPP Per Bulan</label>
                                                        <input type="text" class="form-control" wire:model="uang_spp" placeholder="Nominal">
                                                        @error('uang_spp')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-6">
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
                                            </div>
                                            <div class="modal-footer">
                                                <button class="mr-3 btn btn-secondary" id="closeModalTambah" type="button" data-dismiss="modal">Batal</button>
                                                <button class="btn btn-info" type="submit">Simpan</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif



                            <!-- 
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Kwitansi</label>
                                <div class="col-md-9 d-flex justify-content-between">
                                    <div class="">
                                        @if ($pendaftar->angsuran === 1)
                                        @if ($pendaftar->kwitansi_angsuran)
                                        <a href="{{ url('download-kwitansi-angsuran', $pendaftar->id) }}" target="_blank">
                                            <button class="mr-3 btn btn-info" type="button">Kwitansi
                                                Angsuran</button>
                                        </a>
                                        @else
                                        <button class="mr-3 btn btn-secondary" type="button">Belum
                                            Tersedia</button>
                                        @endif
                                        @if ($pendaftar->lunas === 1 && $pendaftar->kwitansi_lunas)
                                        <a href="{{ url('download-kwitansi-lunas', $pendaftar->id) }}" target="_blank">
                                            <button class="mr-3 btn btn-info" type="button">Kwitansi
                                                Lunas</button>
                                        </a>
                                        @else
                                        <button class="mr-3 btn btn-secondary" type="button">Belum
                                            Tersedia</button>
                                        @endif
                                        @else
                                        @if ($pendaftar->kwitansi_angsuran)
                                        <a href="{{ url('download-kwitansi-angsuran', $pendaftar->id) }}" target="_blank">
                                            <button class="mr-3 btn btn-info" type="button">Kwitansi
                                                Angsuran</button>
                                        </a>
                                        @endif
                                        @if ($pendaftar->lunas === 1 && $pendaftar->kwitansi_lunas)
                                        <a href="{{ url('download-kwitansi-lunas', $pendaftar->id) }}" target="_blank">
                                            <button class="mr-3 btn btn-info" type="button">Kwitansi
                                                Lunas</button>
                                        </a>
                                        @else
                                        <button class="mr-3 btn btn-secondary" type="button">Belum
                                            Tersedia</button>
                                        @endif
                                        @endif
                                    </div>
                                    @if ($role !== 'siswa' && $pendaftar->lembar_perjanjian == true)
                                    <a href="{{ url('cetak-kwitansi', $pendaftar->id) }}" class="mt-2">
                                        <button class="mr-3 btn btn-info" type="button">Generate
                                            Kwitansi</button>
                                    </a>
                                    @endif
                                </div>
                            </div> -->
                            <hr>
                            <div class="row">
                                <div class="col-sm text-center text-sm-left mt-2">
                                    <a href="{{ url('daftar-ulang') }}">
                                        <button type="button" class="btn btn-secondary">
                                            <i class="ri-arrow-left-line align-middle mr-2"></i>Kembali</button>
                                    </a>
                                </div>
                                <!-- <div class="col-sm text-center text-sm-right mt-2">
                                    @if ($role == 'super admin' || $role == 'admin pendaftaran awal')
                                    @if (session('success'))
                                    <button wire:click="closeAlert" type="button" class="btn btn-success waves-effect waves-light">
                                        <i class="mr-2 align-middle ri-check-line"></i> Berhasil
                                    </button>
                                    @else
                                    <button wire:click="cancel({{ $pendaftar->id }})" class="mr-3 btn btn-secondary" type="button">Batal</button>
                                    <button class="btn btn-info" type="submit">Simpan</button>
                                    @endif
                                    @endif
                                </div> -->
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


@push('scripts')

@endpush