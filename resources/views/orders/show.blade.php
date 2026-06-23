<h1>INVOICE</h1>

<p style="text-align:center;">
    <strong>STYLEBYU FASHION STORE</strong><br>
    Jl. Contoh Alamat No. 123<br>
    Telp: 08123456789
</p>

<hr>

<table border="0" cellpadding="5">
    <tr><td>No. Invoice</td><td>: INV-{{ str_pad($order->id, 4, '0', STR_PAD_LEFT) }}</td></tr>
    <tr><td>Tanggal</td><td>: {{ $order->created_at->format('d F Y') }}</td></tr>
    <tr><td>Status Pesanan</td><td>: <strong>{{ strtoupper($order->status) }}</strong></td></tr>
</table>

<h3>Informasi Pengiriman</h3>

<table border="0" cellpadding="3">
    <tr><td>Penerima</td><td>: {{ $order->address->recipient_name }}</td></tr>
    <tr><td>Telepon</td><td>: {{ $order->address->phone }}</td></tr>
    <tr><td>Alamat</td><td>: {{ $order->address->full_address }}, {{ $order->address->city }}</td></tr>
    <tr><td>Kurir</td><td>: {{ $order->shippingMethod->name }} (Est. {{ $order->shippingMethod->estimated_days }} Hari)</td></tr>
</table>

<h3>Detail Pesanan</h3>

<table border="1" cellpadding="5" cellspacing="0" style="width:100%;">
    <tr style="background:#f2f2f2;">
        <th>No</th>
        <th>Produk</th>
        <th>Harga</th>
        <th>Jumlah</th>
        <th>Subtotal</th>
    </tr>

    @foreach($order->items as $item)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $item->product->name }} {{ $item->variant ? '('.$item->variant->name.')' : '' }}</td>
        <td>Rp {{ number_format($item->price, 0, ',', '.') }}</td>
        <td>{{ $item->quantity }}</td>
        <td>Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</td>
    </tr>
    @endforeach
</table>

<br>

@php
$totalBelanja = $order->total_amount - $order->shipping_cost;
$diskon = $order->discount_amount ?? 0;
@endphp

<table border="0" cellpadding="3" style="width:300px; float:right;">
    <tr>
        <td>Total Belanja</td>
        <td>: Rp {{ number_format($totalBelanja + $diskon, 0, ',', '.') }}</td>
    </tr>

    @if($diskon > 0)
    <tr style="color:red;">
        <td>Potongan Kupon</td>
        <td>: - Rp {{ number_format($diskon, 0, ',', '.') }}</td>
    </tr>
    @endif

    <tr>
        <td>Ongkos Kirim</td>
        <td>: Rp {{ number_format($order->shipping_cost, 0, ',', '.') }}</td>
    </tr>

    <tr style="font-weight:bold; border-top:1px solid #000;">
        <td>TOTAL</td>
        <td>: Rp {{ number_format($order->total_amount, 0, ',', '.') }}</td>
    </tr>
</table>

<br><br><br><br>

@if($order->status == 'completed')
<h3>Berikan Ulasan Produk</h3>

@foreach($order->items as $item)
<p>
    <strong>{{ $item->product->name }}</strong>
    <a href="{{ route('reviews.create', [$item->product_id, $order->id]) }}">Tulis Ulasan</a>
</p>
@endforeach
@endif

<h3>Informasi Pembayaran</h3>

<p>
    Metode: {{ $order->payment?->method?->name ?? 'N/A' }}<br>
    Status Pembayaran: <strong>{{ strtoupper($order->payment?->status ?? 'N/A') }}</strong>

    @if($order->status == 'pending')
        <br><br>
        <a href="{{ route('payments.pay', $order) }}"
           style="padding:10px; background:blue; color:white; text-decoration:none; border-radius:5px;">
            BAYAR SEKARANG
        </a>
    @endif
</p>

<br>

<a href="{{ route('orders.index') }}">Kembali ke Riwayat Pesanan</a>