<?php

namespace App\Exports;

use App\Models\Kenaikan;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class KenaikanExport implements FromView, ShouldAutoSize
{
    protected $status;
    protected $kelasId;

    public function __construct($status = null, $kelasId = null)
    {
        $this->status = $status;
        $this->kelasId = $kelasId;
    }


    public function view(): View
    {
        try {
            Log::info('SiswaExport view method called');
            Log::info("Status: {$this->status}, KelasId: {$this->kelasId}");

            $query = Kenaikan::with('siswa');

            if ($this->status) {
                $query->where('status', $this->status);
                Log::info("Filtering by status: {$this->status}");
            }

            if ($this->kelasId) {
                $query->where('id_kelas', $this->kelasId);
                Log::info("Filtering by kelas ID: {$this->kelasId}");
            }

            $kenaikan = $query->get();
            Log::info("Total siswa retrieved: " . $kenaikan->count());

            return view('exports.kenaikan', [
                'kenaikan' => $kenaikan
            ]);
        } catch (\Exception $e) {
            Log::error('Error in SiswaExport: ' . $e->getMessage());
            throw $e;
        }
    }
}
