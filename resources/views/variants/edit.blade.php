<h1>UBAH VARIAN PRODUK: {{ $product->name }}</h1>

<a href="{{ route('variants.index', $product->id) }}">Kembali ke Daftar Varian</a>

<br><br>

<form method="POST" action="{{ route('variants.update', $variant) }}">
    @csrf
    @method('PUT')

    Nama Varian:<br>
    <input type="text" name="name" value="{{ $variant->name }}" required>
    
    <br><br>

    Stok:<br>
    <input type="number" name="stock" value="{{ $variant->stock }}" required>
    
    <br><br>

    Harga (kosongkan = ikut harga produk):<br>
    <input type="number" name="price" step="0.01" value="{{ $variant->price }}">
    
    <br><br>

    <button type="submit">Perbarui Varian</button>
</form>