<?php

namespace App\Exports;

use App\Models\MataKuliah;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;

class MatakuliahExport implements FromQuery, WithMapping, withHeadings, withEvents
{
    public function query()
    {
        return MataKuliah::query();
    }

    public function map($mk): array
    {
        return [
            $mk->id,
            $mk->kode_mk,
            $mk->nama_mk,
            $mk->sks,
        ];
    }

    public function headings(): array
    {
        return [
            '#',
            'Kode MK',
            'Nama MK',
            'SKS',
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $event->sheet->getDelegate()->getStyle('A1:D1')
                ->getFill()
                ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                ->getStartColor()
                ->setARGB('10793F');
                $event->sheet->getDelegate()->getStyle('A1:D1')
                ->getFont()
                ->getColor()
                ->setARGB('FFFFFF');
                $event->sheet->getDelegate()->getColumnDimension('A')->setWidth(10);
                $event->sheet->getDelegate()->getColumnDimension('B')->setWidth(20);
                $event->sheet->getDelegate()->getColumnDimension('C')->setWidth(20);
                $event->sheet->getDelegate()->getColumnDimension('D')->setWidth(15);
            }
        ];
    }
}
