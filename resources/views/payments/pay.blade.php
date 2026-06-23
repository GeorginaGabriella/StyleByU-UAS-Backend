<h1>SIMULASI PEMBAYARAN</h1>

<p>Invoice: INV-{{ str_pad($order->id, 4, '0', STR_PAD_LEFT) }}</p>
<p>Total yang harus dibayar: <strong>Rp {{ number_format($order->total_amount, 0, ',', '.') }}</strong></p>

<br>

<form method="POST" action="{{ route('payments.process', $order) }}">
    @csrf
    <p>Klik tombol di bawah untuk mensimulasikan pembayaran berhasil:</p>
    <button type="submit">KONFIRMASI BAYAR</button>
</form>

<br>
<a href="{{ route('orders.show', $order) }}">Batal</a>