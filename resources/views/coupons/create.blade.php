<h1>TAMBAH KUPON BARU</h1>
<form method="POST" action="{{ route('coupons.store') }}">
    @csrf
    Kode Kupon (Contoh: DISKON10):<br><input type="text" name="code" required><br><br>
    Nominal Diskon (Rupiah):<br><input type="number" name="discount_amount" required><br><br>
    <button>Simpan Kupon</button>
</form><br><a href="{{ route('coupons.index') }}">Kembali</a>