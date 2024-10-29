<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <title>Create Kenaikan</title>
</head>

<body>
    <div class="container">
        <h2 class="mt-4">Create Kenaikan</h2>
        <form action="{{ route('kenaikan.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="id_siswa">Siswa</label>
                <select class="form-control" name="id_siswa" id="id_siswa" required>
                    <option value="">Pilih Siswa</option>
                    @foreach ($siswas as $siswa)
                        <option value="{{ $siswa->id }}">{{ $siswa->nama }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="tahun_ajaran">Tahun Ajaran</label>
                <select class="form-control" name="tahun_ajaran" id="tahun_ajaran" required>
                    <option value="">Pilih Tahun Ajaran</option>
                    <option value="2024-2025">2024-2025</option>
                    <option value="2025-2026">2025-2026</option>
                </select>
            </div>
            <div class="form-group">
                <label for="kelas_asal">Kelas Asal</label>
                <select class="form-control" name="kelas_asal" id="kelas_asal" required>
                    <option value="">Pilih Kelas Asal</option>
                    @foreach ($kelas as $k)
                        <option value="{{ $k->id }}">{{ $k->nama_kelas }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="kelas_tujuan">Kelas Tujuan</label>
                <select class="form-control" name="kelas_tujuan" id="kelas_tujuan" required>
                    <option value="">Pilih Kelas Tujuan</option>
                    @foreach ($kelas as $k)
                        <option value="{{ $k->id }}">{{ $k->nama_kelas }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
            <a href="{{ route('kenaikan.index') }}" class="btn btn-secondary">Kembali</a>
        </form>

        <h5 class="mt-4">Import Data Kenaikan Siswa</h5>
        <form action="{{ route('kenaikan.import') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="file">Pilih File Excel</label>
                <input type="file" class="form-control" name="file" id="file" accept=".xlsx,.xls,.csv"
                    required>
            </div>
            <button type="submit" class="btn btn-success">Import</button>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
