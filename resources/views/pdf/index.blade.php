<!DOCTYPE html>
<html>
<head>
    <title>Laporan Ringkasan Penjualan</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        table, th, td { border: 1px solid black; }
        th, td { padding: 6px; text-align: left; }
        h2 { margin-bottom: 0; }
    </style>
</head>
<body>
    <h2>Laporan Ringkasan Penjualan</h2>
    <p>Total Orders: {{ $totalOrders }}</p>
    <p>Total Revenue: Rp{{ number_format($totalRevenue, 0, ',', '.') }}</p>

    <h4>Ringkasan Orders by Status</h4>
    <ul>
        @foreach ($ordersByStatus as $order)
            <li>{{ ucfirst($order->status) }}: {{ $order->count }}</li>
        @endforeach
    </ul>

    <h4>Top Customers</h4>
    <table>
        <thead>
            <tr>
                <th>Nama</th>
                <th>Jumlah Order</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($topCustomers as $customer)
                <tr>
                    <td>{{ $customer->name }}</td>
                    <td>{{ $customer->orders_count }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h4>5 Custom Requests Terakhir</h4>
    <table>
        <thead>
            <tr>
                <th>Nama</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($customRequests as $req)
                <tr>
                    <td>{{ $req->name }}</td>
                    <td>{{ $req->created_at->format('d M Y') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
