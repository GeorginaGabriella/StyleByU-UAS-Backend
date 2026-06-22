<h1>ADMIN DASHBOARD</h1>

<p>
    Halo {{ auth()->user()->name }}
</p>

<ul>
    <li><a href="{{ route('home') }}">Homepage</a></li>
    <li><a href="{{ route('categories.index') }}">Category Management</a></li>
    <li><a href="{{ route('brands.index') }}">Brand Management</a></li>
    <li><a href="{{ route('banners.index') }}">Banner Management</a></li>
    <li><a href="{{ route('products.create') }}">Product Management</a></li>
    <li><a href="{{ route('admin.orders.index') }}">Order Management</a></li>
    <li><a href="{{ route('admin.shipping.index') }}">Shipping Methods</a></li>
    <li><a href="{{ route('coupons.index') }}">Coupon Management</a></li>
</ul>

<form method="POST" action="{{ route('logout') }}">
    @csrf

    <button type="submit">
        Logout
    </button>
</form>