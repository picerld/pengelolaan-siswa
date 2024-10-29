<?php

namespace App\Imports;

use App\Models\Kelas;
use App\Models\Kenaikan;
use App\Models\Siswa;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithSkipDuplicates;

class KenaikanImport implements ToModel, WithHeadings, WithHeadingRow, WithSkipDuplicates
{
    public function model(array $row)
    {
        return new Kenaikan([
            'id_siswa'      => Siswa::where('nama', $row['id_siswa'])->first()->id,
            'tahun_ajaran'  => $row['tahun_ajaran'],
            'status'        => $row['status'],
            'kelas_asal'    => Kelas::firstOrCreate(['id' => $row['kelas_asal']])->id,
            'kelas_tujuan'  => Kelas::firstOrCreate(['id' => $row['kelas_tujuan']])->id,
        ]);
    }

    public function headings(): array
    {
        return [
            'Nama Siswa',
            'Tahun Ajaran',
            'Kelas Asal',
            'Kelas Tujuan',
            'Status',
        ];
    }
}
