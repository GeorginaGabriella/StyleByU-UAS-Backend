<h1>REGISTER STYLEBYU</h1>

@if ($errors->any())
<ul>
    @foreach ($errors->all() as $error)
        <li style="color:red;">
            {{ $error }}
        </li>
    @endforeach
</ul>
@endif

<form method="POST" action="{{ route('register.post') }}">
    @csrf

    Nama
    <br>
    <input type="text" name="name">
    <br><br>

    Email
    <br>
    <input type="email" name="email">
    <br><br>

    Password
    <br>
    <input type="password" name="password" id="password">

    <button type="button" onclick="togglePassword('password')">
        👁
    </button>

    <br><br>

    Konfirmasi Password
    <br>
    <input type="password" name="password_confirmation" id="password_confirmation">

    <button type="button" onclick="togglePassword('password_confirmation')">
        👁
    </button>

    <br><br>

    <button type="submit">
        Register
    </button>
</form>

<br>

<a href="{{ route('login') }}">
    Login
</a>

<script>
function togglePassword(id)
{
    let field = document.getElementById(id);

    if(field.type === 'password')
    {
        field.type = 'text';
    }
    else
    {
        field.type = 'password';
    }
}
</script>