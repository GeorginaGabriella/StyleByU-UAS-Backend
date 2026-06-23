<h1>CHECKOUT</h1>

@if(session('error'))
    <p style="color:red">{{ session('error') }}</p>
@endif

<form method="POST" action="{{ route('checkout.process') }}">
    @csrf

    <h3>1. Pilih Alamat Pengiriman</h3>
    @if($addresses->count() > 0)
        <select name="address_id" required>
            <option value="">-- Pilih Alamat --</option>
            @foreach($addresses as $addr)
                <option value="{{ $addr->id }}">[{{ $addr->title }}] {{ $addr->recipient_name }} - {{ $addr->city }}</option>
            @endforeach
        </select>
    @else
        <p style="color:red;">Belum ada alamat. Silakan <a href="{{ route('addresses.create') }}">tambah alamat</a> terlebih dahulu.</p>
    @endif

    <br><br>

    <h3>2. Pilih Kurir</h3>
    <select name="shipping_method_id" required>
        <option value="">-- Pilih Kurir --</option>
        @foreach($shippings as $ship)
            <option value="{{ $ship->id }}">{{ $ship->name }} (Est. {{ $ship->estimated_days }} hari) - Rp {{ number_format($ship->price, 0, ',', '.') }}</option>
        @endforeach
    </select>

    <br><br>

    <h3>3. Pilih Metode Pembayaran</h3>
    <select name="payment_method_id" required>
        <option value="">-- Pilih Pembayaran --</option>
        @foreach($payments as $pay)
            <option value="{{ $pay->id }}">{{ $pay->name }} ({{ $pay->type }})</option>
        @endforeach
    </select>

    <br><br>

    <h3>4. Gunakan Kupon (Opsional)</h3>
    <input type="text" name="coupon_code" placeholder="Masukkan kode kupon (contoh: HEMAT10K)" value="{{ old('coupon_code') }}" style="padding:5px; width: 250px;">

    <br><br>

    <h3>5. Ringkasan Pesanan Dipilih</h3>
    <table border="1" cellpadding="5">
        <tr><th>Produk</th><th>Jumlah</th><th>Harga</th></tr>
        @foreach($selectedItems as $item)
        <tr>
            <td>{{ $item->product->name }} {{ $item->variant ? '('.$item->variant->name.')' : '' }}</td>
            <td>{{ $item->quantity }}</td>
            <td>Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</td>
        </tr>
        @endforeach
    </table>

    <br>
    <p>Total Belanja Dipilih: <strong>Rp {{ number_format($totalCart, 0, ',', '.') }}</strong></p>
    <p><small>*Potongan kupon & ongkir akan dihitung setelah klik Proses</small></p>

    <br><br>
    <button type="submit" {{ $addresses->count() == 0 ? 'disabled' : '' }}>PROSES PESANAN</button>
</form>

<br>
<a href="{{ route('cart.index') }}">Kembali ke Keranjang</a>