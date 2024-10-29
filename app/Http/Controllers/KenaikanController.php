<?php

namespace App\Http\Controllers;

use App\Exports\KenaikanExport;
use App\Models\Kelas;
use App\Models\Kenaikan; // asumsi Anda memiliki model Kenaikan
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class KenaikanController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->input('perPage', 10);

        $kenaikan = Kenaikan::with('siswa')->paginate($perPage);

        $search = $request->input('search');
        $status = $request->input('status');

        $query = Kenaikan::with('siswa');

        if ($status) {
            $query->where('status', $status);
        }

        if ($search) {
            $query->whereHas('siswa', function ($q) use ($search) {
                $q->where('nama', 'like', '%' . $search . '%')
                    ->orWhere('no_telepon', 'like', '%' . $search . '%');
            });
        }

        $kenaikan = $query->paginate($perPage)->withQueryString();

        $kelas = Kelas::all();

        return view('kenaikan.index', [
            'kenaikan' => $kenaikan,
            'kelas' => $kelas
        ]);
    }

    public function create()
    {
        $siswas = Siswa::all();
        $kelas = Kelas::all();

        return view('kenaikan.create', [
            'siswas' => $siswas,
            'kelas' => $kelas
        ]); // Bukti form tambah kenaikan
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_siswa' => 'required|exists:siswas,id',
            'tahun_ajaran' => 'required|string|max:20',
            'kelas_asal' => 'required|exists:kelas,id',
            'kelas_tujuan' => 'required|exists:kelas,id',
        ]);
        
        Kenaikan::create([
            'id_siswa' => $validated['id_siswa'],
            'tahun_ajaran' => $validated['tahun_ajaran'],
            'kelas_asal' => $validated['kelas_asal'],
            'kelas_tujuan' => $validated['kelas_tujuan'],
            'status' => $validated['kelas_asal'] > $validated['kelas_tujuan'] ? 'Tidak Naik' : 'Naik'
        ]);

        return redirect()->route('kenaikan.index')->with('success', 'Kenaikan berhasil ditambahkan');
    }


    public function edit(Kenaikan $kenaikan)
    {
        $kelas = Kelas::all();
        $siswa = Siswa::all();

        return view('kenaikan.edit', [
            'kenaikan' => $kenaikan,
            'kelas' => $kelas,
            'siswa' => $siswa
        ]); // Bukti form edit kenaikan
    }

    public function update(Request $request, Kenaikan $kenaikan)
    {
        $request->validate([
            'id_siswa' => 'required|exists:siswas,id',
            'tahun_ajaran' => 'required|string|max:20',
            'kelas_asal' => 'required|exists:kelas,id',
            'kelas_tujuan' => 'required|exists:kelas,id',
        ]);

        $kenaikan->update([
            'id_siswa' => $request->id_siswa,
            'tahun_ajaran' => $request->tahun_ajaran,
            'kelas_asal' => $request->kelas_asal,
            'kelas_tujuan' => $request->kelas_tujuan,
            'status' => $request->kelas_asal > $request->kelas_tujuan ? 'Tidak Naik' : 'Naik'
        ]);

        return redirect()->route('kenaikan.index')->with('success', 'Kenaikan berhasil diperbarui');
    }

    public function destroy(Kenaikan $kenaikan)
    {
        $kenaikan->delete();
        return redirect()->route('kenaikan.index')->with('success', 'Kenaikan berhasil dihapus');
    }

    public function export(Request $request)
    {
        $status = $request->input('status');
        $kelasId = $request->input('id_kelas');

        return Excel::download(new KenaikanExport($status, $kelasId), 'data_kenaikan.xlsx');
    }
}
