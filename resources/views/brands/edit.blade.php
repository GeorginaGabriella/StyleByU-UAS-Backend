<h1>Ubah Merek</h1>
<form method="POST" action="{{ route('brands.update', $brand) }}">
    @csrf @method('PUT')
    Nama Merek:<br><input type="text" name="name" value="{{ $brand->name }}" required><br><br>
    <button>Perbarui</button>
</form><br><a href="{{ route('brands.index') }}">Kembali</a>