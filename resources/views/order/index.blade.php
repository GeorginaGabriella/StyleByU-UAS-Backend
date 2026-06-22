<h1>RIWAYAT PESANAN SAYA</h1>

<a href="{{ route('dashboard') }}">Kembali ke Dashboard</a>

<br><br>

@if(session('success'))
    <p style="color:green">{{ session('success') }}</p>
@endif

<table border="1" cellpadding="8" cellspacing="0">
    <tr>
        <th>No</th>
        <th>Invoice ID</th>
        <th>Tanggal</th>
        <th>Total</th>
        <th>Status</th>
        <th>Aksi</th>
    </tr>

    @foreach($orders as $order)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>INV-{{ str_pad($order->id, 4, '0', STR_PAD_LEFT) }}</td>
        <td>{{ $order->created_at->format('d M Y') }}</td>
        <td>Rp {{ number_format($order->total_amount, 0, ',', '.') }}</td>
        <td>{{ strtoupper($order->status) }}</td>
        <td>
            <a href="{{ route('orders.show', $order) }}">Invoice</a>
            
            @if($order->status == 'pending')
                | <a href="{{ route('payments.pay', $order) }}">Bayar</a>
            @endif
        </td>
    </tr>
    @endforeach

    @if($orders->count() == 0)
    <tr>
        <td colspan="6" style="text-align:center;">Belum ada pesanan</td>
    </tr>
    @endif
</table>
