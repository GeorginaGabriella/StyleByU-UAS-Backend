<h1>DASHBOARD PELANGGAN</h1>

@if(session('success'))
    <p style="color:green">{{ session('success') }}</p>
@endif

<p>Halo, <strong>{{ auth()->user()->name }}</strong></p>

<ul>
    <li><a href="{{ route('home') }}">Beranda</a></li>
    <li><a href="{{ route('products.index') }}">Jelajahi Produk</a></li>
    <li><a href="{{ route('cart.index') }}">Keranjang Saya</a></li>
    <li><a href="{{ route('wishlist.index') }}">Wishlist Saya</a></li>
    <li><a href="{{ route('orders.index') }}">Pesanan Saya</a></li>
    <li><a href="{{ route('addresses.index') }}">Alamat Saya</a></li>
    <li><a href="{{ route('user.edit') }}">Ubah Profil</a></li>
    <li>
        <a href="{{ route('notifications.index') }}">
            Notifikasi Saya
            @php $unread = auth()->user()->unreadNotifications()->count(); @endphp
            @if($unread > 0) ({{ $unread }} baru) @endif
        </a>
    </li>
</ul>

<form method="POST" action="{{ route('logout') }}">
    @csrf
    <button type="submit">KELUAR</button>
</form>