<h1>ADMIN - DAFTAR ORDER</h1>

<a href="{{ route('dashboard') }}">Kembali ke Dashboard</a>

<br><br>

@if(session('success'))
    <p style="color:green">{{ session('success') }}</p>
@endif

<table border="1" cellpadding="8" cellspacing="0">
    <tr>
        <th>Invoice</th>
        <th>User</th>
        <th>Total</th>
        <th>Status Order</th>
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
            <form method="POST" action="{{ route('admin.orders.updateStatus', $order) }}" style="display:inline;">
                @csrf @method('PUT')
                <select name="status" onchange="this.form.submit()">
                    <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="paid" {{ $order->status == 'paid' ? 'selected' : '' }}>Paid</option>
                    <option value="packed" {{ $order->status == 'packed' ? 'selected' : '' }}>Packed</option>
                    <option value="shipped" {{ $order->status == 'shipped' ? 'selected' : '' }}>Shipped</option>
                    <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Completed</option>
                </select>
            </form>
        </td>
    </tr>
    @endforeach
</table>