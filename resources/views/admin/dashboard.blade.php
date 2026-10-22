<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Bi-Kantin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4">
    <div class="container">
        <a class="navbar-brand" href="#">Bi-Kantin Admin</a>
        <a href="{{ route('logout') }}" class="btn btn-danger btn-sm">Logout</a>
    </div>
</nav>

<div class="container">
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Form Tambah Menu -->
    <div class="card mb-4 shadow-sm">
        <div class="card-header bg-white"><h5>Tambah Menu Baru</h5></div>
        <div class="card-body">
            <form action="{{ route('admin.menu.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Nama Menu</label>
                        <input type="text" name="nama_menu" class="form-control" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Harga (Rp)</label>
                        <input type="number" name="harga" class="form-control" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Kategori</label>
                        <input type="text" name="kategori" class="form-control" required>
                    </div>
                </div>
                <button type="submit" class="btn btn-success">Simpan Menu</button>
            </form>
        </div>
    </div>

    <!-- Tabel Daftar Menu & Pesanan -->
    <div class="row">
        <div class="col-md-6">
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-white"><h5>Daftar Menu Kantin</h5></div>
                <div class="card-body table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Harga</th>
                                <th>Kategori</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($menus as $menu)
                            <tr>
                                <td>{{ $menu->nama_menu }}</td>
                                <td>Rp {{ number_format($menu->harga, 0, ',', '.') }}</td>
                                <td>{{ $menu->kategori }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-white"><h5>Monitoring Pesanan Masuk</h5></div>
                <div class="card-body table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Menu ID</th>
                                <th>Jumlah</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pesanans as $pesanan)
                            <tr>
                                <td>{{ $pesanan->menu_id }}</td>
                                <td>{{ $pesanan->jumlah }}</td>
                                <td>Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}</td>
                                <td><span class="badge bg-warning text-dark">{{ $pesanan->status }}</span></td>
                                <td>
                                    <form action="{{ route('admin.pesanan.status', $pesanan->id) }}" method="POST">
                                        @csrf
                                        <select name="status" class="form-select form-select-sm mb-1" required>
                                            <option value="Menunggu Konfirmasi">Menunggu</option>
                                            <option value="Siap Diambil">Siap Diambil</option>
                                            <option value="Selesai">Selesai</option>
                                        </select>
                                        <button type="submit" class="btn btn-sm btn-primary w-100">Update</button>
                                    </form>
                                </td>
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