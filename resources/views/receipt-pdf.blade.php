<!DOCTYPE html>
<html>
<head>
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Download</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 40px;
            color: #1f2937;
        }
        .header {
            text-align: center;
            
        }
        .header h1 {
            font-size: 20px;
            font-weight: bold;
            margin: 0;
        }
        .header p {
            font-size: 11px;
            color: #4b5563;
            margin: 4px 0 0;
        }

        .invoice {
            width: 100%;
            margin-bottom: 10px;
            gap: 1rem; /* setara gap-4 (16px) */
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .invoice h1 {
            text-align: center;
            font-size: 18px; /* setara text-sm (14px) */
            color: #4b5563;     /* setara text-gray-600 */
            font-weight: 800; 
        }

        .divider {
            border-top: 2px dashed #4b5563;
            margin: 16px 0;
        }
        .row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 8px;
        }
        .label {
            font-size: 13px;
            font-weight: bold;
        }
        .value {
            font-size: 12px;
            color: #4b5563;
        }
        .grid {
            width: 100%;
        }
        .grid td {
            font-size: 12px;
            padding: 4px 0;
        }
        .footer {
            text-align: center;
            margin-top: 24px;
            font-size: 16px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>CV. Sumber Pasir Jaya</h1>
        <p>Jl. Raya Jonggol-Dayeuh, Sukanegara, Kec. Jonggol, Kabupaten Bogor, Jawa Barat 16830</p>
        <p>No telp: 0822-1010-2006</p>
    </div>

    <div class="invoice">
        <h1>{{ $sale->invoice_number }}</h1>
    </div>

    <div class="divider"></div>

    <div>
        <div class="row" style="margin-bottom: 10px">
            <div class="label">Nama Customer:</div>
            <div class="value">{{ $sale->customer }}</div>
        </div>
        <div class="row">
            <div class="label">Tanggal:</div>
            <div class="value">{{ \Carbon\Carbon::parse($sale->created_at)->format('d M Y') }}</div>
        </div>
    </div>

    <div class="divider"></div>

    <table class="grid" width="100%">
        <thead>
            <tr>
                <td class="label">Material:</td>
                <td class="label" style="text-align: center;">Quantity:</td>
                <td class="label" style="text-align: right;">Harga:</td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="value">{{ $sale->material }}</td>
                <td class="value" style="text-align: center;">{{ $sale->quantity }} M<sup>3</sup></td>
                <td class="value" style="text-align: right;">IDR {{ number_format($sale->price, 0, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>

    <div class="divider"></div>

    <div style="margin-top: 20px">
        <div class="row">
            <div class="label">Total:</div>
            <div class="value">IDR {{ number_format($sale->quantity * $sale->price, 0, ',', '.') }}</div>
        </div>
        <div class="row">
            <div class="label">Dibayarkan:</div>
            <div class="value">IDR {{ number_format($sale->paid, 0, ',', '.') }}</div>
        </div>
        <div class="row">
            <div class="label">Kembalian:</div>
            <div class="value">IDR {{ number_format($sale->paid - ($sale->quantity * $sale->price), 0, ',', '.') }}</div>
        </div>
    </div>
    
    <div class="divider"></div>

    <div class="row">
        <div class="label">Status Pembayaran:</div>
        <div class="value">{{ $sale->payment_status }}</div>
    </div>

    <div class="divider"></div>

    <div class="footer">Thank you for using our service</div>
</body>
</html>