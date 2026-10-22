<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Siswa - Bi-Kantin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-success mb-4">
    <div class="container">
        <a class="navbar-brand" href="#">Bi-Kantin Siswa</a>
        <a href="{{ route('logout') }}" class="btn btn-danger btn-sm">Logout</a>
    </div>
</nav>

<div class="container">
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="row">
        <!-- Katalog Menu -->
        <div class="col-md-6">
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-white"><h5>Katalog Menu Kantin</h5></div>
                <div class="card-body">
                    <form action="{{ route('siswa.pesan') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Pilih Menu</label>
                            <select name="menu_id" class="form-select" required>
                                @foreach($menus as $menu)
                                    <option value="{{ $menu->id }}">{{ $menu->nama_menu }} - Rp {{ number_format($menu->harga, 0, ',', '.') }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Jumlah</label>
                            <input type="number" name="jumlah" class="form-control" min="1" value="1" required>
                        </div>
                        <button type="submit" class="btn btn-success w-100">Pesan Sekarang</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Status Pesanan Siswa -->
        <div class="col-md-6">
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-white"><h5>Status Pesanan Saya</h5></div>
                <div class="card-body table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Menu ID</th>
                                <th>Jml</th>
                                <th>Total</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pesanans as $pesanan)
                            <tr>
                                <td>{{ $pesanan->menu_id }}</td>
                                <td>{{ $pesanan->jumlah }}</td>
                                <td>Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}</td>
                                <td><span class="badge bg-info text-dark">{{ $pesanan->status }}</span></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>