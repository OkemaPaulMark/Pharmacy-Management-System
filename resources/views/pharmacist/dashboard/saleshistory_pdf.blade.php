<!DOCTYPE html>
<html>
<head>
    <title>Sales History Report</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table th, table td {
            padding: 8px;
            border: 1px solid #ddd;
        }
        table th {
            background-color: #f2f2f2;
        }
        .text-right {
            text-align: right;
        }
    </style>
</head>
<body>
    <h2>Sales History Report</h2>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Medicine</th>
                <th>Unit Price</th>
                <th>Quantity</th>
                <th>Total</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transactions as $index => $transaction)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $transaction->medicine->name ?? 'N/A' }}</td>
                    <td>UGX{{ number_format($transaction->unit_price, 2) }}</td>
                    <td>{{ $transaction->quantity }}</td>
                    <td>UGX{{ number_format($transaction->total, 2) }}</td>
                    <td>{{ $transaction->created_at->format('M d, Y H:i') }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="4" class="text-right"><strong>Total Sales:</strong></td>
                <td colspan="2"><strong>UGX{{ number_format($totalSales, 2) }}</strong></td>
            </tr>
        </tfoot>
    </table>
</body>
</html>
