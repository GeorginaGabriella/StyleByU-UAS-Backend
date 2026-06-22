<h1>STYLEBYU - FASHION STORE</h1>

@if(session('success'))
    <p style="color:green">{{ session('success') }}</p>
@endif

@if(session('error'))
    <p style="color:red">{{ session('error') }}</p>
@endif

<hr>

<h2>PROMO BANNER</h2>

@if($banners->count() > 0)
    <table border="1" cellpadding="10" style="width:100%;">
        @foreach($banners as $banner)
        <tr>
            <td>
                <strong>{{ $banner->title }}</strong>
                @if($banner->description)
                    <br>{{ $banner->description }}
                @endif
            </td>
        </tr>
        @endforeach
    </table>
@else
    <p>Belum ada promo</p>
@endif

<hr>

<h2>KATEGORI</h2>

<p>
    @foreach($categories as $category)
        {{ $category->name }} |
    @endforeach
</p>

<hr>

<h2>PRODUK TERBARU</h2>

<table border="1" cellpadding="8" cellspacing="0">
    <tr>
        <th>No</th>
        <th>Nama Produk</th>
        <th>Category</th>
        <th>Brand</th>
        <th>Harga</th>
        <th>Aksi</th>
    </tr>

    @foreach($products as $product)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $product->name }}</td>
        <td>{{ $product->category->name ?? '-' }}</td>
        <td>{{ $product->brand->name ?? '-' }}</td>
        <td>Rp {{ number_format($product->price, 0, ',', '.') }}</td>
        <td>
            <a href="{{ route('products.show', $product) }}">Detail</a>
        </td>
    </tr>
    @endforeach
</table>

<hr>

<p>
    @if(auth()->check())
        <a href="{{ route('dashboard') }}">Dashboard</a> |
        <a href="{{ route('products.index') }}">Semua Produk</a>
    @else
        <a href="{{ route('login') }}">Login</a> |
        <a href="{{ route('register') }}">Register</a>
    @endif
</p>