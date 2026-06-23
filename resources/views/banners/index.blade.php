<h1>STYLEBYU - BANNER</h1>
<a href="{{ route('banners.create') }}">+ Tambah Banner</a><br><br>

@if(session('success'))
    <p style="color:green">{{ session('success') }}</p>
@endif

<table border="1" cellpadding="5">
    <tr><th>No</th><th>Judul</th><th>Aksi</th></tr>
    @foreach($banners as $banner)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $banner->title }}</td>
        <td>
            <a href="{{ route('banners.edit', $banner) }}">Ubah</a>
            <form method="POST" action="{{ route('banners.destroy', $banner) }}" style="display:inline;">
                @csrf @method('DELETE') <button>Hapus</button>
            </form>
        </td>
    </tr>
    @endforeach
</table><br>
<a href="{{ route('dashboard') }}">Kembali ke Dashboard</a>