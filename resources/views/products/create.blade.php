<h1>Tambah Produk Baru</h1>

<form method="POST" action="{{ route('products.store') }}">
    @csrf
    Nama Produk:<br>
    <input type="text" name="name" required><br><br>
    Deskripsi:<br>
    <textarea name="description"></textarea><br><br>
    Harga:<br>
    <input type="number" name="price" required><br><br>
    Stok:<br>
    <input type="number" name="stock" required><br><br>
    Kategori:<br>
    <select name="category_id">
        @foreach($categories as $c)
        <option value="{{ $c->id }}">{{ $c->name }}</option>
        @endforeach
    </select><br><br>
    Merek:<br>
    <select name="brand_id">
        @foreach($brands as $b)
        <option value="{{ $b->id }}">{{ $b->name }}</option>
        @endforeach
    </select><br><br>
    <button>Simpan Produk</button>
</form>

<br>
<a href="{{ route('products.index') }}">Kembali</a>