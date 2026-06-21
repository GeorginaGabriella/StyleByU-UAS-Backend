<h1>TAMBAH ALAMAT BARU</h1>

<form method="POST" action="{{ route('addresses.store') }}">
    @csrf

    Judul Alamat (Contoh: Rumah, Kos):<br>
    <input type="text" name="title" required>

    <br><br>

    Nama Penerima:<br>
    <input type="text" name="recipient_name" required>

    <br><br>

    No. Telepon:<br>
    <input type="text" name="phone" required>

    <br><br>

    Alamat Lengkap:<br>
    <textarea name="full_address" rows="4" required></textarea>

    <br><br>

    Kota:<br>
    <input type="text" name="city" required>

    <br><br>

    Kode Pos (Opsional):<br>
    <input type="text" name="postal_code">

    <br><br>

    <button type="submit">
        Simpan Alamat
    </button>
</form>

<br>

<a href="{{ route('addresses.index') }}">
    Kembali
</a>