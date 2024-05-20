<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ public_path('css/bootstrap.min.css') }}">
    <title>Kwitansi Angsuran - {{ $pendaftar->user->name }}</title>

    <style>
        @page {
            margin: 1rem;
        }

        body {
            margin: 1rem;
        }

    </style>
</head>

<body style="font-size: 11pt; border:6px solid black; border-radius: 8px; padding:2px; border-style: double;">
    <div>
        <table class="w-100">
            <tbody class="text-uppercase font-weight-bold">
                <tr>
                    <td style="vertical-align: top">
                        <img src="{{ public_path('assets/images/logo-white.png') }}" alt="" style="width: 100px">
                    </td>
                    <td class="text-center" style="vertical-align: middle">
                        <p style="font-size: 19pt">tanda terima daftar ulang siswa baru</p>
                        <p style="font-size: 15pt" class="mt-n3">sma perintis 2 bandar lampung</p>
                        <p style="font-size: 15pt" class="mt-n3">tahun pelajaran
                            {{ date('Y') . '/' . date('Y') + 1 }}</p>
                    </td>
                </tr>
            </tbody>
        </table>
        <hr style="border: 1.5px solid black; margin-top: -0.5rem">
        <hr style="border: 0.7px solid black; margin-top: -0.9rem">

        <?php
        $total = $params['uang_spp'] * 2 + $params['uang_pangkal'] + $params['kaos_olahraga'] + $params['bed_lokasi_dll'] + $params['baju_seragam'];
        ?>

        <div style="padding: 0 10px 0 10px; vertical-align: middle;">
            <table class="mt-n2 w-100">
                <tr>
                    <td style="width: 24%;">No Pendaftaran / NISN</td>
                    <td style="width: 2%;"> : </td>
                    <td style="width: 35%;">{{ $pendaftar->no_pendaftaran . ' / ' . $pendaftar->user->username }}
                    </td>
                    <td rowspan="2" class="rounded text-uppercase text-center text-white"
                        style="background-color:black; vertical-align: middle; font-size: 15pt; font-style: italic; font-weight: bold;">
                        Kelas {{ $pendaftar->kelas->jenis_kelas }}
                        {{-- Kelas regular non ac --}}
                    </td>
                </tr>
                <tr>
                    <td>Telah diterima Dari</td>
                    <td> : </td>
                    <td>{{ $pendaftar->user->name }}</td>
                </tr>
                <tr>
                    <td>Uang Sejumlah</td>
                    <td> : </td>
                    <td colspan="2" class="text-capitalize" style="font-weight: bold; font-style: italic;">
                        &quot; {{ Terbilang::generate($total) . ' rupiah' }} &quot;
                    </td>
                </tr>
            </table>


            <table class="w-100">
                <tr>
                    <td style="width: 83%;">Uang Pangkal / Pengembangan Sekolah</td>
                    <td style="width: 17%;" class="text-right">Rp.&nbsp;&nbsp;
                        {{ number_format($params['uang_pangkal'], 0, ',', '.') }},-
                    </td>
                </tr>
                <tr>
                    <td>Uang SPP 2 Bulan (Juli & Agustus {{ date('Y') }}) @ Rp.
                        {{ number_format($params['uang_spp'], 0, ',', '.') }} / Bln</td>
                    <td class="text-right">Rp.
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ number_format($params['uang_spp'] * 2, 0, ',', '.') }},-
                    </td>
                </tr>
                <tr>
                    <td>Kaos Olahraga (Kaos + Training)</td>
                    <td class="text-right">Rp.
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ number_format($params['kaos_olahraga'], 0, ',', '.') }},-
                    </td>
                </tr>
                <tr>
                    <td>Bed, Lokasi, Topidan Dasi OSIS</td>
                    <td class="text-right">Rp.
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ number_format($params['bed_lokasi_dll'], 0, ',', '.') }},-
                    </td>
                </tr>
                <tr>
                    <td>Baju Seragam Sekolah + Dasi</td>
                    <td class="text-right">Rp.
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ number_format($params['baju_seragam'], 0, ',', '.') }},-
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td class="text-right font-weight-bold">Rp.
                        &nbsp;&nbsp;{{ number_format($total, 0, ',', '.') }},-
                    </td>
                </tr>
            </table>
            <p class="text-capitalize font-weight-bold"><i>Terbilang: &quot; {{ Terbilang::generate($total) }} rupiah
                    &quot;
                </i>
            </p>

            <table class="w-100">
                <tr>
                    <td style="width: 13%;"></td>
                    <td style="width: 34%; background-color:rgb(236, 236, 236)" class="text-center px-3 py-2">
                        <span class="font-weight-bold" style="font-size: 20pt;">
                            Rp. {{ number_format($total, 0, ',', '.') }},-
                        </span>
                    </td>
                    <td style="width: 13%;"></td>
                    <td style="width: 40%" style="vertical-align: top">Bandar Lampung, ...........................
                        {{ date('Y') }}
                        <br>
                        Bendahara PPDB Reguler,
                    </td>
                </tr>
            </table>
        </div>
    </div>
</body>
