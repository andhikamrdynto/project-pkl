<?php

namespace App\Exports;

use App\Models\Mahasiswa;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;

class MahasiswaExport implements FromQuery, WithMapping, withHeadings, withEvents
{
    public function query()
    {
        return Mahasiswa::query();
    }

    public function map($dosen): array
    {
        return [
            $dosen->id,
            $dosen->Jurusan->nama ?? null,
            $dosen->nim,
            $dosen->nama,
            $dosen->tgl_lahir,
            $dosen->jk,
            $dosen->no_tlp,
            $dosen->alamat,
        ];
    }

    public function headings(): array
    {
        return [
            '#',
            'Jurusan',
            'NIM',
            'Nama',
            'Tgl Lahir',
            'JK',
            'No Telepon',
            'Alamat',
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $event->sheet->getDelegate()->getStyle('A1:H1')
                ->getFill()
                ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                ->getStartColor()
                ->setARGB('10793F');
                $event->sheet->getDelegate()->getStyle('A1:H1')
                ->getFont()
                ->getColor()
                ->setARGB('FFFFFF');
                $event->sheet->getDelegate()->getColumnDimension('A')->setWidth(10);
                $event->sheet->getDelegate()->getColumnDimension('B')->setWidth(20);
                $event->sheet->getDelegate()->getColumnDimension('C')->setWidth(20);
                $event->sheet->getDelegate()->getColumnDimension('D')->setWidth(20);
                $event->sheet->getDelegate()->getColumnDimension('E')->setWidth(20);
                $event->sheet->getDelegate()->getColumnDimension('F')->setWidth(20);
                $event->sheet->getDelegate()->getColumnDimension('G')->setWidth(20);
                $event->sheet->getDelegate()->getColumnDimension('H')->setWidth(20);
            }
        ];
    }
}
