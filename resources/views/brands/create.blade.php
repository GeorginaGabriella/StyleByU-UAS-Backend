<h1>Tambah Merek Baru</h1>
<form method="POST" action="{{ route('brands.store') }}">
    @csrf
    Nama Merek:<br><input type="text" name="name" placeholder="Contoh: Uniqlo" required><br><br>
    <button>Simpan</button>
</form><br><a href="{{ route('brands.index') }}">Kembali</a>