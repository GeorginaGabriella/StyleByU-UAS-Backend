<h1>UBAH DATA ONGKIR</h1>

<a href="{{ route('admin.shipping.index') }}">Kembali ke Master Ongkir</a>

<br><br>

<form method="POST" action="{{ route('admin.shipping.update', $shipping) }}">
    @csrf
    @method('PUT')

    Nama Kurir:<br>
    <input type="text" name="name" value="{{ $shipping->name }}" required>
    
    <br><br>

    Keterangan:<br>
    <input type="text" name="description" value="{{ $shipping->description }}">
    
    <br><br>

    Ongkir (Rp):<br>
    <input type="number" name="price" value="{{ $shipping->price }}" required>
    
    <br><br>

    Estimasi (Hari):<br>
    <input type="number" name="estimated_days" value="{{ $shipping->estimated_days }}" required>
    
    <br><br>

    <button type="submit">Perbarui Ongkir</button>
</form>