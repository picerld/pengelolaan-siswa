<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <title>Data Kenaikan</title>
</head>

<body>
    <div class="container">
        <h2 class="mt-4">Data Kenaikan</h2>
        @if (Session::has('success'))
            <div class="alert alert-success">
                {{ Session::get('success') }}
            </div>
        @endif
        <div class="mb-3 d-flex justify-content-between">
            <a href="{{ route('kenaikan.create') }}" class="mb-3 btn btn-primary">Tambah Kenaikan</a>
            <a href="{{ route('dashboard') }}" class="mb-3 btn btn-secondary">Kembali</a>
            <a href="{{ route('kenaikan.export', ['status' => request('status'), 'id_kelas' => request('id_kelas')]) }}"
                class="mb-3 btn btn-success">Export Data Kenaikan Siswa</a>
        </div>

        <!-- Filter Form -->
        <form method="GET" action="{{ route('kenaikan.index') }}" class="mb-3">
            <div class="mb-3 row align-items-end">
                <div class="mb-2 col-md-3">
                    <select name="perPage" class="form-control" onchange="this.form.submit()">
                        <option value="10" {{ request('perPage') == 10 ? 'selected' : '' }}>10</option>
                        <option value="25" {{ request('perPage') == 25 ? 'selected' : '' }}>25</option>
                        <option value="50" {{ request('perPage') == 50 ? 'selected' : '' }}>50</option>
                        <option value="100" {{ request('perPage') == 100 ? 'selected' : '' }}>100</option>
                    </select>
                </div>
                <div class="mb-2 col-md-3">
                    <select name="status" class="form-control" onchange="this.form.submit()">
                        <option value="">Pilih Status</option>
                        <option value="Naik" {{ request('status') == 'Naik' ? 'selected' : '' }}>Naik</option>
                        <option value="Tidak Naik" {{ request('status') == 'Tidak Naik' ? 'selected' : '' }}>Tidak Naik
                        </option>
                    </select>
                </div>
                <div class="mb-2 col-md-3">
                    <button type="submit" class="btn btn-primary">Filter</button>
                </div>
            </div>
        </form>

        <!-- Pencarian Siswa -->
        <form method="GET" action="{{ route('kenaikan.index') }}" class="mb-3">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Cari Siswa..."
                    value="{{ request('search') }}">
                <div class="input-group-append">
                    <button class="btn btn-primary" type="submit">Cari</button>
                </div>
            </div>
        </form>

        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>ID Siswa</th>
                    <th>Tahun Ajaran</th>
                    <th>Status</th>
                    <th>Kelas Asal</th>
                    <th>Kelas Tujuan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($kenaikan as $k)
                    <tr>
                        <td>{{ $k->id }}</td>
                        <td>{{ $k->siswa->nama }}</td>
                        <td>{{ $k->tahun_ajaran }}</td>
                        <td>{{ $k->status }}</td>
                        <td>{{ $k->kelasAsal->nama_kelas }}</td>
                        <td>{{ $k->kelasTujuan->nama_kelas }}</td>
                        <td>
                            <a href="{{ route('kenaikan.edit', $k->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('kenaikan.destroy', $k->id) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger" type="submit">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
