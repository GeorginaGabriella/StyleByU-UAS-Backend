<h1>TULIS REVIEW PRODUK</h1>

<p>
    Produk: <strong>{{ $product->name }}</strong>
</p>

<p>
    Order: INV-{{ str_pad($order->id, 4, '0', STR_PAD_LEFT) }}
</p>

<hr>

<form method="POST" action="{{ route('reviews.store') }}">
    @csrf

    <input type="hidden" name="product_id" value="{{ $product->id }}">
    <input type="hidden" name="order_id" value="{{ $order->id }}">

    <h3>Rating</h3>
    <select name="rating" required>
        <option value="">-- Pilih Rating --</option>
        <option value="1">1 - Sangat Buruk</option>
        <option value="2">2 - Buruk</option>
        <option value="3">3 - Biasa</option>
        <option value="4">4 - Bagus</option>
        <option value="5">5 - Sangat Bagus</option>
    </select>

    <br><br>

    <h3>Komentar (Opsional)</h3>
    <textarea name="comment" rows="5" cols="40" placeholder="Tulis pengalaman kamu..."></textarea>

    <br><br>

    <button type="submit">Kirim Review</button>
</form>

<br>

<a href="{{ route('orders.show', $order->id) }}">Kembali ke Invoice</a>