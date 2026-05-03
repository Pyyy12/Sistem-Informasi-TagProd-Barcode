<!DOCTYPE html>
<html>
<head>
    <title>Production Tag - {{ $production->item_code }}</title>
    <style>
        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            color: #333;
        }
        .tag-container {
            width: 100%;
            border: 2px solid #000;
            padding: 10px;
            box-sizing: border-box;
        }
        .header {
            text-align: center;
            border-bottom: 2px solid #000;
            padding-bottom: 5px;
            margin-bottom: 15px;
        }
        .header h1 {
            margin: 0;
            font-size: 20pt;
            text-transform: uppercase;
        }
        .info-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .info-table td {
            padding: 8px;
            vertical-align: top;
            font-size: 11pt;
            border-bottom: 1px solid #eee;
        }
        .label {
            font-weight: bold;
            width: 40%;
            color: #555;
        }
        .barcode-section {
            text-align: center;
            margin-top: 10px;
            padding: 15px;
            border: 1px dashed #ccc;
            background-color: #fafafa;
        }
        .barcode-image {
            margin-bottom: 5px;
        }
        .barcode-text {
            font-family: 'Courier', monospace;
            font-size: 10pt;
            letter-spacing: 2px;
            font-weight: bold;
        }
        .footer {
            margin-top: 10px;
            font-size: 8pt;
            text-align: right;
            font-style: italic;
        }
    </style>
</head>
<body>
    <div class="tag-container">
        <div class="header">
            <h1>Production Tag</h1>
            <div style="font-size: 10pt;">PT. INDUSTRI MANUFAKTUR INDONESIA</div>
        </div>

        <table class="info-table">
            <tr>
                <td class="label">Nama Barang</td>
                <td>: {{ $production->item_name }}</td>
            </tr>
            <tr>
                <td class="label">Kode Item</td>
                <td>: {{ $production->item_code }}</td>
            </tr>
            <tr>
                <td class="label">No. Batch</td>
                <td>: {{ $production->batch_number }}</td>
            </tr>
            <tr>
                <td class="label">Tgl Produksi</td>
                <td>: {{ date('d F Y', strtotime($production->production_date)) }}</td>
            </tr>
            <tr>
                <td class="label">Qty / Jumlah</td>
                <td>: <strong>{{ $production->quantity }} Unit</strong></td>
            </tr>
            <tr>
                <td class="label">Operator</td>
                <td>: {{ $production->operator_name }}</td>
            </tr>
        </table>

        <div class="barcode-section">
            <div class="barcode-image">
                {{-- Generate Barcode C128 (Panjang) --}}
                {!! DNS1D::getBarcodeHTML($production->item_code, 'C128', 2, 60) !!}
            </div>
            <div class="barcode-text">
                {{ $production->item_code }}
            </div>
        </div>

        <div class="footer">
            Dicetak pada: {{ $date }}
        </div>
    </div>
</body>
</html>