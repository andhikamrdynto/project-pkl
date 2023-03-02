<?php

namespace App\Imports;

use App\Models\Dosen;
use App\Models\Jurusan;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class DosenImport implements ToModel, WithHeadingRow
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
        $jurusan = $this->jurusans->where('nama', $row['jurusan'])->first();
        return new Dosen([
            'id_jurusan' => $jurusan->id ?? null,
            'nip' => $row['nip'],
            'nama' => $row['nama'],
            'tlp' => $row['tlp'],
            'email' => $row['email'],
            'alamat' => $row['alamat'],
        ]);
    }
}
