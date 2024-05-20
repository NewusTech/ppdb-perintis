<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ public_path('css/bootstrap.min.css') }}">
    <title>Lembar Perjanjian - {{ $pendaftar->user->name }}</title>
    <style>
        .page-break {
            page-break-after: always;
        }

    </style>
</head>

<body style="font-size: 9pt; padding: 0cm 1cm 0cm 1cm;">
    <table class="w-100" style="margin-top: -2.5rem">
        <tbody class="text-uppercase font-weight-bold">
            <tr>
                <td style="vertical-align: top">
                    <img src="{{ public_path('assets/images/logo.png') }}" alt="" style="width: 50px">
                </td>
                <td class="text-center" style="vertical-align: middle">
                    <p style="font-size: 13pt">SURAT PERNYATAAN ORANG TUA/WALI SISWA <br>SMA PERINTIS 2 BANDAR LAMPUNG
                    </p>
                </td>
            </tr>
        </tbody>
    </table>
    <hr style="border: 1.5px solid black; margin-top: -0.5rem">
    <hr style="border: 0.7px solid black; margin-top: -0.9rem">

    <p class="mt-n2">Saya yang bertanda tangan di bawah ini :</p>

    <table class="mt-n3 w-100">
        <tbody>
            <tr>
                <td style="width: 20%;">Nama </td>
                <td style="width: 2%;"> : </td>
                <td>.......................................................................................................................................................
                </td>
            </tr>
            <tr>
                <td>Pekerjaan </td>
                <td> : </td>
                <td>.......................................................................................................................................................
                </td>
            </tr>
            <tr>
                <td>Alamat/Telp </td>
                <td> : </td>
                <td>.......................................................................................................................................................
                </td>
            </tr>
        </tbody>
    </table>

    <p class="mt-1">Adalah orang tua/wali dari siswa :</p>
    <table class="mt-n3 w-100">
        <tbody>
            <tr>
                <td style="width: 20%;">Nama </td>
                <td style="width: 2%;"> : </td>
                <td>{{ $pendaftar->user->name }}</td>
            </tr>
            <tr>
                <td>Tempat, Tanggal Lahir </td>
                <td> : </td>
                <td>{{ $pendaftar->tempat_lahir . ', ' . \Carbon\Carbon::parse($pendaftar->tanggal_lahir)->isoFormat('D MMMM Y') }}
                </td>
            </tr>
        </tbody>
    </table>

    <p class="mt-2">Menyatakan dengan sesungguhnya bahwa akan :</p>
    <div class="text-justify mt-n3" style="margin-left: -1.3rem">
        {!! $tata_tertib !!}
    </div>


    <table class="w-100">
        <tr>
            <td style="width: 60%"></td>
            <td style="width: 40%">Bandar Lampung, ......................................
                {{ date('Y') }}</td>
        </tr>
        <tr>
            <td>Siswa yang Bersangkutan</td>
            <td>Orang Tua/Wali Siswa</td>
        </tr>
        <tr>
            <td>
                <p></p>
            </td>
            <td></td>
        </tr>
        <tr>
            <td class="text-right">
                <p style="font-size: 8pt">Materai 10000</p>
            </td>
            <td></td>
        </tr>
        <tr>
            <td>
                <p></p>
            </td>
            <td></td>
        </tr>
        <tr>
            <td>( {{ $pendaftar->user->name }} )</td>
            <td>( ........................................................................ )</td>
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
