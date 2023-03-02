<?php

namespace App\Exports;

use App\Models\Dosen;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;

class DosenExport implements FromQuery, withMapping, withEvents, withHeadings
{
    public function query()
    {
        return Dosen::query();
    }

    public function map($dosen): array
    {
        return [
            $dosen->id,
            $dosen->Jurusan->nama ?? null,
            $dosen->nip,
            $dosen->nama,
            $dosen->tlp,
            $dosen->email,
            $dosen->alamat,
        ];
    }

    public function headings(): array
    {
        return [
            '#',
            'Jurusan',
            'NIP',
            'Nama',
            'Telepon',
            'Email',
            'Alamat',
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $event->sheet->getDelegate()->getStyle('A1:G1')
                ->getFill()
                ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                ->getStartColor()
                ->setARGB('10793F');
                $event->sheet->getDelegate()->getStyle('A1:G1')
                ->getFont()
                ->getColor()
                ->setARGB('FFFFFF');
                $event->sheet->getDelegate()->getColumnDimension('A')->setWidth(10);
                $event->sheet->getDelegate()->getColumnDimension('B')->setWidth(20);
                $event->sheet->getDelegate()->getColumnDimension('C')->setWidth(20);
                $event->sheet->getDelegate()->getColumnDimension('D')->setWidth(20);
                $event->sheet->getDelegate()->getColumnDimension('E')->setWidth(20);
                $event->sheet->getDelegate()->getColumnDimension('F')->setWidth(25);
                $event->sheet->getDelegate()->getColumnDimension('G')->setWidth(20);
            }
        ];
    }
}
