@if(session('success'))
<p style="color:green;">{{ session('success') }}</p>
@endif

<h1>LOGIN STYLEBYU</h1>

@if ($errors->any())
<ul>
    @foreach ($errors->all() as $error)
        <li style="color:red;">{{ $error }}</li>
    @endforeach
</ul>
@endif

<form method="POST" action="{{ route('login.post') }}">
    @csrf

    Email
    <br>
    <input type="email" name="email">
    <br><br>

    Password
    <br>
    <input type="password" name="password" id="password">

    <button type="button" onclick="togglePassword()">👁</button>

    <br><br>

    <button type="submit">Login</button>
</form>

<br>

<a href="{{ route('register') }}">Register</a>

<script>
function togglePassword()
{
    let password = document.getElementById('password');

    if(password.type === 'password')
    {
        password.type = 'text';
    }
    else
    {
        password.type = 'password';
    }
}
</script>