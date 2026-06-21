<h1>UBAH ALAMAT</h1>

<form method="POST" action="{{ route('addresses.update', $address) }}">
    @csrf
    @method('PUT')

    Judul Alamat:<br>
    <input type="text"
           name="title"
           value="{{ $address->title }}"
           required>

    <br><br>

    Nama Penerima:<br>
    <input type="text"
           name="recipient_name"
           value="{{ $address->recipient_name }}"
           required>

    <br><br>

    No. Telepon:<br>
    <input type="text"
           name="phone"
           value="{{ $address->phone }}"
           required>

    <br><br>

    Alamat Lengkap:<br>
    <textarea name="full_address"
              rows="4"
              required>{{ $address->full_address }}</textarea>

    <br><br>

    Kota:<br>
    <input type="text"
           name="city"
           value="{{ $address->city }}"
           required>

    <br><br>

    Kode Pos:<br>
    <input type="text"
           name="postal_code"
           value="{{ $address->postal_code }}">

    <br><br>

    <button type="submit">
        Update Alamat
    </button>
</form>

<br>

<a href="{{ route('addresses.index') }}">
    Kembali
</a>