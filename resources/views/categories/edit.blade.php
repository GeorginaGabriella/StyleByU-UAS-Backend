<h1>Ubah Kategori</h1>
<form method="POST" action="{{ route('categories.update', $category) }}">
    @csrf @method('PUT')
    Nama Kategori:<br>
    <input type="text" name="name" value="{{ $category->name }}" required>
    <br><br>
    <button type="submit">Perbarui</button>
</form>
<br><a href="{{ route('categories.index') }}">Kembali</a>