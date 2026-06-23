<h1>DAFTAR PRODUK STYLEBYU</h1>

<form method="GET">
    <input type="text" name="search" placeholder="Cari nama produk..." value="{{ request('search') }}">
    <button>Cari</button>
</form>

<br>

@if(auth()->check() && auth()->user()->isAdmin())
    <a href="{{ route('products.create') }}">+ Tambah Produk Baru</a>
@endif

<br><br>

@if(session('success'))
    <p style="color:green">{{ session('success') }}</p>
@endif

<table border="1" cellpadding="5">
    <tr>
        <th>No</th>
        <th>Nama</th>
        <th>Kategori</th>
        <th>Merek</th>
        <th>Harga</th>
        <th>Stok</th>
        <th>Aksi</th>
    </tr>
    @foreach($products as $product)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td><a href="{{ route('products.show', $product) }}">{{ $product->name }}</a></td>
        <td>{{ $product->category->name ?? '-' }}</td>
        <td>{{ $product->brand->name ?? '-' }}</td>
        <td>Rp {{ number_format($product->price, 0, ',', '.') }}</td>
        <td>{{ $product->stock }}</td>
        <td>
            @if(auth()->check() && auth()->user()->isAdmin())
                <a href="{{ route('products.edit', $product) }}">Ubah</a>
                <form method="POST" action="{{ route('products.destroy', $product) }}" style="display:inline;">
                    @csrf @method('DELETE')
                    <button>Hapus</button>
                </form>
            @else
                <a href="{{ route('products.show', $product) }}">Detail</a>
            @endif
        </td>
    </tr>
    @endforeach
</table>

<br>
<a href="{{ route('home') }}">Kembali ke Beranda</a>