<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ public_path('css/bootstrap.min.css') }}">
    <title>Biodata - {{ $pendaftar->user->name }}</title>

    <style>
        @page {
            margin: 0.7rem;
        }

        body {
            margin: 0.7rem;
        }

        .rincian {
            border: 1px solid black;
            border-collapse: collapse;
        }

    </style>
</head>

<body
    style="font-size: 11pt; padding: 0.3cm 0.7cm 0.7cm 0.7cm;font-family: serif; border: 10px solid black; border-style: double;">
    <table class="w-100">
        <tbody>
            <tr>
                <td style="border-bottom: 1px solid black; vertical-align: top;">
                    <img src="{{ public_path('assets/images/logo.png') }}" alt="" style="width: 65px; ">
                </td>
                <td class="text-center" style="border-bottom: 1px solid black;">
                    <p class="text-uppercase font-weight-bold" style="font-size: 16px">yayasan pendidikan perintis
                        bandar lampung <br>
                        sma perintis 2 bandar
                        lampung</p>
                    <p style="margin-top: -1rem">Jl. Khairil Anwar no. 106 Durian Payung, telp. (0721)
                        255304</p>
                </td>
                <td rowspan="2" style="vertical-align: top;" class="text-right">
                    @if ($pendaftar->foto)
                        <img src="{{ public_path('storage/' . $pendaftar->foto) }}" alt=""
                            class="border border-dark p-1" style="width: 105px; height: 144px; margin-left:10px">
                    @else
                        <img src="{{ public_path('assets/images/3x4.png') }}" alt=""
                            style="width: 105px; height: 144px; margin-left:10px">
                    @endif
                </td>
            </tr>
            <tr>
                <td></td>
                <td class="text-uppercase text-center">
                    <p style="font-size: 20px;" class="mt-1 font-weight-bold">biodata siswa
                        <br> tahun pelajaran
                        {{ date('Y') . '/' . date('Y') + 1 }}
                    </p>
                </td>
            </tr>
        </tbody>
    </table>

    <p style="font-size: 15px;" class="font-weight-bold text-uppercase">a. keterangan pribadi</p>
    <table class="mt-n3" style="margin-left: 1rem; width: 98%;">
        <tbody>
            <tr>
                <td style="vertical-align:top; width: 1%;">01.&nbsp;</td>
                <td style="vertical-align:top; width: 34%;">Nama Lengkap </td>
                <td style="vertical-align:top; width: 2%;"> : </td>
                <td style="vertical-align:top; " colspan="2">{{ $pendaftar->user->name }}</td>
            </tr>
            <tr>
                <td style="vertical-align:top; ">&nbsp;</td>
                <td style="vertical-align:top; ">Nama Panggilan </td>
                <td style="vertical-align:top; "> : </td>
                <td style="vertical-align:top; " colspan="2">{{ $pendaftar->nama_panggilan }}</td>
            </tr>
            <tr>
                <td style="vertical-align:top; ">02.&nbsp;</td>
                <td style="vertical-align:top; ">Jenis Kelamin </td>
                <td style="vertical-align:top; "> : </td>
                <td style="vertical-align:top; " colspan="2">
                    @if ($pendaftar->jenis_kelamin == 'L')
                        L / <s>P</s>
                    @else
                        <s>L</s> / P
                    @endif
                </td>
            </tr>
            <tr>
                <td style="vertical-align:top; ">03.&nbsp;</td>
                <td style="vertical-align:top; ">Tempat dan Tanggal Lahir </td>
                <td style="vertical-align:top; "> : </td>
                <td style="vertical-align:top; " colspan="2">
                    {{ $pendaftar->tempat_lahir . ', ' . \Carbon\Carbon::parse($pendaftar->tanggal_lahir)->isoFormat('D MMMM Y') }}
                </td>
            </tr>
            <tr>
                <td style="vertical-align:top; ">04.&nbsp;</td>
                <td style="vertical-align:top; ">NIK <span style="font-size: 10pt">(Nomor Induk Kependudukan)</span>
                </td>
                <td style="vertical-align:top; "> : </td>
                <td style="vertical-align:top; " colspan="2">{{ $pendaftar->nik }}</td>
            </tr>
            <tr>
                <td style="vertical-align:top; ">05.&nbsp;</td>
                <td style="vertical-align:top; ">Agama </td>
                <td style="vertical-align:top; "> : </td>
                <td style="vertical-align:top; " colspan="2">{{ $pendaftar->agama }}</td>
            </tr>
            <tr>
                <td style="vertical-align:top; ">06.&nbsp;</td>
                <td style="vertical-align:top; ">Kewarganegaraan </td>
                <td style="vertical-align:top; "> : </td>
                <td style="vertical-align:top; " colspan="2">{{ $pendaftar->kewarganegaraan }}</td>
            </tr>
            <tr>
                <td style="vertical-align:top; ">07.&nbsp;</td>
                <td style="vertical-align:top; ">Anak Ke </td>
                <td style="vertical-align:top; "> : </td>
                <td style="vertical-align:top; ">{{ $pendaftar->anak_ke }}</td>
                <td style="vertical-align:top; "><span>Dari : {{ $pendaftar->dari_bersaudara }}</span></td>
            </tr>
            <tr>
                <td style="vertical-align:top; ">08.&nbsp;</td>
                <td style="vertical-align:top; ">Status Dalam Keluarga </td>
                <td style="vertical-align:top; "> : </td>
                <td style="vertical-align:top; " colspan="2">
                    @if ($pendaftar->status_dalam_keluarga == 'Anak Kandung')
                        Anak Kandung / <s>Anak Angkat</s> / <s>Yatim Piatu</s>
                    @elseif($pendaftar->status_dalam_keluarga == 'Anak Angkat')
                        <s>Anak Kandung</s> / Anak Angkat / <s>Yatim Piatu</s>
                    @else
                        <s>Anak Kandung</s> / <s>Anak Angkat</s> / Yatim Piatu
                    @endif
                </td>
            </tr>
            <tr>
                <td style="vertical-align:top; ">09.&nbsp;</td>
                <td style="vertical-align:top; ">Jumlah Saudara Kandung </td>
                <td style="vertical-align:top; "> : </td>
                <td style="vertical-align:top; " colspan="2">{{ $pendaftar->jumlah_saudara_kandung }}</td>
            </tr>
            <tr>
                <td style="vertical-align:top; ">10.&nbsp;</td>
                <td style="vertical-align:top; ">Bahasa Sehari-hari</td>
                <td style="vertical-align:top; "> : </td>
                <td style="vertical-align:top; " colspan="2">{{ $pendaftar->bahasa_sehari_hari }}</td>
            </tr>
            <tr>
                <td style="vertical-align:top; ">11.&nbsp;</td>
                <td style="vertical-align:top; ">Sekolah Asal</td>
                <td style="vertical-align:top; "> : </td>
                <td style="vertical-align:top; " colspan="2">{{ $pendaftar->asal_sekolah }}</td>
            </tr>
            <tr>
                <td style="vertical-align:top; ">12.&nbsp;</td>
                <td style="vertical-align:top; ">Alamat Sekolah Asal</td>
                <td style="vertical-align:top; "> : </td>
                <td style="vertical-align:top; " colspan="2">{{ $pendaftar->alamat_asal_sekolah }}</td>
            </tr>
            <tr>
                <td style="vertical-align:top; ">13.&nbsp;</td>
                <td style="vertical-align:top; ">NISN</td>
                <td style="vertical-align:top; "> : </td>
                <td style="vertical-align:top; " colspan="2">{{ $pendaftar->user->username }}</td>
            </tr>
            <tr>
                <td style="vertical-align:top; ">14.&nbsp;</td>
                <td style="vertical-align:top; ">Nomor Ijazah (Jika Sudah Ada)</td>
                <td style="vertical-align:top; "> : </td>
                <td style="vertical-align:top; ">{{ $pendaftar->no_ijazah ?? '-' }}</td>
                <td style="vertical-align:top; "><span>Tahun : {{ $pendaftar->tahun_ijazah ?? '-' }}</span></td>
            </tr>
            <tr>
                <td style="vertical-align:top; ">15.&nbsp;</td>
                <td style="vertical-align:top; ">Nomor SKHU (Jika Sudah Ada)</td>
                <td style="vertical-align:top; "> : </td>
                <td style="vertical-align:top; ">{{ $pendaftar->no_skhu ?? '-' }}</td>
                <td style="vertical-align:top; "><span>Tahun : {{ $pendaftar->tahun_skhu ?? '-' }}</span></td>
            </tr>
        </tbody>
    </table>


    <p style="font-size: 15px;" class="mt-3 font-weight-bold text-uppercase">b. keterangan tempat tinggal</p>
    <table class="mt-n3" style="margin-left: 1rem; width: 98%;">
        <tbody>
            <tr>
                <td style="vertical-align:top; width: 1%;">16.&nbsp;</td>
                <td style="vertical-align:top; width: 34%;">Alamat Lengkap </td>
                <td style="vertical-align:top; width: 2%;"> : </td>
                <td style="vertical-align:top; ">{{ $pendaftar->alamat_lengkap }}</td>
            </tr>
            <tr>
                <td style="vertical-align:top; ">17.&nbsp;</td>
                <td style="vertical-align:top; ">No. Telepon / HP </td>
                <td style="vertical-align:top; "> : </td>
                <td style="vertical-align:top; ">{{ $pendaftar->no_hp_siswa }}</td>
            </tr>
            <tr>
                <td style="vertical-align:top; ">18.&nbsp;</td>
                <td style="vertical-align:top; ">Alamat Tersebut </td>
                <td style="vertical-align:top; "> : </td>
                <td style="vertical-align:top; ">
                    @if ($pendaftar->alamat_tersebut == 'Rumah Orang Tua')
                        1. Rumah Orang Tua
                    @else
                        <s>1. Rumah Orang Tua</s>
                    @endif
                </td>
            </tr>
            <tr>
                <td style="vertical-align:top; "></td>
                <td style="vertical-align:top; "></td>
                <td style="vertical-align:top; "></td>
                <td style="vertical-align:top; ">
                    @if ($pendaftar->alamat_tersebut == 'Paman' || $pendaftar->alamat_tersebut == 'Kakak' || $pendaftar->alamat_tersebut == 'Kakek')
                        2. Rumah Wali :
                    @else
                        <s>2. Rumah Wali : </s>
                    @endif
                    &nbsp;&nbsp;
                    @if ($pendaftar->alamat_tersebut == 'Paman')
                        a. Paman
                    @else
                        <s>a. Paman</s>
                    @endif
                    &nbsp;&nbsp;
                    @if ($pendaftar->alamat_tersebut == 'Kakak')
                        b. Kakak
                    @else
                        <s>b. Kakak</s>
                    @endif
                    &nbsp;&nbsp;
                    @if ($pendaftar->alamat_tersebut == 'Kakek')
                        c. Kakek
                    @else
                        <s>c. Kakek</s>
                    @endif
                </td>
            </tr>
            <tr>
                <td style="vertical-align:top; "></td>
                <td style="vertical-align:top; "></td>
                <td style="vertical-align:top; "></td>
                <td style="vertical-align:top; ">
                    @if ($pendaftar->alamat_tersebut == 'Asrama/Kost')
                        3. Asrama / Kost
                    @else
                        <s>3. Asrama / Kost</s>
                    @endif

                </td>
            </tr>
        </tbody>
    </table>

    <p style="font-size: 15px;" class="mt-3 font-weight-bold text-uppercase">C. keterangan kesehatan</p>
    <table class="mt-n3" style="margin-left: 1rem; width: 98%;">
        <tbody>
            <tr>
                <td style="vertical-align:top; width: 1%;">19.&nbsp;</td>
                <td style="vertical-align:top; width: 34%;">Golongan Darah </td>
                <td style="vertical-align:top; width: 2%;"> : </td>
                <td style="vertical-align:top; ">
                    @if ($pendaftar->golongan_darah == 'A')
                        1. A&nbsp;&nbsp;&nbsp;
                    @else
                        <s>1. A</s>&nbsp;&nbsp;&nbsp;
                    @endif
                    @if ($pendaftar->golongan_darah == 'B')
                        2. B&nbsp;&nbsp;&nbsp;
                    @else
                        <s>2. B</s>&nbsp;&nbsp;&nbsp;
                    @endif
                    @if ($pendaftar->golongan_darah == 'AB')
                        3. AB&nbsp;&nbsp;&nbsp;
                    @else
                        <s>3. AB</s>&nbsp;&nbsp;&nbsp;
                    @endif
                    @if ($pendaftar->golongan_darah == 'O')
                        4. O
                    @else
                        <s>4. O</s>
                    @endif
                </td>
            </tr>
            <tr>
                <td style="vertical-align:top; ">20.&nbsp;</td>
                <td style="vertical-align:top; ">Penyakit yang Pernah Diderita </td>
                <td style="vertical-align:top; "> : </td>
                <td style="vertical-align:top; ">{{ $pendaftar->penyakit_yang_pernah_diderita }}</td>
            </tr>
            <tr>
                <td style="vertical-align:top; ">21.&nbsp;</td>
                <td style="vertical-align:top; ">Kelainan Jasmani </td>
                <td style="vertical-align:top; "> : </td>
                <td style="vertical-align:top; ">{{ $pendaftar->kelainan_jasmani }}</td>
            </tr>
            <tr>
                <td style="vertical-align:top; ">22.&nbsp;</td>
                <td style="vertical-align:top; ">Tinggi / Berat Badan </td>
                <td style="vertical-align:top; "> : </td>
                <td style="vertical-align:top; ">{{ $pendaftar->tinggi_berat_badan }}</td>
            </tr>
        </tbody>
    </table>


    <p style="font-size: 15px;" class="mt-3 font-weight-bold text-uppercase">D. keterangan Orang Tua / Wali</p>
    <table class="mt-n3" style="margin-left: 1rem; width: 98%;">
        <tbody>
            <tr>
                <td style="vertical-align:top; width: 1%;">23.&nbsp;</td>
                <td style="vertical-align:top; width: 34%;">Nama Ayah </td>
                <td style="vertical-align:top; width: 2%;"> : </td>
                <td style="vertical-align:top; ">{{ $pendaftar->nama_ayah }}</td>
            </tr>
            <tr>
                <td style="vertical-align:top; ">24.&nbsp;</td>
                <td style="vertical-align:top; ">Pekerjaan Ayah </td>
                <td style="vertical-align:top; "> : </td>
                <td style="vertical-align:top; ">{{ $pendaftar->pekerjaan_ayah }}</td>
            </tr>
            <tr>
                <td style="vertical-align:top; ">25.&nbsp;</td>
                <td style="vertical-align:top; ">Tempat, Tanggal Lahir </td>
                <td style="vertical-align:top; "> : </td>
                <td style="vertical-align:top; ">
                    {{ $pendaftar->tempat_lahir_ayah .', ' .\Carbon\Carbon::parse($pendaftar->tanggal_lahir_ayah)->isoFormat('D MMMM Y') }}
                </td>
            </tr>
            <tr>
                <td style="vertical-align:top; width: 1%;">26.&nbsp;</td>
                <td style="vertical-align:top; width: 34%;">Nama Ibu </td>
                <td style="vertical-align:top; width: 2%;"> : </td>
                <td style="vertical-align:top; ">{{ $pendaftar->nama_ibu }}</td>
            </tr>
            <tr>
                <td style="vertical-align:top; ">27.&nbsp;</td>
                <td style="vertical-align:top; ">Pekerjaan Ibu </td>
                <td style="vertical-align:top; "> : </td>
                <td style="vertical-align:top; ">{{ $pendaftar->pekerjaan_ibu }}</td>
            </tr>
            <tr>
                <td style="vertical-align:top; ">28.&nbsp;</td>
                <td style="vertical-align:top; ">Tempat, Tanggal Lahir </td>
                <td style="vertical-align:top; "> : </td>
                <td style="vertical-align:top; ">
                    {{ $pendaftar->tempat_lahir_ibu .', ' .\Carbon\Carbon::parse($pendaftar->tanggal_lahir_ibu)->isoFormat('D MMMM Y') }}
                </td>
            </tr>
            <tr>
                <td style="vertical-align:top; ">29.&nbsp;</td>
                <td style="vertical-align:top; ">Alamat Orang Tua </td>
                <td style="vertical-align:top; "> : </td>
                <td style="vertical-align:top; ">{{ $pendaftar->alamat_orang_tua }}</td>
            </tr>
            <tr>
                <td style="vertical-align:top; ">30.&nbsp;</td>
                <td style="vertical-align:top; ">No. Telepon / HP </td>
                <td style="vertical-align:top; "> : </td>
                <td style="vertical-align:top; ">{{ $pendaftar->no_hp_orang_tua }}</td>
            </tr>
            <tr>
                <td style="vertical-align:top; width: 1%;">31.&nbsp;</td>
                <td style="vertical-align:top; width: 34%;">Nama Wali </td>
                <td style="vertical-align:top; width: 2%;"> : </td>
                <td style="vertical-align:top; ">{{ $pendaftar->nama_wali ?? '-' }}</td>
            </tr>
            <tr>
                <td style="vertical-align:top; ">32.&nbsp;</td>
                <td style="vertical-align:top; ">Pekerjaan Wali </td>
                <td style="vertical-align:top; "> : </td>
                <td style="vertical-align:top; ">
                    {{ $pendaftar->pekerjaan_wali ?? '-' }}
                </td>
            </tr>
            <tr>
                <td style="vertical-align:top; ">33.&nbsp;</td>
                <td style="vertical-align:top; ">Tempat, Tanggal Lahir </td>
                <td style="vertical-align:top; "> : </td>
                <td style="vertical-align:top; ">
                    {{ $pendaftar->tempat_lahir_wali? $pendaftar->tempat_lahir_wali .', ' .\Carbon\Carbon::parse($pendaftar->tanggal_lahir_wali)->isoFormat('D MMMM Y'): '-' }}
                </td>
            </tr>
            <tr>
                <td style="vertical-align:top; ">34.&nbsp;</td>
                <td style="vertical-align:top; ">Alamat Wali </td>
                <td style="vertical-align:top; "> : </td>
                <td style="vertical-align:top; ">{{ $pendaftar->alamat_wali ?? '-' }}
                </td>
            </tr>
            <tr>
                <td style="vertical-align:top; ">35.&nbsp;</td>
                <td style="vertical-align:top; ">No. Telepon / HP </td>
                <td style="vertical-align:top; "> : </td>
                <td style="vertical-align:top; ">{{ $pendaftar->no_hp_wali ?? '-' }}
                </td>
            </tr>
            <tr>
                <td style="vertical-align:top; ">36.&nbsp;</td>
                <td style="vertical-align:top; ">Status Hubungan Wali </td>
                <td style="vertical-align:top; "> : </td>
                <td style="vertical-align:top; ">
                    {{ $pendaftar->status_hubungan_wali ?? '-' }}</td>
            </tr>
            <tr>
                <td style="vertical-align:top; ">37.&nbsp;</td>
                <td style="vertical-align:top; ">Penghasilan Orang Tua </td>
                <td style="vertical-align:top; "> : </td>
                <td style="vertical-align:top; ">
                    <table class="w-100">
                        <tr>
                            <td class="rincian" style="vertical-align:top; " colspan="2">&nbsp;&nbsp;Per
                                Bulan
                            </td>
                            <td class="rincian text-center" style="vertical-align:top; width: 15%">Ayah</td>
                            <td class="rincian text-center" style="vertical-align:top; width: 15%">Ibu</td>
                            <td class="rincian text-center" style="vertical-align:top; width: 15%">Wali</td>
                        </tr>
                        <tr>
                            <td class="rincian text-center" style="vertical-align:top; width: 10%">A.</td>
                            <td class="rincian" style="vertical-align:top; ">&nbsp;&nbsp;&lt;500.000</td>
                            <td class="rincian text-center" style="vertical-align:middle; ">
                                @if ($pendaftar->penghasilan_ayah == 'A')
                                    <img src="{{ public_path('assets/images/check.png') }}" alt=""
                                        style="height: 17px">
                                @endif
                            </td>
                            <td class="rincian text-center" style="vertical-align:middle; ">
                                @if ($pendaftar->penghasilan_ibu == 'A')
                                    <img src="{{ public_path('assets/images/check.png') }}" alt=""
                                        style="height: 17px">
                                @endif
                            </td>
                            <td class="rincian text-center" style="vertical-align:middle; ">
                                @if ($pendaftar->penghasilan_wali == 'A')
                                    <img src="{{ public_path('assets/images/check.png') }}" alt=""
                                        style="height: 17px">
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td class="rincian text-center" style="vertical-align:top; ">B.</td>
                            <td class="rincian" style="vertical-align:top; ">&nbsp;&nbsp;500.000-2.000.000
                            </td>
                            <td class="rincian text-center" style="vertical-align:middle; ">
                                @if ($pendaftar->penghasilan_ayah == 'B')
                                    <img src="{{ public_path('assets/images/check.png') }}" alt=""
                                        style="height: 17px">
                                @endif
                            </td>
                            <td class="rincian text-center" style="vertical-align:middle; ">
                                @if ($pendaftar->penghasilan_ibu == 'B')
                                    <img src="{{ public_path('assets/images/check.png') }}" alt=""
                                        style="height: 17px">
                                @endif
                            </td>
                            <td class="rincian text-center" style="vertical-align:middle; ">
                                @if ($pendaftar->penghasilan_wali == 'B')
                                    <img src="{{ public_path('assets/images/check.png') }}" alt=""
                                        style="height: 17px">
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td class="rincian text-center" style="vertical-align:top; ">C.</td>
                            <td class="rincian" style="vertical-align:top; ">&nbsp;&nbsp;2.000.000-4.000.000
                            </td>
                            <td class="rincian text-center" style="vertical-align:middle; ">
                                @if ($pendaftar->penghasilan_ayah == 'C')
                                    <img src="{{ public_path('assets/images/check.png') }}" alt=""
                                        style="height: 17px">
                                @endif
                            </td>
                            <td class="rincian text-center" style="vertical-align:middle; ">
                                @if ($pendaftar->penghasilan_ibu == 'C')
                                    <img src="{{ public_path('assets/images/check.png') }}" alt=""
                                        style="height: 17px">
                                @endif
                            </td>
                            <td class="rincian text-center" style="vertical-align:middle; ">
                                @if ($pendaftar->penghasilan_wali == 'C')
                                    <img src="{{ public_path('assets/images/check.png') }}" alt=""
                                        style="height: 17px">
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td class="rincian text-center" style="vertical-align:top; ">D.</td>
                            <td class="rincian" style="vertical-align:top; ">&nbsp;&nbsp;4.000.000-6.000.000
                            </td>
                            <td class="rincian text-center" style="vertical-align:middle; ">
                                @if ($pendaftar->penghasilan_ayah == 'D')
                                    <img src="{{ public_path('assets/images/check.png') }}" alt=""
                                        style="height: 17px">
                                @endif
                            </td>
                            <td class="rincian text-center" style="vertical-align:middle; ">
                                @if ($pendaftar->penghasilan_ibu == 'D')
                                    <img src="{{ public_path('assets/images/check.png') }}" alt=""
                                        style="height: 17px">
                                @endif
                            </td>
                            <td class="rincian text-center" style="vertical-align:middle; ">
                                @if ($pendaftar->penghasilan_wali == 'D')
                                    <img src="{{ public_path('assets/images/check.png') }}" alt=""
                                        style="height: 17px">
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td class="rincian text-center" style="vertical-align:top; ">E.</td>
                            <td class="rincian" style="vertical-align:top; ">&nbsp;&nbsp;6.000.000-8.000.000
                            </td>
                            <td class="rincian text-center" style="vertical-align:middle; ">
                                @if ($pendaftar->penghasilan_ayah == 'E')
                                    <img src="{{ public_path('assets/images/check.png') }}" alt=""
                                        style="height: 17px">
                                @endif
                            </td>
                            <td class="rincian text-center" style="vertical-align:middle; ">
                                @if ($pendaftar->penghasilan_ibu == 'E')
                                    <img src="{{ public_path('assets/images/check.png') }}" alt=""
                                        style="height: 17px">
                                @endif
                            </td>
                            <td class="rincian text-center" style="vertical-align:middle; ">
                                @if ($pendaftar->penghasilan_wali == 'E')
                                    <img src="{{ public_path('assets/images/check.png') }}" alt=""
                                        style="height: 17px">
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td class="rincian text-center" style="vertical-align:top; ">F.</td>
                            <td class="rincian" style="vertical-align:top; ">&nbsp;&nbsp;&gt;8.000.000</td>
                            <td class="rincian text-center" style="vertical-align:middle; ">
                                @if ($pendaftar->penghasilan_ayah == 'F')
                                    <img src="{{ public_path('assets/images/check.png') }}" alt=""
                                        style="height: 17px">
                                @endif
                            </td>
                            <td class="rincian text-center" style="vertical-align:middle; ">
                                @if ($pendaftar->penghasilan_ibu == 'F')
                                    <img src="{{ public_path('assets/images/check.png') }}" alt=""
                                        style="height: 17px">
                                @endif
                            </td>
                            <td class="rincian text-center" style="vertical-align:middle; ">
                                @if ($pendaftar->penghasilan_wali == 'F')
                                    <img src="{{ public_path('assets/images/check.png') }}" alt=""
                                        style="height: 17px">
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td colspan="5" class="text-right" style="border-bottom: none">*) Beri tanda
                                ( <img src="{{ public_path('assets/images/check.png') }}" alt=""
                                    style="height: 17px">
                                )
                                kolom yang sesuai</td>
                        </tr>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>


    <p style="font-size: 15px;" class="mt-3 font-weight-bold text-uppercase">E. keterangan Kegemaran / hobi
    </p>
    <table class="mt-n3" style="margin-left: 1rem; width: 98%;">
        <tbody>
            <tr>
                <td style="vertical-align:top; width: 1%;">38.&nbsp;</td>
                <td style="vertical-align:top;">Kelas Khusus dan Prestasi Menonjol dalam Bidang </td>
            </tr>
        </tbody>
    </table>
    <table style="margin-left: 3rem; width: 98%;">
        <tbody>
            <tr>
                <td style="vertical-align:top; width: 1%;">a.&nbsp;</td>
                <td style="vertical-align:top; width: 15%;">Kesenian </td>
                <td style="vertical-align:top; width: 2%;"> : </td>
                <td style="vertical-align:top; ">{{ $pendaftar->kesenian }}</td>
            </tr>
            <tr>
                <td style="vertical-align:top; ">b.&nbsp;</td>
                <td style="vertical-align:top; ">Olah Raga </td>
                <td style="vertical-align:top; "> : </td>
                <td style="vertical-align:top; ">{{ $pendaftar->olahraga }}</td>
            </tr>
            <tr>
                <td style="vertical-align:top; ">c.&nbsp;</td>
                <td style="vertical-align:top; ">Organisasi </td>
                <td style="vertical-align:top; "> : </td>
                <td style="vertical-align:top; ">{{ $pendaftar->organisasi }}</td>
            </tr>
            <tr>
                <td style="vertical-align:top; ">d.&nbsp;</td>
                <td style="vertical-align:top; ">Lain-lain </td>
                <td style="vertical-align:top; "> : </td>
                <td style="vertical-align:top; ">{{ $pendaftar->lain_lain }}</td>
            </tr>
        </tbody>
    </table>
</body>

</html>
