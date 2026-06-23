<h1>WISHLIST SAYA</h1>

@if(session('success'))
    <p style="color:green">{{ session('success') }}</p>
@endif

@if($wishlists->count() > 0)
    <table border="1" cellpadding="8" cellspacing="0">
        <tr><th>No</th><th>Nama Produk</th><th>Harga</th><th>Aksi</th></tr>
        @foreach($wishlists as $wishlist)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td><a href="{{ route('products.show', $wishlist->product) }}">{{ $wishlist->product->name }}</a></td>
            <td>Rp {{ number_format($wishlist->product->price, 0, ',', '.') }}</td>
            <td>
                <form method="POST" action="{{ route('wishlist.destroy', $wishlist) }}">
                    @csrf @method('DELETE')
                    <button type="submit">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
@else
    <p>Wishlist kamu masih kosong.</p>
@endif

<br>
<a href="{{ route('products.index') }}">Jelajahi Produk</a>