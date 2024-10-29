<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <title>Edit Kenaikan</title>
</head>

<body>
    <div class="container">
        <h2 class="mt-4">Edit Kenaikan</h2>
        <form action="{{ route('kenaikan.update', $kenaikan->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="kelas_asal">Siswa</label>
                <select class="form-control" name="id_siswa" id="id_siswa" required>
                    <option value="{{ $kenaikan->id_siswa }}" hidden>{{ $kenaikan->siswa->nama }}</option>
                    @foreach ($siswa as $s)
                        <option value="{{ $s->id }}">{{ $s->nama }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="tahun_ajaran">Tahun Ajaran</label>
                <select class="form-control" name="tahun_ajaran" id="tahun_ajaran" required>
                    <option value="{{ $kenaikan->tahun_ajaran }}" hidden>{{ $kenaikan->tahun_ajaran }}</option>
                    <option value="2024-2025">2024-2025</option>
                    <option value="2025-2026">2025-2026</option>
                </select>
            </div>
            <div class="form-group">
                <label for="kelas_asal">Kelas Asal</label>
                <select class="form-control" name="kelas_asal" id="kelas_asal" required>
                    <option value="{{ $kenaikan->kelas_asal }}">{{ $kenaikan->kelasAsal->nama_kelas }}</option>
                    @foreach ($kelas as $k)
                        <option value="{{ $k->id }}">{{ $k->nama_kelas }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="kelas_tujuan">Kelas Tujuan</label>
                <select class="form-control" name="kelas_tujuan" id="kelas_tujuan" required>
                    <option value="{{ $kenaikan->kelas_tujuan }}">{{ $kenaikan->kelasTujuan->nama_kelas }}</option>
                    @foreach ($kelas as $k)
                        <option value="{{ $k->id }}">{{ $k->nama_kelas }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Perbarui</button>
            <a href="{{ route('kenaikan.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
