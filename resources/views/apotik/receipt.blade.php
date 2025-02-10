<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resep</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            width: 60%;
            margin: auto;
            border: 1px solid #000;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header h1 {
            margin: 0;
        }
        .header p {
            margin: 0;
            font-size: 14px;
        }
        .content {
            margin-bottom: 20px;
        }
        .content p {
            margin: 5px 0;
        }
        .table-container {
            width: 100%;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        .footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>RESEP RAWAT JALAN</h1>
            <p>Klinik Arafah Anwar Medika</p>
            <p>Jl. Sawo No.2, Sukadono, Sukodono, Kec. Sukodono, Kabupaten Sidoarjo, Jawa Timur 61258</p>
        </div>
        <div class="content">
            <p class="info"><strong>ID Transaksi:</strong> {{ $transaction_id }}</p>
            <p><strong>Nama Pasien:</strong> {{ $patient_name }}</p>
            <p><strong>Nomor RM:</strong> {{ $patient_rm ?? '-' }}</p>
            <p>Apotik / Depo: Apotek Rawat Jalan Poliklinik Lama</p>
            <p class="info"><strong>Tanggal:</strong> {{ $date }}</p>
        </div>

        <h2>Resi Pembayaran</h2>

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama Obat</th>
                        <th>Jml</th>
                        <th>Harga</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($medicine as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $item['nama_obat'] }}</td>
                        <td>1</td>
                        <td>{{ $item['harga'] }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="footer">
            <div>
                <p class="total">Total: Rp {{ number_format($total, 0, ',', '.') }}</p> 
            </div>
            <div>
                <p>Penerima</p>
            </div>
            <div>
                <p>Petugas</p>
            </div>
        </div>
        <div class="content" style="text-align: right;">
            <p>SIDOARJO, {{ now()->format('d-m-Y H:i:s') }}</p>
        </div>
    </div>
</body>
</html>
