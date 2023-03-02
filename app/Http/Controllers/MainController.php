<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Jurusan;
use App\Models\Mahasiswa;
use App\Models\MataKuliah;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index() {
        $dataJurusan = Jurusan::all();
        $dataMahasiswa = Mahasiswa::all();
        $dataDosen = Dosen::all();
        $dataMatakuliah = MataKuliah::all();
        return view('auth.dashboard', compact('dataJurusan','dataMahasiswa','dataDosen','dataMatakuliah'));
    }
}
