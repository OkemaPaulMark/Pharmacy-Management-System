<!DOCTYPE html>
<html>
<head>
    <title>Sales Report</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 6px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h2>Sales Report</h2>

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
                    <td>{{ number_format($transaction->unit_price, 2) }}</td>
                    <td>{{ $transaction->quantity }}</td>
                    <td>{{ number_format($transaction->total, 2) }}</td>
                    <td>{{ $transaction->created_at->format('M d, Y H:i') }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="5" style="text-align: right;"><strong>Total Sales:</strong></td>
                <td><strong>UGX {{ number_format($totalSales, 2) }}</strong></td>
            </tr>
        </tfoot>
    </table>
</body>
</html>
