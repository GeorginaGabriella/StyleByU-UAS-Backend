<h1>USER DASHBOARD</h1>

<p>Halo {{ auth()->user()->name }}</p>

<ul>
    <li><a href="{{ route('products.index') }}">Browse Product</a></li>
    <li><a href="{{ route('cart.index') }}">My Cart</a></li>
    <li><a href="{{ route('wishlist.index') }}">My Wishlist</a></li>
    <li><a href="{{ route('orders.index') }}">My Orders</a></li>
    <li><a href="{{ route('addresses.index') }}">My Addresses</a></li>
    <li><a href="{{ route('user.edit') }}">Edit Profil</a></li>
</ul>

<form method="POST" action="{{ route('logout') }}">
    @csrf
    <button type="submit">Logout</button>
</form>