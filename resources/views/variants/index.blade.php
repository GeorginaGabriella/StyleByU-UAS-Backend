<h1>VARIAN PRODUK: {{ $product->name }}</h1>
<p>Harga Dasar: Rp {{ number_format($product->price, 0, ',', '.') }}</p>

<a href="{{ route('products.index') }}">Kembali ke Produk</a>
<br><br>

@if(session('success'))
    <p style="color:green">{{ session('success') }}</p>
@endif

<h3>Tambah Varian</h3>
<form method="POST" action="{{ route('variants.store', $product->id) }}">
    @csrf
    Nama Varian (contoh: S - Hitam):<br>
    <input type="text" name="name" required><br><br>
    Stok:<br>
    <input type="number" name="stock" value="0" required><br><br>
    Harga (kosongkan = ikut harga produk):<br>
    <input type="number" name="price" step="0.01"><br><br>
    <button type="submit">Simpan Varian</button>
</form>

<br><br>

<h3>Daftar Varian</h3>
@if($variants->count() > 0)
    <table border="1" cellpadding="8" cellspacing="0">
        <tr><th>No</th><th>Nama</th><th>Stok</th><th>Harga</th><th>Aksi</th></tr>
        @foreach($variants as $variant)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $variant->name }}</td>
            <td>{{ $variant->stock }}</td>
            <td>
                @if($variant->price)
                    Rp {{ number_format($variant->price, 0, ',', '.') }}
                @else
                    Ikut harga produk
                @endif
            </td>
            <td>
                <a href="{{ route('variants.edit', $variant) }}">Ubah</a>
                <form method="POST" action="{{ route('variants.destroy', $variant) }}" style="display:inline;">
                    @csrf @method('DELETE')
                    <button type="submit">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
@else
    <p>Belum ada varian untuk produk ini.</p>
@endif