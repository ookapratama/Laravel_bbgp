<?php

namespace App\Exports;

use App\Models\Honor;
use App\Models\PesertaKegiatan;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;

class HonorNarasumberExport implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents
{
    use Exportable;

    protected $headers = [
        'No',
        'Nama Lengkap',
        'Gol',
        'Realisasi JP',
        'Jumlah',
        'Jumlah Honor',
        'Pot',
        'Jumlah Diterima',
    ];

    protected $customHeader = [
        'HONORARIUM FASILITATOR PAKET MODUL 3 (3.1, 3.2, 3.3), AKSI NYATA 2.3, JURNAL REFLEKSI',
        'DWI MINGGUAN PROGRAM PENDIDIKAN GURU PENGGERAK ANGKATAN 9',
        'DALAM RANGKA PELATIHAN MODUL CALON GURU PENGGERAK (CGP) WILAYAH PROV. SULAWESI SELATAN',
        'SESUAI SK KEPALA BALAI BESAR GURU PENGGERAK , NO: /B7.6/GT.00.02/2023, TANGGAL DENGAN RINCIAN SBB:',
        'Kode Anggaran :',
    ];

    /**
     * @return Collection
     */
    public function collection()
    {
        // Fetch data from PesertaKegiatan and Honor models
        $pesertaKegiatan = PesertaKegiatan::where('status_keikutpesertaan', 'narasumber')->get();
        $honor = Honor::get();

        // Check if either collection is empty
        if ($pesertaKegiatan->isEmpty() || $honor->isEmpty()) {
            return new Collection([]);
        }

        $datas = [];

        // Merge data from PesertaKegiatan and Honor
        foreach ($pesertaKegiatan as $index => $peserta) {
            $jumlahHonor = isset($honor[$index]->jumlah_honor) ? $honor[$index]->jumlah_honor : 0;
            $potongan = isset($honor[$index]->potongan) ? $honor[$index]->potongan : 0;

            $datas[] = [
                'No' => $index + 1,
                'Nama Lengkap' => $peserta->nama,
                'Gol' => $peserta->golongan,
                'Realisasi JP' => isset($honor[$index]->jp_realisasi) ? $honor[$index]->jp_realisasi : '',
                'Jumlah' => isset($honor[$index]->jumlah) ? $honor[$index]->jumlah : '',
                'Jumlah Honor' => $jumlahHonor,
                'Pot' => $potongan,
                'Jumlah Diterima' => $jumlahHonor - $potongan, // Calculation for amount received
            ];
        }

        return new Collection($datas);
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return $this->headers;
    }

    /**
     * @return array
     */
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                // Access the PhpSpreadsheet object
                $sheet = $event->sheet->getDelegate();

                // Insert custom headers at the top
                $sheet->insertNewRowBefore(1, count($this->customHeader));
                foreach ($this->customHeader as $index => $header) {
                    $sheet->mergeCells('A' . ($index + 1) . ':H' . ($index + 1));
                    $sheet->setCellValue('A' . ($index + 1), $header);
                    $sheet->getStyle('A' . ($index + 1))->getFont()->setBold(true);
                    $sheet->getStyle('A' . ($index + 1))->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                }

                // Apply borders to the custom headers
                $headerRange = 'A1:H' . count($this->customHeader);
                $sheet->getStyle($headerRange)->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => ['argb' => 'FF000000'],
                        ],
                    ],
                ]);

                // Apply borders to the main headers
                $sheet->getStyle('A' . (count($this->customHeader) + 1) . ':H' . (count($this->customHeader) + 1))->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => ['argb' => 'FF000000'],
                        ],
                    ],
                ]);

                // Center align all cells
                $totalRows = $sheet->getHighestRow();
                $totalColumns = $sheet->getHighestColumn();
                $sheet->getStyle('A1:' . $totalColumns . $totalRows)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

                // Format Jumlah, Jumlah Honor, Potongan, Jumlah Diterima as Rupiah
                $rupiahColumns = ['E', 'F', 'G', 'H']; // Columns for Jumlah, Jumlah Honor, Potongan, Jumlah Diterima
                foreach ($rupiahColumns as $column) {
                    $sheet->getStyle($column . '2:' . $column . $totalRows)
                        ->getNumberFormat()
                        ->setFormatCode('#,##0.00');
                }

                // Apply borders to all cells
                $allRange = 'A1:' . $totalColumns . $totalRows;
                $sheet->getStyle($allRange)->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => ['argb' => 'FF000000'],
                        ],
                    ],
                ]);
            },
        ];
    }
}
