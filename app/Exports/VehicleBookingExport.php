<?php

namespace App\Exports;

use App\Models\VehicleBooking;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class VehicleBookingExport implements
    FromCollection,
    WithHeadings,
    WithStyles,
    WithEvents
{
    protected $startDate;
    protected $endDate;

    public function __construct($startDate, $endDate)
    {
        $this->startDate = $startDate;
        $this->endDate   = $endDate;
    }

    public function collection(): Collection
    {
        return VehicleBooking::with(['vehicle','driver','approvals'])
            ->where(function ($q) {
                $q->where('tanggal_mulai', '<=', $this->endDate)
                  ->where('tanggal_selesai', '>=', $this->startDate);
            })
            ->get()
            ->map(function ($booking) {
                return [
                    $booking->booking_code,
                    $booking->vehicle->merek ?? '-',
                    $booking->driver->nama ?? '-',
                    $booking->tanggal_mulai,
                    $booking->tanggal_selesai,
                    optional($booking->approvals->last())->status ?? '-',
                ];
            });
    }

    public function headings(): array
    {
        return [
            'Kode Booking',
            'Kendaraan',
            'Driver',
            'Tanggal Mulai',
            'Tanggal Selesai',
            'Status',
        ];
    }

    // 🎨 Styling header
    public function styles(Worksheet $sheet)
    {
        return [
            1 => [
                'font' => [
                    'bold' => true,
                    'color' => ['argb' => 'FFFFFFFF'],
                ],
                'fill' => [
                    'fillType' => 'solid',
                    'startColor' => ['argb' => 'FF2C3E50'],
                ],
            ],
        ];
    }

    // 🎯 Styling lanjutan
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {

                $sheet = $event->sheet->getDelegate();
                $lastRow = $sheet->getHighestRow();

                // Auto size kolom
                foreach (range('A', 'F') as $col) {
                    $sheet->getColumnDimension($col)->setAutoSize(true);
                }

                // Border semua data
                $sheet->getStyle("A1:F{$lastRow}")
                    ->getBorders()
                    ->getAllBorders()
                    ->setBorderStyle('thin');

                // Center kolom tanggal & status
                $sheet->getStyle("D2:F{$lastRow}")
                    ->getAlignment()
                    ->setHorizontal('center');
            },
        ];
    }
}

