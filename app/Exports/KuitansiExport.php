<?php

namespace App\Exports;

use App\Models\Kuitansi;
use App\Models\PesertaKegiatan;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;

class KuitansiExport implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents
{
    public function collection()
    {
        $pesertaKegiatan = PesertaKegiatan::all(); // Fetch all participants
        $datas = [];

        $totalTransport = 0;
        $totalUangHarian = 0;
        $totalJumlahDiterima = 0;

        foreach ($pesertaKegiatan as $index => $peserta) {
            // Fetch kuitansi data based on peserta kegiatan
            $kuitansi = Kuitansi::where('pegawai_id', $peserta->id)->first();

            // Prepare data for export
            $transport = $kuitansi ? $kuitansi->total_transport : 0;
            $uangHarian = $kuitansi ? $kuitansi->uang_harian : 0;
            $jumlahDiterima = $kuitansi ? $kuitansi->total_terima : 0;

            $datas[] = [
                'No' => $index + 1,
                'Nama Lengkap' => $peserta->nama,
                'Instansi' => $peserta->instansi,
                'Asal - Tujuan' => $peserta->kabupaten . ' - ' . ($kuitansi ? $kuitansi->lokasi_tujuan : ''),
                'Transport' => $transport,
                'Uang Harian' => $uangHarian,
                'Jumlah Diterima' => $jumlahDiterima,
            ];

            // Add to totals
            $totalTransport += $transport;
            $totalUangHarian += $uangHarian;
            $totalJumlahDiterima += $jumlahDiterima;
        }

        // Add totals row
        $datas[] = [

            'No' => '',
            'Nama Lengkap' => '',
            'Instansi' => '',
            'Asal - Tujuan' => '',
            'Transport' => $totalTransport,
            'Uang Harian' => $totalUangHarian,
            'Jumlah Diterima' => $totalJumlahDiterima,
        ];

        return new Collection($datas);
    }

    public function headings(): array
    {
        return [
            'No',
            'Nama Lengkap',
            'Instansi',
            'Asal - Tujuan',
            'Transport',
            'Uang Harian',
            'Jumlah Diterima',
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();

                // Insert custom headers
                $sheet->insertNewRowBefore(1, 4);
                $sheet->mergeCells('A1:G1');
                $sheet->setCellValue('A1', 'DAFTAR PEMBAYARAN PERJALANAN DINAS');
                $sheet->mergeCells('A2:G2');
                $sheet->setCellValue('A2', 'Pelatihan Penggunaan dan Pemanfaatan Chromebook');
                $sheet->mergeCells('A3:G3');
                $sheet->setCellValue('A3', 'SESUAI SURAT TUGAS 07/106.18/SMPN3/SS/III/2024 tanggal 25-03-2024');
                $sheet->mergeCells('A4:G4');
                $sheet->setCellValue('A4', 'Kode Anggaran : DI.5634.QDC.011.052.DA.524119');

                // Apply bold and center alignment to custom headers
                $sheet->getStyle('A1:G4')->getFont()->setBold(true);
                $sheet->getStyle('A1:G4')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

                // Apply font size to header row
                $sheet->getStyle('A5:G5')->getFont()->setSize(14);

                // Add border to header row
                $sheet->getStyle('A5:G5')->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);

                // Calculate total rows and columns
                $totalRows = $sheet->getHighestRow();
                $totalColumns = $sheet->getHighestColumn();

                // Apply border to all cells in the sheet
                $sheet->getStyle('A1:' . $totalColumns . $totalRows)->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);

                // Center align all cells in the table
                $sheet->getStyle('A5:' . $totalColumns . $totalRows)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

                // Format columns for Rupiah (Transport, Uang Harian, Jumlah Diterima)
                $rupiahColumns = ['E', 'F', 'G'];
                foreach ($rupiahColumns as $column) {
                    $sheet->getStyle($column . '6:' . $column . $totalRows)
                        ->getNumberFormat()
                        ->setFormatCode('#,##0');
                }

                // Menyisipkan 6 baris baru sebelum baris tanda tangan
                $sheet->insertNewRowBefore($totalRows + 1, 6);
                $sheet->setCellValue('B' . ($totalRows), 'TOTAL');
                $sheet->mergeCells('B39:D39');
                // Menempatkan teks tanda tangan dan menggabungkan sel
                $sheet->setCellValue('F' . ($totalRows + 3), 'Makassar, 28 Juni 2024');
                $sheet->mergeCells('F' . ($totalRows + 3) . ':G' . ($totalRows + 3));

                $sheet->setCellValue('F' . ($totalRows + 4), '        ');
                $sheet->setCellValue('F' . ($totalRows + 5), '        ');
                $sheet->setCellValue('F' . ($totalRows + 6), '        ');
                $sheet->setCellValue('F' . ($totalRows + 7), '        ');
                $sheet->setCellValue('F' . ($totalRows + 8), '        ');

                $sheet->setCellValue('F' . ($totalRows + 9), 'Idhil Nur Mansyur, SE');
                $sheet->mergeCells('F' . ($totalRows + 9) . ':G' . ($totalRows + 9));

                $sheet->setCellValue('F' . ($totalRows + 10), 'NIP.19790522 200312 1 001');
                $sheet->mergeCells('F' . ($totalRows + 10) . ':G' . ($totalRows + 10));

                // Mengatur teks tanda tangan menjadi tebal dan rata tengah
                $sheet->getStyle('F' . ($totalRows + 2) . ':G' . ($totalRows + 10))->getFont()->setBold(true);
                $sheet->getStyle('F' . ($totalRows + 10) . ':G' . ($totalRows + 10))->getFont()->setUnderline(true);
                $sheet->getStyle('F' . ($totalRows + 2) . ':G' . ($totalRows + 10))->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

                // Menghapus border untuk bagian tanda tangan
                $sheet->getStyle('A' . ($totalRows + 1) . ':G' . ($totalRows + 7))->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_NONE);
            },
        ];
    }
}
