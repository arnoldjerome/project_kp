<!DOCTYPE html>
<html>

<head>
    <title>Laporan Detail</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 5px;
            text-align: left;
        }

        th {
            background-color: #eee;
        }
    </style>
</head>

<body>
    <h2>Laporan Ringkasan - {{ $month }}</h2>

    <h3>Transaksi Bulanan</h3>
    <table border="1" cellspacing="0" cellpadding="5">
        <thead>
            <tr>
                <th>Nama Customer</th>
                <th>Tanggal</th>
                <th>Status</th>
                <th>Nama Produk</th>
                <th>Qty</th>
                <th>Harga Satuan</th>
                <th>Subtotal</th>
                <th>Total Order</th>
            </tr>
        </thead>
        <tbody>
            @foreach($monthlyOrders as $order)
                @php $totalSubtotal = 0; @endphp
                @foreach($order->items as $item)
                    <tr>
                        <td>{{ $order->user->name ?? '-' }}</td>
                        <td>{{ $order->created_at->format('d M Y') }}</td>
                        <td>{{ ucfirst($order->status) }}</td>
                        <td>{{ $item->product->name ?? '-' }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>Rp{{ number_format($item->price, 0, ',', '.') }}</td>
                        <td>Rp{{ number_format($item->price * $item->quantity, 0, ',', '.') }}</td>
                        <td>Rp{{ number_format($order->total_price, 0, ',', '.') }}</td>
                    </tr>
                    @php $totalSubtotal += $item->price * $item->quantity; @endphp
                @endforeach
            @endforeach
        </tbody>
    </table>

    <h3>Ringkasan Stok</h3>
    <table>
        <thead>
            <tr>
                <th>Nama Produk</th>
                <th>Stok Awal</th>
                <th>Terjual</th>
                <th>Sisa</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($stockSummary as $item)
                <tr>
                    <td>{{ $item['name'] }}</td>
                    <td>{{ $item['initial_stock'] }}</td>
                    <td>{{ $item['sold'] }}</td>
                    <td>{{ $item['remaining'] }}</td>
                    <td>{{ $item['status'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h3>Produk Terlaris</h3>
    <ul>
        @foreach($topProducts as $product)
            <li>{{ $product->name }} - {{ $product->order_items_count }} terjual</li>
        @endforeach
    </ul>

    <h3>Custom Requests Terbaru</h3>
    <table border="1" cellspacing="0" cellpadding="5">
        <thead>
            <tr>
                <th>User</th>
                <th>Request Detail</th>
                <th>Status</th>
                <th>Harga</th>
                <th>Tanggal Dibuat</th>
            </tr>
        </thead>
        <tbody>
            @foreach($customRequests as $request)
                <tr>
                    <td>{{ $request->user->name ?? '-' }}</td>
                    <td>{{ $request->request_detail }}</td>
                    <td>{{ $request->status }}</td>
                    <td>{{ number_format($request->price ?? 0, 0, ',', '.') }}</td>
                    <td>{{ \Carbon\Carbon::parse($request->created_at)->format('d-m-Y') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <h3>Semua Transaksi</h3>
    <table border="1" cellspacing="0" cellpadding="5">
        <thead>
            <tr>
                <th>Customer</th>
                <th>Tanggal</th>
                <th>Status</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($monthlyOrders as $order)
                <tr>
                    <td>{{ $order->user->name ?? '-' }}</td>
                    <td>{{ \Carbon\Carbon::parse($order->created_at)->format('d-m-Y') }}</td>
                    <td>{{ $order->status }}</td>
                    <td>{{ number_format($order->total_price, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>