<h1>KERANJANG BELANJA</h1>

@if(session('success'))
    <p style="color:green">{{ session('success') }}</p>
@endif

@if(session('error'))
    <p style="color:red">{{ session('error') }}</p>
@endif

@if($cart->items->count() > 0)
    
    <!-- FORM CHECKOUT DITEMPATKAN DI SINI (DI LUAR TABLE) -->
    <form id="checkout-form" method="POST" action="{{ route('checkout.prepare') }}">
        @csrf
    </form>

    <table border="1" cellpadding="8" cellspacing="0">
        <tr>
            <!-- CHECKBOX INI TERHUBUNG KE FORM CHECKOUT -->
            <th><input type="checkbox" id="checkAll" onclick="toggleAll(this)" form="checkout-form"></th>
            <th>No</th>
            <th>Produk</th>
            <th>Varian</th>
            <th>Harga</th>
            <th>Jumlah</th>
            <th>Subtotal</th>
            <th>Aksi</th>
        </tr>
        @foreach($cart->items as $item)
        <tr>
            <!-- CHECKBOX ITEM JUGA TERHUBUNG KE FORM CHECKOUT -->
            <td><input type="checkbox" name="selected_items[]" value="{{ $item->id }}" class="item-checkbox" form="checkout-form"></td>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $item->product->name }}</td>
            <td>
                <!-- FORM UBAH VARIAN (SEKARANG TERPISAH, TIDAK NESTING) -->
                <form method="POST" action="{{ route('cart-item.update', $item->id) }}" style="display:flex; gap:5px; align-items:center;">
                    @csrf @method('PUT')
                    <select name="product_variant_id" onchange="this.form.submit()" style="padding:4px;">
                        <option value="">Tanpa Varian</option>
                        @foreach($item->product->variants as $variant)
                            <option value="{{ $variant->id }}" {{ $item->product_variant_id == $variant->id ? 'selected' : '' }}>
                                {{ $variant->name }} (Stok: {{ $variant->stock }})
                            </option>
                        @endforeach
                    </select>
                    <input type="hidden" name="quantity" value="{{ $item->quantity }}">
                </form>
            </td>
            <td>Rp {{ number_format($item->price, 0, ',', '.') }}</td>
            <td>
                <!-- FORM UBAH JUMLAH -->
                <form method="POST" action="{{ route('cart-item.update', $item->id) }}">
                    @csrf @method('PUT')
                    <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" style="width:60px;">
                    <input type="hidden" name="product_variant_id" value="{{ $item->product_variant_id }}">
                    <button type="submit">Ubah</button>
                </form>
            </td>
            <td>Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</td>
            <td>
                <!-- FORM HAPUS -->
                <form method="POST" action="{{ route('cart-item.destroy', $item->id) }}">
                    @csrf @method('DELETE')
                    <button type="submit">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>

    <br>
    <!-- TOMBOL INI TERHUBUNG KE FORM CHECKOUT -->
    <button type="submit" form="checkout-form" style="padding:10px; background:green; color:white; border:none; cursor:pointer;">
        CHECKOUT YANG DIPILIH
    </button>

    <script>
        function toggleAll(source) {
            checkboxes = document.getElementsByClassName('item-checkbox');
            for(var i=0, n=checkboxes.length; i<n; i++) {
                checkboxes[i].checked = source.checked;
            }
        }
    </script>
@else
    <p>Keranjang kamu masih kosong.</p>
@endif

<br>
<a href="{{ route('products.index') }}">Lanjut Belanja</a>