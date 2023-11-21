<!DOCTYPE html>
<html>

<head>
    <title>Laporan Nilai {{ $try_out->name }}</title>
    <style>
        @font-face {
            font-family: SourceSansPro;
            src: url(SourceSansPro-Regular.ttf);
        }

        .clearfix:after {
            content: "";
            display: table;
            clear: both;
        }

        body {
            min-height: 100%;
            padding: 0;
            margin: 0;
            position: relative;
        }

        footer table,
        footer table td {
            border: none;
        }

        #details {
            width: 100%;
            margin: 35px 0;
        }

        #data {
            width: 150px;
            padding-left: 6px;
            border-left: 6px solid black;
            font-size: 20px;
            float: left;
        }

        #data-content {
            width: 500px;
            padding-left: 6px;
            font-size: 20px;
            float: left;
        }

        table {
            width: 100%;
        }

        table th {
            padding: 5px 0;
            font-size: 13px;
        }

        table td {
            padding: 5px 0;
            font-size: 15px;
        }

        table,
        th,
        td {
            text-align: center;
            border: 1px solid black;
            border-collapse: collapse;
        }

        footer {
            position: relative;
            margin-top: 20px;
            bottom: 0;
            width: 100%;
            height: 100px;
        }
    </style>
</head>

<body>
    <div class="container">
        <center>
            <h2><u>LAPORAN NILAI {{ strtoupper($try_out->name) }} {{ strtoupper($user->name) }}</u></h2>
        </center>
        <table>
            <thead>
                <tr>
                    <th width="5%">No.</th>
                    <th>Percobaan Ke</th>
                    <th>Jumlah Soal</th>
                    <th>Jawaban Benar</th>
                    <th>Jawaban Salah</th>
                    <th>Nilai</th>
                </tr>
            </thead>
            <tbody>
                @php
                $no = 1;
                @endphp
                @forelse ($results as $key => $r)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $key+1 }}</td>
                    <td>{{ $r->number_of_question }}</td>
                    <td>{{ $r->correct_amount }}</td>
                    <td>{{ $r->wrong_amount }}</td>
                    <td>{{ number_format($r->grade,1) }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="6">Tidak Ada Data</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</body>

</html>