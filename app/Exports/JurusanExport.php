<?php

namespace App\Exports;

use App\Models\Jurusan;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;

class JurusanExport implements FromQuery, WithMapping, withEvents, withHeadings
{
    public function query()
    {
        return Jurusan::query();
    }

    public function map($jurusan): array
    {
        return [
            $jurusan->id,
            $jurusan->nama,
        ];
    }

    public function headings(): array
    {
        return [
            '#',
            'Nama',
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $event->sheet->getDelegate()->getStyle('A1:B1')
                ->getFill()
                ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                ->getStartColor()
                ->setARGB('10793F');
                $event->sheet->getDelegate()->getStyle('A1:B1')
                ->getFont()
                ->getColor()
                ->setARGB('FFFFFF');
                $event->sheet->getDelegate()->getColumnDimension('A')->setWidth(10);
                $event->sheet->getDelegate()->getColumnDimension('B')->setWidth(20);
            }
        ];
    }
}
