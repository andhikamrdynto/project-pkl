<?php

namespace App\Imports;

use App\Models\Jurusan;
use App\Models\Mahasiswa;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class MahasiswaImport implements ToModel, WithHeadingRow
{
    private $jurusans;

    public function __construct()
    {
        $this->jurusans = Jurusan::select('id','nama')->get();
    }
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $jurusans = $this->jurusans->where('nama', $row['jurusan'])->first();
        return new Mahasiswa([
            'id_jurusan' => $jurusans->id ?? null,
            'nim' => $row['nim'],
            'nama' => $row['nama'],
            'tgl_lahir' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['tgl_lahir']),
            'jk' => $row['jk'],
            'no_tlp' => $row['no_tlp'],
            'alamat' => $row['alamat'],
        ]);
    }
}
