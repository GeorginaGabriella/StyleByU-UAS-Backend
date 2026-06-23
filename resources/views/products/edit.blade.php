<h1>Ubah Data Produk</h1>

<form method="POST" action="{{ route('products.update', $product) }}">
    @csrf @method('PUT')
    Nama Produk:<br>
    <input type="text" name="name" value="{{ $product->name }}" required><br><br>
    Deskripsi:<br>
    <textarea name="description">{{ $product->description }}</textarea><br><br>
    Harga:<br>
    <input type="number" name="price" value="{{ $product->price }}" required><br><br>
    Stok:<br>
    <input type="number" name="stock" value="{{ $product->stock }}" required><br><br>
    Kategori:<br>
    <select name="category_id">
        @foreach($categories as $c)
        <option value="{{ $c->id }}" {{ $product->category_id == $c->id ? 'selected' : '' }}>{{ $c->name }}</option>
        @endforeach
    </select><br><br>
    Merek:<br>
    <select name="brand_id">
        @foreach($brands as $b)
        <option value="{{ $b->id }}" {{ $product->brand_id == $b->id ? 'selected' : '' }}>{{ $b->name }}</option>
        @endforeach
    </select><br><br>
    <button>Perbarui Produk</button>
</form>

<br>
<a href="{{ route('products.index') }}">Kembali</a>