<h1>Detail Produk</h1>

<p>Nama : {{ $product->name }}</p>
<p>Deskripsi : {{ $product->description }}</p>
<p>Harga : Rp {{ number_format($product->price, 0, ',', '.') }}</p>
<p>Stok : {{ $product->stock }}</p>
<p>Kategori : {{ $product->category->name ?? '-' }}</p>
<p>Merek : {{ $product->brand->name ?? '-' }}</p>

<a href="{{ route('products.index') }}">Kembali ke Daftar Produk</a>

<hr>

@if(session('success'))
    <p style="color:green">{{ session('success') }}</p>
@endif

@if(session('error'))
    <p style="color:red">{{ session('error') }}</p>
@endif

<hr>

<h3>Masukkan ke Keranjang</h3>

@if(auth()->check())
    <form method="POST" action="{{ route('cart.store') }}">
        @csrf
        <input type="hidden" name="product_id" value="{{ $product->id }}">
        <p>
            Varian:
            <select name="product_variant_id">
                <option value="">Tanpa Varian</option>
                @foreach($product->variants as $variant)
                    <option value="{{ $variant->id }}">{{ $variant->name }} (Stok: {{ $variant->stock }})</option>
                @endforeach
            </select>
        </p>
        <p>Jumlah: <input type="number" name="quantity" value="1" min="1"></p>
        <button type="submit">Masukkan Keranjang</button>
    </form>

    <hr>

    <h3>Wishlist</h3>
    <form method="POST" action="{{ route('wishlist.store') }}">
        @csrf
        <input type="hidden" name="product_id" value="{{ $product->id }}">
        <button type="submit">Tambah ke Wishlist</button>
    </form>

    @if(auth()->user()->isAdmin())
        <hr>
        <p><a href="{{ route('variants.index', $product->id) }}">Kelola Varian (Admin)</a></p>
    @endif
@else
    <p><a href="{{ route('login') }}">Masuk</a> untuk memasukkan keranjang</p>
@endif

<hr>

<h3>Ulasan Produk</h3>
<a href="{{ route('reviews.index', $product->id) }}">Lihat Semua Ulasan ({{ $product->reviews->count() }})</a>