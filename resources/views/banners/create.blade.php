<h1>Tambah Banner Baru</h1>
<form method="POST" action="{{ route('banners.store') }}">
    @csrf
    Judul:<br><input type="text" name="title" required><br><br>
    URL Gambar:<br><input type="text" name="image_url"><br><br>
    Deskripsi:<br><textarea name="description"></textarea><br><br>
    <button>Simpan</button>
</form><br><a href="{{ route('banners.index') }}">Kembali</a>