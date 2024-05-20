<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ public_path('css/bootstrap.min.css') }}">
    <title>Surat Pernyataan Siswa Baru - {{ $pendaftar->user->name }}</title>
</head>

<body style="font-size: 12pt; padding: 0cm 1cm 0cm 1cm; font-family: serif; ">
    <table class="w-100">
        <tbody>
            <tr>
                <td style="border-bottom: 1px solid black; vertical-align: top;">
                    <img src="{{ public_path('assets/images/logo.png') }}" alt="" style="width: 65px; ">
                </td>
                <td class="text-center" style="border-bottom: 1px solid black;">
                    <p class="text-uppercase font-weight-bold" style="font-size: 15px">yayasan pendidikan perintis
                        bandar lampung <br>
                        sma perintis 2 bandar
                        lampung</p>
                    <p style="margin-top: -1rem">Jl. Khairil Anwar no. 106 Durian Payung, telp. (0721)
                        255304</p>
                </td>
                <td rowspan="2" style="vertical-align: top;" class="text-right">
                    @if ($pendaftar->foto)
                        <img src="{{ url('storage/' . $pendaftar->foto) }}" alt="" class="border border-dark p-1"
                            style="width: 105px; height: 144px; margin-left:10px">
                        {{-- <img src="https://ppdbsmaperintis2.id/storage/berkas/1/lFkZoMr1lmuVfvNVyz2pca8SBcU9LKRSmR8UBDmp.jpg"
                            alt="" class="border border-dark p-1" style="width: 105px; height: 144px; margin-left:10px"> --}}
                    @else
                        <img src="{{ public_path('assets/images/3x4.png') }}" alt=""
                            style="width: 105px; height: 144px; margin-left:10px">
                    @endif
                </td>
            </tr>
            <tr>
                <td></td>
                <td class="text-uppercase text-center">
                    <p style="font-size: 16px;" class="mt-3 font-weight-bold">surat keterangan siswa
                        baru
                        <br> tahun pelajaran
                        {{ date('Y') . '/' . date('Y') + 1 }}
                    </p>
                </td>
            </tr>
        </tbody>
    </table>

    <P>Saya yang bertanda tangan dibawah ini : </P>
    <table class="mt-n3" style="margin-left: 1rem; width: 98%;">
        <tbody>
            <tr>
                <td style="width: 1%;">01.</td>
                <td style="width: 28%;">Nama Lengkap </td>
                <td style="width: 2%;"> : </td>
                <td>{{ $pendaftar->user->name }}</td>
            </tr>
            <tr>
                <td>02.</td>
                <td>Jenis Kelamin </td>
                <td> : </td>
                <td>{{ $pendaftar->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
            </tr>
            <tr>
                <td>03.</td>
                <td>TTL </td>
                <td> : </td>
                <td>{{ $pendaftar->tempat_lahir . ', ' . \Carbon\Carbon::parse($pendaftar->tanggal_lahir)->isoFormat('D MMMM Y') }}
                </td>
            </tr>
            <tr>
                <td>04.</td>
                <td>Agama </td>
                <td> : </td>
                <td>{{ $pendaftar->agama }}</td>
            </tr>
            <tr>
                <td>05.</td>
                <td>Nama Ayah </td>
                <td> : </td>
                <td>{{ $pendaftar->nama_ayah }}</td>
            </tr>
            <tr>
                <td>06.</td>
                <td>Pekerjaan Ayah </td>
                <td> : </td>
                <td>{{ $pendaftar->pekerjaan_ayah }}</td>
            </tr>
            <tr>
                <td>07.</td>
                <td>Nama Ibu</td>
                <td> : </td>
                <td>{{ $pendaftar->nama_ibu }}</td>
            </tr>
            <tr>
                <td>08.</td>
                <td>Pekerjaan Ibu</td>
                <td> : </td>
                <td>{{ $pendaftar->pekerjaan_ibu }}</td>
            </tr>
            <tr>
                <td>09.</td>
                <td>No. Telp / Hp Orang Tua </td>
                <td> : </td>
                <td>{{ $pendaftar->no_hp_orang_tua }}</td>
            </tr>
            <tr>
                <td>10.</td>
                <td>Nama Wali</td>
                <td> : </td>
                <td>{{ $pendaftar->nama_wali ? $pendaftar->nama_wali : '-' }}</td>
            </tr>
            <tr>
                <td>11.</td>
                <td>Pekerjaan Wali</td>
                <td> : </td>
                <td>{{ $pendaftar->pekerjaan_wali ? $pendaftar->pekerjaan_wali : '-' }}</td>
            </tr>
            <tr>
                <td>12.</td>
                <td>No. Telp / Hp Wali </td>
                <td> : </td>
                <td>{{ $pendaftar->no_hp_wali ? $pendaftar->no_hp_wali : '-' }}</td>
            </tr>
            <tr>
                <td>13.</td>
                <td>Agama Wali </td>
                <td> : </td>
                <td>{{ $pendaftar->agama_wali ? $pendaftar->agama_wali : '-' }}</td>
            </tr>
            <tr>
                <td>14.</td>
                <td>Hubungan Dengan Wali</td>
                <td> : </td>
                <td>{{ $pendaftar->status_hubungan_wali ? $pendaftar->status_hubungan_wali : '-' }}</td>
            </tr>
            <tr>
                <td>15.</td>
                <td>Alamat Orang Tua / Wali</td>
                <td> : </td>
                <td>{{ $pendaftar->alamat_wali ? $pendaftar->alamat_wali : '-' }}</td>
            </tr>
        </tbody>
    </table>
    <p class="text-uppercase mt-2">menyatakan bahwa : </p>
    <p class="mt-n3">Selama menjadi siswa SMA Perintis 2 Bandar Lampung, Saya akan : </p>
    <ol class="text-justify mt-n3">
        <li>Sanggup mentaati dan memenuhi pelaksanaan Wiyatamandala, termasuk dengan pekaian seragam sekolah, OSIS, dan
            kegiatan sehari-hari pertama masuk sekolah.</li>
        <li>
            Menjaga nama baik diri sendiri, keluarga, dan sekolah.
        </li>
        <li>
            Mentaati tata tertib yang ditentukan oleh sekolah (tata tertib terlampir).
        </li>
        <li>
            Mengikuti KBM dengan tertib sesuai dengan ketentuan sekolah.
        </li>
        <li>
            Apabila saya tidak mentaati ketentuan yang ditetapkan oleh sekolah, saya sanggup menerima sanksi-sanksi,
            yaitu :
            <ol type="a" class="ml-n1">
                <li>Tidak diperkenankan mengukuti pelajaran selama jangka waktu tertentu.</li>
                <li>Dikembalikan kepada orang tua.</li>
            </ol>
        </li>
        <li>
            Mengikuti kegiatan ekstrakulikuler yang dilaksanakan oleh sekolah.
        </li>

    </ol>
    <p class="text-justify">
        Demikian surat pernyataan ini saya buat dengan sebenarnya, tanpa paksaan dan tekanan dari pihak manapun, serta
        diketaui oleh kedua orang tua / wali saya.
    </p>

    <table class="w-100 mt-5">
        <tr>
            <td style="width: 60%"></td>
            <td>Bandar Lampung, {{ \Carbon\Carbon::now()->isoFormat(' D MMMM Y') }}</td>
        </tr>
        <tr>
            <td>Mengatahui</td>
            <td>Yang Membuat Pernyataan</td>
        </tr>
        <tr>
            <td>Orang Tua / Wali</td>
            <td>Siswa,</td>
        </tr>
        <tr>
            <td></td>
            <td><br /></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td><br /></td>
        </tr>
        <tr>
            <td></td>
            <td><br /></td>
        </tr>
        <tr>
            <td></td>
            <td><br /></td>
        </tr>
        <tr>
            <td>{{ $pendaftar->nama_ayah .' / ' .$pendaftar->nama_ibu .($pendaftar->nama_wali ? ' / ' . $pendaftar->nama_wali : '') }}
            </td>
            <td>{{ $pendaftar->user->name }}</td>
        </tr>
    </table>

    <div class="page-break"></div>

    <div style="font-size: 10pt">
        <table class="w-100" style="margin-top: -2rem">
            <tbody class="text-uppercase font-weight-bold">
                <tr>
                    <td style="vertical-align: top">
                        <img src="{{ public_path('assets/images/logo.png') }}" alt="" style="width: 60px">
                    </td>
                    <td class="text-center" style="vertical-align: middle">
                        <p style="font-size: 15pt">tata tertib <br>SMA PERINTIS 2 BANDAR LAMPUNG
                        </p>
                    </td>
                </tr>
            </tbody>
        </table>
        <hr style="border: 1.5px solid black; margin-top: -0.5rem">
        <hr style="border: 0.7px solid black; margin-top: -0.9rem">

        <div class="text-justify" style="margin-left: -1.2rem">
            {!! $tata_tertib !!}
        </div>
    </div>
</body>

</html>
