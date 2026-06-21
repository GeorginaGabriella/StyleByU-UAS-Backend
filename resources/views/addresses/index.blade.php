<h1>DAFTAR ALAMAT SAYA</h1>

<a href="{{ route('addresses.create') }}">Tambah Alamat Baru</a> |
<a href="{{ route('checkout.index') }}">Kembali ke Checkout</a>

<br><br>

@if(session('success'))
    <p style="color:green">{{ session('success') }}</p>
@endif

@if($addresses->count() > 0)

<table border="1" cellpadding="8" cellspacing="0">
    <tr>
        <th>No</th>
        <th>Judul</th>
        <th>Penerima</th>
        <th>Telepon</th>
        <th>Alamat Lengkap</th>
        <th>Kota</th>
        <th>Aksi</th>
    </tr>

    @foreach($addresses as $address)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $address->title }}</td>
        <td>{{ $address->recipient_name }}</td>
        <td>{{ $address->phone }}</td>
        <td>{{ $address->full_address }}</td>
        <td>{{ $address->city }}</td>
        <td>

            <a href="{{ route('addresses.edit', $address) }}">
                Ubah
            </a>

            <form method="POST"
                  action="{{ route('addresses.destroy', $address) }}"
                  style="display:inline;">
                @csrf
                @method('DELETE')

                <button type="submit">
                    Hapus
                </button>
            </form>

        </td>
    </tr>
    @endforeach

</table>

@else

<p>
Belum ada alamat. Silakan tambahkan alamat terlebih dahulu.
</p>

@endif