<h1>DASHBOARD ADMIN</h1>

@if(session('success'))
    <p style="color:green">{{ session('success') }}</p>
@endif

<p>Halo, <strong>{{ auth()->user()->name }}</strong> (ADMIN)</p>

<ul>
    <li><a href="{{ route('home') }}">Beranda</a></li>
    <li><a href="{{ route('categories.index') }}">Kelola Kategori</a></li>
    <li><a href="{{ route('brands.index') }}">Kelola Merek</a></li>
    <li><a href="{{ route('banners.index') }}">Kelola Banner</a></li>
    <li><a href="{{ route('products.create') }}">Kelola Produk</a></li>
    <li><a href="{{ route('admin.orders.index') }}">Kelola Pesanan</a></li>
    <li><a href="{{ route('admin.shipping.index') }}">Metode Pengiriman</a></li>
    <li><a href="{{ route('coupons.index') }}">Kelola Kupon</a></li>
</ul>

<form method="POST" action="{{ route('logout') }}">
    @csrf
    <button type="submit">KELUAR</button>
</form>