<!DOCTYPE html>
<html>
    <head>
        <title>Web Pemesanan Tiket Bioskop Online</title>
         <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        <h1>Web Pemesanan Tiket Bioskop Online</h1>
        <nav>
            <a href="{{route('film.index')}}">Film</a>
            <a href="{{route('jadwal_tayang.index')}}">Jadwal</a>
            <a href="{{route('pesanan.index')}}">Pesanan</a>
        </nav>
        <hr>
        @yield('content')
    </div>
</body>
</html>