<h1>Detail Product</h1>

<p>Nama : {{ $product->name }}</p>
<p>Description : {{ $product->description }}</p>
<p>Price : Rp {{ number_format($product->price, 0, ',', '.') }}</p>
<p>Stock : {{ $product->stock }}</p>
<p>Category : {{ $product->category->name ?? '-' }}</p>
<p>Brand : {{ $product->brand->name ?? '-' }}</p>

<a href="{{ route('products.index') }}">Kembali ke Daftar Produk</a>

<hr>

@if(session('success'))
    <p style="color:green">{{ session('success') }}</p>
@endif

@if(session('error'))
    <p style="color:red">{{ session('error') }}</p>
@endif

<hr>

<h3>Tambah ke Keranjang</h3>

<form method="POST" action="{{ route('cart.store') }}">
    @csrf

    <input type="hidden" name="product_id" value="{{ $product->id }}">

    <p>
        Variant:
        <select name="product_variant_id">
            <option value="">Tanpa Variant</option>
            @foreach($product->variants as $variant)
                <option value="{{ $variant->id }}">
                    {{ $variant->name }} (Stock: {{ $variant->stock }})
                </option>
            @endforeach
        </select>
    </p>

    <p>
        Qty:
        <input type="number" name="quantity" value="1" min="1">
    </p>

    <button type="submit">Add to Cart</button>
</form>

<hr>

<h3>Wishlist</h3>

<form method="POST" action="{{ route('wishlist.store') }}">
    @csrf
    <input type="hidden" name="product_id" value="{{ $product->id }}">
    <button type="submit">Tambah ke Wishlist</button>
</form>

<hr>

@if(auth()->check() && auth()->user()->isAdmin())
    <p>
        <a href="{{ route('variants.index', $product->id) }}">
            Kelola Variant (Admin)
        </a>
    </p>
@endif
