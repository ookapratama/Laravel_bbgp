<?php

namespace App\Exports;

use App\Models\Kuitansi;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class KuitansiExport implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents
{
    /**
     * @return Collection
     */
    public function collection()
    {
        return Kuitansi::all();
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'NO',
            'Pegawai id',
            'Nomor Bukti',
            'Nomor MAK',
            'Nomor Surat Tugas',
            'Tanggal Surat Tugas',
            'Tahun Anggaran',
            'Lokasi Asal',
            'Lokasi Tujuan',
            'Jenis Angkutan',
            'Biaya Pergi',
            'Biaya Pulang',
            'Total PP',
            'Pajak Bandara',
            'Biaya Asal',
            'Bea Jarak',
            'Biaya Tujuan',
            'Total Transport',
            'Potongan',
            'Total Penginapan',
            'Total Harian',
            'Jumlah Hari',
            'Total Terima',
            'Biaya Penginapan',
            'Uang Harian',
            'Created at',
            'Updated at',
        ];
    }

    /**
     * @return array
     */
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();

                // Insert custom headers
                $sheet->insertNewRowBefore(1, 4);
                $sheet->mergeCells('A1:Z1');
                $sheet->setCellValue('A1', 'DAFTAR PEMBAYARAN PERJALANAN DINAS');
                $sheet->mergeCells('A2:Z2');
                $sheet->setCellValue('A2', 'Pelatihan Penggunaan dan Pemanfaatan Chromebook');
                $sheet->mergeCells('A3:Z3');
                $sheet->setCellValue('A3', 'SESUAI SURAT TUGAS 07/106.18/SMPN3/SS/III/2024 tanggal 25-03-2024');
                $sheet->mergeCells('A4:Z4');
                $sheet->setCellValue('A4', 'Kode Anggaran : DI.5634.QDC.011.052.DA.524119');

                // Apply bold and center alignment to custom headers
                $sheet->getStyle('A1:A4')->getFont()->setBold(true);
                $sheet->getStyle('A1:A4')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

                // Apply font size to header row
                $sheet->getStyle('A5:AA5')->getFont()->setSize(14);

                // Add border to header row
                $sheet->getStyle('A5:AA5')->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);

                // Calculate total rows and columns
                $totalRows = $sheet->getHighestRow();
                $totalColumns = $sheet->getHighestColumn();

                // Apply border to all cells in the sheet
                $sheet->getStyle('A1:' . $totalColumns . $totalRows)->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);

                // Center align all cells in the table
                $sheet->getStyle('A5:' . $totalColumns . $totalRows)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

                // Insert signature rows at the bottom
                $sheet->insertNewRowBefore($totalRows + 1, 4);
                $sheet->mergeCells('Y' . ($totalRows + 2) . ':Z' . ($totalRows + 2));
                $sheet->setCellValue('Y' . ($totalRows + 2), 'Idhil Nur Mansyur, SE');
                $sheet->mergeCells('Y' . ($totalRows + 3) . ':Z' . ($totalRows + 3));
                $sheet->setCellValue('Y' . ($totalRows + 3), 'NIP.19790522 200312 1 001');

                // Apply bold and center alignment to signature rows
                $sheet->getStyle('Y' . ($totalRows + 2) . ':Z' . ($totalRows + 3))->getFont()->setBold(true);
                $sheet->getStyle('Y' . ($totalRows + 2) . ':Z' . ($totalRows + 3))->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

                // Add border to the signature section
                $sheet->getStyle('Y' . ($totalRows + 2) . ':Z' . ($totalRows + 3))->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);

                // Format columns for Rupiah (Biaya Pergi, Biaya Pulang, Total PP, etc.)
                $rupiahColumns = ['K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'X', 'Y'];
                foreach ($rupiahColumns as $column) {
                    $sheet->getStyle($column . '6:' . $column . $totalRows)
                        ->getNumberFormat()
                        ->setFormatCode('#,##0');
                }
            },
        ];
    }
}
