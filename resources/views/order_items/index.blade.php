<h1>DETAIL ITEM: INV-{{ str_pad($order->id, 4, '0', STR_PAD_LEFT) }}</h1>

<a href="{{ route('orders.show', $order) }}">Kembali ke Invoice</a>

<br><br>

<table border="1" cellpadding="8" cellspacing="0">
    <tr>
        <th>No</th>
        <th>Nama Produk</th>
        <th>Variant</th>
        <th>Harga Satuan</th>
        <th>Qty</th>
    </tr>

    @foreach($items as $item)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $item->product->name }}</td>
        <td>{{ $item->variant ? $item->variant->name : '-' }}</td>
        <td>Rp {{ number_format($item->price, 0, ',', '.') }}</td>
        <td>{{ $item->quantity }}</td>
    </tr>
    @endforeach
</table>