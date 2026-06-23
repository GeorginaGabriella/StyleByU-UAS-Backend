<h1>Ubah Banner</h1>
<form method="POST" action="{{ route('banners.update', $banner) }}">
    @csrf @method('PUT')
    Judul:<br><input type="text" name="title" value="{{ $banner->title }}" required><br><br>
    URL Gambar:<br><input type="text" name="image_url" value="{{ $banner->image_url }}"><br><br>
    Deskripsi:<br><textarea name="description">{{ $banner->description }}</textarea><br><br>
    <button>Perbarui</button>
</form><br><a href="{{ route('banners.index') }}">Kembali</a>