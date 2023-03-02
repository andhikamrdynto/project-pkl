<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use App\Exports\MahasiswaExport;
use App\Imports\MahasiswaImport;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataJurusan = Jurusan::all();
        return view('auth.mahasiswa.index', compact('dataJurusan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getMahasiswa(Request $request)
    {
            $data = Mahasiswa::select('id','id_jurusan','nim','nama','tgl_lahir','jk','no_tlp','alamat');
            return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('jurusan', function($row){
                return $row->Jurusan->nama ?? NULL;
            })
            ->editColumn('tgl_lahir', function($row){
                return date('d-m-Y', strtotime($row->tgl_lahir));
            })
            ->filter(function($instance) use ($request) {
                if($request->get('id_jurusan')) {
                    $instance->where('id_jurusan', $request->get('id_jurusan'));
                }
                if($request->get('jk')) {
                    $instance->where('jk', $request->get('jk'));
                }
                if (!empty($request->get('search'))) {
                    $instance->where(function($w) use ($request){
                        $search = $request->get('search');
                        $w->orWhere('nim', 'LIKE', "%$search%")
                        ->orWhere('nama', 'LIKE', "%$search%")
                        ->orWhere('tgl_lahir', 'LIKE', "%$search%")
                        ->orWhere('no_tlp', 'LIKE', "%$search%")
                        ->orWhere('alamat', 'LIKE', "%$search%");
                    });
                }
            })
            ->addColumn('action', function($row) {
                $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editPost"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                </svg> Edit</a>';
                $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deletePost"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z"/>
                </svg> Delete</a>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
			'nim' => 'required',
            'nama' => 'required',
            'id_jurusan' => 'required',
            'jk' => 'required',
            'tgl_lahir' => 'required',
            'no_tlp' => 'required',
            'alamat' => 'required'
		]);
        $data = Mahasiswa::create($request->all());
        return $request;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $id = $request->get('id');
		$data = Mahasiswa::findOrFail($id);
		return $data;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $validate = $request->validate([
            'nim' => 'required',
            'nama' => 'required',
            'id_jurusan' => 'required',
            'jk' => 'required',
            'tgl_lahir' => 'required',
            'no_tlp' => 'required',
            'alamat' => 'required'
        ]);
        $data = Mahasiswa::where("id", $request->id)->firstOrFail();
        $data->update($validate);
        return $data;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    

    public function destroy(Request $request)
    {
        $id = $request->id;
		$data = Mahasiswa::find($id);
        return $data->delete();
    }

    public function export() 
    {
        return Excel::download(new MahasiswaExport, 'Mahasiswa.xlsx');
    }
    

    public function import(Request $request)
    {
        $this->validate($request, [
			'file' => 'required|mimes:csv,xls,xlsx'
		]);
		Excel::import(new MahasiswaImport,request()->file('file'));
        return back();
    }
}
