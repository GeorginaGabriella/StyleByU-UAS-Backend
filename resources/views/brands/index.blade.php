<h1>STYLEBYU - MEREK</h1>
<a href="{{ route('brands.create') }}">+ Tambah Merek</a><br><br>

@if(session('success'))
    <p style="color:green">{{ session('success') }}</p>
@endif
@if(session('error'))
    <p style="color:red">{{ session('error') }}</p>
@endif

<table border="1" cellpadding="5">
    <tr><th>No</th><th>Nama Merek</th><th>Aksi</th></tr>
    @foreach($brands as $brand)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $brand->name }}</td>
        <td>
            <a href="{{ route('brands.edit', $brand) }}">Ubah</a>
            <form method="POST" action="{{ route('brands.destroy', $brand) }}" style="display:inline;">
                @csrf @method('DELETE') <button>Hapus</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>
<br><a href="{{ route('dashboard') }}">Kembali ke Dashboard</a>