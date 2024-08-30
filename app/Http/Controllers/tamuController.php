<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class tamuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data_index = DB::table('tamu')->paginate(5);
        return view('buku_tamu', ['tampil_data' => $data_index]);
    }

    function fetch_data(Request $request)
    {
        if($request->ajax())
        {
            $sort_by = $request->get('sortby');
            $sort_type = $request->get('sorttype');
                  $query = $request->get('query');
                  $query = str_replace(" ", "%", $query);
            $data_index = DB::table('tamu')
                ->where('nama_tamu', 'LIKE', '%'.$query.'%')
                ->paginate(5);
            return view('buku_tamu_tabel', ['tampil_data' => $data_index])->render();
        }
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'nama_tamu' => 'required',
            'no_telepon'   => 'required|size:12',
            'nama_instansi'   => 'required',
            'keperluan'   => 'required',
            'bertemu_dengan'   => 'required',
            'tanggal_bertamu'   => 'required',
            'waktu'   => 'required'
        ],[
            'required' => 'Inputan Ada Yang Kosong',
            'size' => 'Panjang Nomor Telepon Harus 12 Angka'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $data_store = DB::table('tamu')->insert([
            'nama_tamu'     => $request->nama_tamu,
            'no_telepon'   => $request->no_telepon,
            'nama_instansi'   => $request->nama_instansi,
            'keperluan'   => $request->keperluan,
            'bertemu_dengan'   => $request->bertemu_dengan,
            'tanggal_bertamu'   =>$request->tanggal_bertamu,
            'waktu'   => $request->waktu
        ]);
        return Response::json($data_store);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $where = array('id' => $id);
        $data_edit  = DB::table('tamu')->where($where)->first();                       
        return Response::json($data_edit);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(),[
            'nama_tamu' => 'required',
            'no_telepon'   => 'required|size:12',
            'nama_instansi'   => 'required',
            'keperluan'   => 'required',
            'bertemu_dengan'   => 'required',
            'tanggal_bertamu'   => 'required',
            'waktu'   => 'required'
        ],[
            'required' => 'Inputan Ada Yang Kosong',
            'size' => 'Panjang Nomor Telepon Harus 12 Angka'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $ID = $request->id;
        $data = [
            'nama_tamu'     => $request->nama_tamu,
            'no_telepon'   => $request->no_telepon,
            'nama_instansi'   => $request->nama_instansi,
            'keperluan'   => $request->keperluan,
            'bertemu_dengan'   => $request->bertemu_dengan,
            'tanggal_bertamu'   => $request->tanggal_bertamu,
            'waktu'   => $request->waktu
        ];
        $data_update = DB::table('tamu')->where('id', $ID)->update($data);
        return Response::json($data_update);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data_destroy = DB::table('tamu')->where('id', $id)->delete();
        return Response::json($data_destroy);
    }
}
