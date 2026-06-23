<h1>Detail Banner</h1>
<p>ID : {{ $banner->id }}</p>
<p>Title : {{ $banner->title }}</p>
<p>Image URL : {{ $banner->image_url }}</p>
<p>Description : {{ $banner->description }}</p>
<a href="{{ route('banners.index') }}">Kembali</a>