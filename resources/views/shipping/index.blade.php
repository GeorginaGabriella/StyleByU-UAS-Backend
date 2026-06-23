<h1>MASTER DATA ONGKIR</h1>

<a href="{{ route('dashboard') }}">Kembali ke Dashboard</a>

<br><br>

@if(session('success'))
    <p style="color:green">{{ session('success') }}</p>
@endif

<table border="1" cellpadding="8" cellspacing="0">
    <tr>
        <th>No</th>
        <th>Nama Kurir</th>
        <th>Keterangan</th>
        <th>Ongkir</th>
        <th>Estimasi (Hari)</th>
        <th>Aksi</th>
    </tr>
    @foreach($shippings as $ship)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $ship->name }}</td>
        <td>{{ $ship->description }}</td>
        <td>Rp {{ number_format($ship->price, 0, ',', '.') }}</td>
        <td>{{ $ship->estimated_days }} Hari</td>
        <td>
            <a href="{{ route('admin.shipping.edit', $ship) }}">Ubah</a>
        </td>
    </tr>
    @endforeach
</table>