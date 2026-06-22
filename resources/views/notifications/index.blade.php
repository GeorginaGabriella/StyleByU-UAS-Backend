<h1>NOTIFIKASI SAYA</h1>

<a href="{{ route('dashboard') }}">Kembali ke Dashboard</a>

<br><br>

@if(session('success'))
    <p style="color:green">{{ session('success') }}</p>
@endif

@if($notifications->count() > 0)

    <p>Total: {{ $notifications->count() }} notifikasi</p>

    <br>

    @foreach($notifications as $notif)

    <table border="1" cellpadding="8" style="width:100%; margin-bottom:10px; {{ $notif->is_read ? 'background:#f9f9f9;' : 'background:#fff3cd;' }}">
        <tr>
            <td style="width:80%;">
                <strong>{{ $notif->title }}</strong>
                <br>
                {{ $notif->message }}
                <br>
                <small>{{ $notif->created_at->format('d M Y, H:i') }}</small>
            </td>
            <td>
                @if(!$notif->is_read)
                    <form method="POST" action="{{ route('notifications.read', $notif) }}">
                        @csrf
                        @method('PUT')
                        <button type="submit">Tandai Dibaca</button>
                    </form>
                @else
                    <span style="color:green;">Sudah dibaca</span>
                    <br>
                @endif

                <form method="POST" action="{{ route('notifications.destroy', $notif) }}" style="margin-top:5px;">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Hapus</button>
                </form>
            </td>
        </tr>
    </table>

    @endforeach

@else

    <p>Tidak ada notifikasi.</p>

@endif