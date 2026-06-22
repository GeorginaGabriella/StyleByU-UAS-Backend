<h1>MASTER KUPON</h1>

<a href="{{ route('coupons.create') }}">Tambah Kupon</a> | 
<a href="{{ route('dashboard') }}">Kembali</a>

<br><br>

@if(session('success'))
    <p style="color:green">{{ session('success') }}</p>
@endif

<table border="1" cellpadding="8" cellspacing="0">
    <tr>
        <th>No</th>
        <th>Kode Kupon</th>
        <th>Nominal Diskon</th>
        <th>Aksi</th>
    </tr>

    @foreach($coupons as $coupon)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $coupon->code }}</td>
        <td>Rp {{ number_format($coupon->discount_amount, 0, ',', '.') }}</td>
        <td>
            <form method="POST" action="{{ route('coupons.destroy', $coupon) }}">
                @csrf
                @method('DELETE')
                <button type="submit">Hapus</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>