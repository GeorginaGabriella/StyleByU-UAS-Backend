<h1>STYLEBYU - LOGIN</h1>
<hr>

@if(session('success'))
    <p style="color:green">{{ session('success') }}</p>
@endif

@if($errors->any())
    @foreach($errors->all() as $error)
        <p style="color:red">{{ $error }}</p>
    @endforeach
@endif

<form method="POST" action="{{ route('login.post') }}">
    @csrf
    <p>Email:<br><input type="email" name="email" value="{{ old('email') }}" required></p>
    <p>Password:<br><input type="password" name="password" required></p>
    <p><button type="submit">LOGIN</button></p>
</form>

<hr>
<p>Belum punya akun? <a href="{{ route('register') }}">Register</a></p>