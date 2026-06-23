<h1>STYLEBYU - REGISTER</h1>
<hr>

@if($errors->any())
    @foreach($errors->all() as $error)
        <p style="color:red">{{ $error }}</p>
    @endforeach
@endif

<form method="POST" action="{{ route('register.post') }}">
    @csrf
    <p>Nama:<br><input type="text" name="name" value="{{ old('name') }}" required></p>
    <p>Email:<br><input type="email" name="email" value="{{ old('email') }}" required></p>
    <p>Password:<br><input type="password" name="password" required></p>
    <p>Konfirmasi Password:<br><input type="password" name="password_confirmation" required></p>
    <p><button type="submit">REGISTER</button></p>
</form>

<hr>
<p>Sudah punya akun? <a href="{{ route('login') }}">Login</a></p>