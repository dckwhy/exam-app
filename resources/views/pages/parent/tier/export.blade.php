<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bukti Pembayaran {{ $user_exam->tier->name }}</title>
    <style>
        .header {
            text-align: center;
        }

        .info {
            margin-top: 20px;
        }

        footer {
            position: fixed;
            height: 100px;
            bottom: 0px;
            left: 0px;
            right: 0px;
            margin-bottom: 0px;
        }

        .info {
            border: 1px solid black;
            padding: 10px;
        }

        footer .table-footer {
            margin-left: auto;
        }
    </style>
</head>

<body>
    <div class="header">
        <h3><u>Bukti Pembayaran Kelas {{ $user_exam->tier->name }}</u></h3>
    </div>
    <div class="info">
        <table>
            <tr>
                <td>Orang Tua</td>
                <td> : {{ $user_exam->parent->name }}</td>
            </tr>
            <tr>
                <td>Nama Anak</td>
                <td> : {{ $user_exam->child->name }}</td>
            </tr>
            <tr>
                <td>Kelas</td>
                <td> : {{ $user_exam->tier->name }}</td>
            </tr>
            <tr>
                <td>Harga</td>
                <td> : Rp. {{ number_format($user_exam->tier->price,0) }}</td>
            </tr>
            <tr>
                <td>Tanggal Pembayaran</td>
                <td> : {{ \Carbon\Carbon::parse($user_exam->updated_at)->format('d F Y') }}</td>
            </tr>
        </table>
        <footer>
            <table class="table-footer">
                <tr>
                    <td style="width: 50%" class="text" align="center">..............., .... ............... 20....<br>
                        <br><br><br><b>Ashyilla Course</b>
                    </td>
                </tr>
            </table>
        </footer>
    </div>
</body>

</html>