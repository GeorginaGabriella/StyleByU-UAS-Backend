<h1>DAFTAR ULASAN</h1>
<p>Produk: <strong>{{ $product->name }}</strong></p>
<a href="{{ route('products.show', $product->id) }}">Kembali ke Produk</a><br><br>

@if($reviews->count() > 0)
    <p>Total: {{ $reviews->count() }} ulasan</p><br>
    @foreach($reviews as $review)
    <table border="1" cellpadding="8" style="width:100%; margin-bottom:10px;">
        <tr>
            <td style="width:150px;">
                <strong>{{ $review->user->name }}</strong>
                <br><small>{{ $review->created_at->format('d M Y') }}</small>
            </td>
            <td>
                Rating:
                @for($i = 1; $i <= 5; $i++)
                    @if($i <= $review->rating) ★ @else ☆ @endif
                @endfor
                ({{ $review->rating }}/5)
                <br><br>
                @if($review->comment)
                    {{ $review->comment }}
                @else
                    <em>Tidak ada komentar</em>
                @endif
            </td>
        </tr>
    </table>
    @endforeach
@else
    <p>Belum ada ulasan untuk produk ini.</p>
@endif