<h1>KERANJANG BELANJA</h1>

@if(session('success'))
    <p style="color:green">{{ session('success') }}</p>
@endif

@if(session('error'))
    <p style="color:red">{{ session('error') }}</p>
@endif

@if($cart->items->count() > 0)

<table border="1" cellpadding="8" cellspacing="0">
    <tr>
        <th>No</th>
        <th>Produk</th>
        <th>Variant</th>
        <th>Harga</th>
        <th>Qty</th>
        <th>Subtotal</th>
        <th>Aksi</th>
    </tr>

    @foreach($cart->items as $item)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $item->product->name }}</td>
        <td>{{ $item->variant ? $item->variant->name : '-' }}</td>
        <td>Rp {{ number_format($item->price, 0, ',', '.') }}</td>
        <td>
            <form method="POST" action="{{ route('cart-item.update', $item->id) }}">
                @csrf
                @method('PUT')
                <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" style="width:60px;">
                <button type="submit">Update</button>
            </form>
        </td>
        <td>
            Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}
        </td>
        <td>
            <form method="POST" action="{{ route('cart-item.destroy', $item->id) }}">
                @csrf
                @method('DELETE')
                <button type="submit">Hapus</button>
            </form>
        </td>
    </tr>
    @endforeach

</table>

<h3>
    TOTAL: Rp {{ number_format($total, 0, ',', '.') }}
</h3>

@else

<p>Keranjang kamu masih kosong.</p>

@endif
