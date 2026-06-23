<h1>DAFTAR PESANAN</h1>

<a href="{{ route('dashboard') }}">Kembali ke Dashboard</a><br><br>

@if(session('success'))
    <p style="color:green">{{ session('success') }}</p>
@endif

<table border="1" cellpadding="8" cellspacing="0">
    <tr>
        <th>Invoice</th>
        <th>Pelanggan</th>
        <th>Total</th>
        <th>Status Pesanan</th>
        <th>Status Bayar</th>
        <th>Aksi</th>
    </tr>

    @foreach($orders as $order)
    <tr>
        <td>INV-{{ str_pad($order->id, 4, '0', STR_PAD_LEFT) }}</td>
        <td>{{ $order->user->name }}</td>
        <td>Rp {{ number_format($order->total_amount, 0, ',', '.') }}</td>
        <td>{{ strtoupper($order->status) }}</td>
        <td>{{ $order->payment?->status ? strtoupper($order->payment->status) : 'N/A' }}</td>
        <td>
            <a href="{{ route('orders.show', $order) }}">Detail</a>
        </td>
    </tr>
    @endforeach
</table>