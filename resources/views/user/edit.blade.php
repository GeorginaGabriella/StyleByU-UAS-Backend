<h1>EDIT PROFIL</h1>

@if(session('success'))
    <p style="color:green">
        {{ session('success') }}
    </p>
@endif

<form method="POST" action="{{ route('user.update') }}">
    @csrf
    @method('PUT')

    Nama:<br>
    <input type="text"
           name="name"
           value="{{ $user->name }}"
           required>

    <br><br>

    Email:<br>
    <input type="email"
           name="email"
           value="{{ $user->email }}"
           required>

    <br><br>

    <button type="submit">
        Update Profil
    </button>
</form>

<br>

<a href="{{ route('dashboard') }}">
    Kembali ke Dashboard
</a>