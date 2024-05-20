<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ public_path('css/bootstrap.min.css') }}">
    <title>Bukti Pendaftaran Awal dan Informasi Daftar Ulang - {{ $pendaftar->user->name }}</title>

    <style>
        .rincian {
            border: 1px solid black;
            border-collapse: collapse;
        }

    </style>
</head>

<body style="font-size: 11pt; padding: 0cm 1cm 0cm 1cm;">
    <?php
    if ($pendaftar->kelas_id == 1) {
        $color = 'success';
    } elseif ($pendaftar->kelas_id == 2) {
        $color = 'danger';
    } else {
        $color = 'primary';
    }
    ?>
    <div class="text-uppercase font-weight-bolder text-center">
        <p class="text-{{ $color }}">FORMULIR PENDAFTARAN PESERTA DIDK BARU {{ $pendaftar->kelas->jenis_kelas }}
        </p>
        <p class="mt-n3">sma perintis 2 bandar lampung</p>
        <p class="mt-n3">tahun pelajaran {{ date('Y') }}/{{ date('Y') + 1 }}</p>
    </div>
    <p class="">A. Identitas Siswa</p>

    <table class="w-100 ml-3 mt-n3">
        <thead>

        </thead>
        <tbody>
            <tr>
                <td style="vertical-align: top; width: 35%">Nama</td>
                <td style="vertical-align: top; width: 1%"> : </td>
                <td style="vertical-align: top;">{{ $pendaftar->user->name }}</td>
            </tr>
            <tr>
                <td style="vertical-align: top">Tempat / Tanggal Lahir</td>
                <td style="vertical-align: top"> : </td>
                <td style="vertical-align: top">
                    {{ $pendaftar->tempat_lahir . ', ' . \Carbon\Carbon::parse($pendaftar->tanggal_lahir)->isoFormat('D MMMM Y') }}
                </td>
            </tr>
            <tr>
                <td style="vertical-align: top">Alamat Lengkap</td>
                <td style="vertical-align: top"> : </td>
                <td style="vertical-align: top">{{ $pendaftar->alamat_lengkap }}</td>
            </tr>
            <tr>
                <td style="vertical-align: top">Jenis Kelamin</td>
                <td style="vertical-align: top"> : </td>
                <td style="vertical-align: top">{{ $pendaftar->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}
                </td>
            </tr>
            <tr>
                <td style="vertical-align: top">Agama</td>
                <td style="vertical-align: top"> : </td>
                <td style="vertical-align: top">{{ $pendaftar->agama }}</td>
            </tr>
            <tr>
                <td style="vertical-align: top">No Hp Siswa</td>
                <td style="vertical-align: top"> : </td>
                <td style="vertical-align: top">{{ $pendaftar->no_hp_siswa }}</td>
            </tr>
           
            <tr>
                <td style="vertical-align: top">NISN</td>
                <td style="vertical-align: top"> : </td>
                <td style="vertical-align: top">{{ $pendaftar->user->username }}</td>
            </tr>
            <tr>
                <td style="vertical-align: top">Asal Sekolah</td>
                <td style="vertical-align: top"> : </td>
                <td style="vertical-align: top">{{ $pendaftar->asal_sekolah }}</td>
            </tr>
            <tr>
                <td style="vertical-align: top">Nama Orang Tua/Wali</td>
                <td style="vertical-align: top"> : </td>
                <td style="vertical-align: top">{{ $pendaftar->nama_ayah }}</td>
            </tr>
            <tr>
                <td style="vertical-align: top">Pekerjaan Orang Tua/Wali</td>
                <td style="vertical-align: top"> : </td>
                <td style="vertical-align: top">{{ $pendaftar->pekerjaan_ayah }}</td>
            </tr>
            <tr>
                <td style="vertical-align: top">Alamat Orang Tua/Wali</td>
                <td style="vertical-align: top"> : </td>
                <td style="vertical-align: top">{{ $pendaftar->alamat_orang_tua }}</td>
            </tr>
            <tr>
                <td style="vertical-align: top">No Hp Orang Tua</td>
                <td style="vertical-align: top"> : </td>
                <td style="vertical-align: top">{{ $pendaftar->no_hp_orang_tua }}</td>
            </tr>
        </tbody>
    </table>

    <p class="mt-4 text-justify">B. Persyaratan Pendaftaran Ulang Bagi Peserta
        Didik Baru SMA Perintis 2 Bandar Lampung T.P. {{ date('Y') }}/{{ date('Y') + 1 }} sebagai
        berikut</p>
    <div class="ml-4 mt-n3 card-title text-uppercase font-weight-bolder">
        <p class="text-{{ $color }}">kelas x {{ $pendaftar->kelas->jenis_kelas }}</p>
    </div>
    <table class="ml-4 mt-n3 rincian" style="width: 96%">
        <thead class="bg-{{ $color }}">
            <tr class="text-light">
                <th class="rincian px-2">NO</th>
                <th class="rincian">Uraian</th>
                <th class="rincian">Jumlah</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="rincian text-center" style="vertical-align: top;">1.</td>
                <td class="rincian px-2" style="vertical-align: top;"> Uang Pendaftaran </td>
                <td class="rincian px-2 text-right" style="vertical-align: top;">Rp&nbsp;&nbsp;&nbsp;&nbsp;
                    {{ number_format($pendaftar->kelas->biaya_pendaftaran, 0, ',', '.') }},-</td>
            </tr>
            <tr>
                <td class="rincian text-center" style="vertical-align: top">2.</td>
                <td class="rincian px-2" style="vertical-align: top"> Uang Pangkal/Pengambangan Sekolah</td>
                <td class="rincian px-2 text-right" style="vertical-align: top">Rp&nbsp;
                    {{ number_format($biaya_daftar_ulang->uang_pangkal, 0, ',', '.') }},-</td>
            </tr>
            <tr>
                <td class="rincian text-center" style="vertical-align: top">3.</td>
                <td class="rincian px-2" style="vertical-align: top"> Uang Uang SPP 2 Bulan (Juli & Agustus
                    {{ date('Y') }})
                    @Rp {{ number_format($biaya_daftar_ulang->uang_spp, 0, ',', '.') }}/Bln </td>
                <td class="rincian px-2 text-right" style="vertical-align: top"> Rp&nbsp;&nbsp;&nbsp;&nbsp;
                    {{ number_format($biaya_daftar_ulang->uang_spp * 2, 0, ',', '.') }},-</td>
            </tr>
            <tr class="bg-{{ $color }} text-light">
                <td class="rincian text-center" style="vertical-align: top"></td>
                <th class="rincian px-2 text-center" style="vertical-align: top"> Jumlah</th>
                <th class="rincian px-2 text-right" style="vertical-align: top">Rp&nbsp;
                    <?php
                    $total = $pendaftar->kelas->biaya_pendaftaran + $biaya_daftar_ulang->uang_pangkal + $biaya_daftar_ulang->uang_spp * 2;
                    ?>
                    {{ number_format($total, 0, ',', '.') }},-
                </th>
            </tr>
        </tbody>
    </table>
    <div class="mt-2 card-title text-capitalize font-weight-bolder text-center">
        <p class="text-{{ $color }} text-capitalize">Terbilang :
            (<i>{{ Terbilang::generate($total) . ' rupiah' }}</i>)
        </p>
    </div>

    <p class="mt-4 text-justify">C. Catatan Untuk Siswa Baru</p>
    <ol class="mt-n3 text-justify">
        <li>
            <p class="card-text">Uang pendaftaran sebesar Rp
                {{ number_format($pendaftar->kelas->biaya_pendaftaran, 0, ',', '.') }},-
                (<span
                    class="text-capitalize">{{ Terbilang::generate($pendaftar->kelas->biaya_pendaftaran) . ' rupiah' }}</span>)
                tidak dapat diambil/dikembalikan karena untuk biaya administrasi.
            </p>
        </li>
        <li>
            <p class="card-text">Bagi siswa yang sudah melakukan daftar ulang,
                kemudian mengundurkan diri, maka uang yang sudah dibayar (kecuali uang
                pendaftaran) dapat diambil kembali dengan ketentuan yang ditetapkan oleh
                Yayasan Pendidikan Perintis Bandar Lampung.</p>
        </li>
        <li>
            <p class="card-text">Bagi yang sudah mengisi formulir pendaftaran awal
                tetapi belum mendaftar ulang (membayar lunas), maka belum dianggap
                diterima di SMA Perintis 2 Bandar Lampung.</p>
        </li>
        <li>
            <p class="card-text">Tahap wawancara wajib diikuti oleh seluruh calon
                siswa.</p>
        </li>
    </ol>

    <table style="width: 100%; text-align:center; margin-top:5rem">
        <tr>
            <td style="width: 50%"></td>
            <td>Bandar Lampung, {{ \Carbon\Carbon::now()->isoFormat(' D MMMM Y') }}</td>
        </tr>
        <tr>
            <td>Petugas pendaftaran</td>
            <td>Pendaftar</td>
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
            <?php
            $role = auth()
                ->user()
                ->roles->first()->name;
            ?>

            @if ($role != 'admin pendaftaran awal')
                <td>( ......................................... )</td>
            @else
                <td>( {{ auth()->user()->name }} )</td>
            @endif
            <td>( {{ $pendaftar->user->name }} )</td>
        </tr>
    </table>
</body>

</html>
