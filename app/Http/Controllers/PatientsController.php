<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pasien;

class PatientsController extends Controller
{
    public function index()
    {
        # menggunakan model Student untuk select data
        $pasien = Pasien::All();
        if($pasien){
            $data = [
                'message' => 'Get All Pasien',
                'data' => $pasien
            ];
            return response()->json($data, 200);
        } else {
            $data = [
                'message' => 'Data Not Found',
            ]; 
            return response()->json($data, 404);
        }
        
    }

    public function store(Request $request)
    {
        
        $validasi = $request->validate([
            'nama' => 'required',
            'telepon' => 'required|numeric',
            'alamat' => 'required',
            'status' => 'required',
            'in_date_at' => 'required',
            'out_date_at' => 'required'
        ]);
        $pasien = Pasien::create($validasi);

        $data = [
            'message' => 'Pasien is created',
            'data' => $pasien
        ];
        return response()->json($data, 201);
        
    }

    public function show($id)
    {
        $pasien = Pasien::find($id);
        
        if ($pasien){
            $data = [
                'message' => 'Get Detail Data',
                'data' => $pasien
            ];
            return response()->json($data, 200);
        } else {
            $data = [
                'message' => 'Data Not Found',
            ];
            return response()->json($data, 404);
        }
    }
    public function update(Request $request, $id)
    {
        $pasien = Pasien::find($id);

        if ($pasien){
            $input = [
                'nama' => $request ->nama ?? $pasien->nama,
                'telepon' => $request->telepon ?? $pasien->telepon,
                'alamat' => $request->alamat ?? $pasien->alamat,
                'status' => $request->status ?? $pasien->status,
                'in_date_at' => $request->in_date_at ?? $pasien->in_date_at,
                'out_date_at' => $request->out_date_at ?? $pasien->out_date_at
            ];
            $pasien->update($input);

            $data = [
                'message' => 'Data is Update',
                'data' => $pasien
            ];
            return response()->json($data, 200);
        } else {
            $data = [
                'message' => 'Data Not Found',
            ];
            return response()->json($data, 404);
        }
    }
    public function destroy($id)
    {
        $pasien = Pasien::find($id);
        if($pasien) {
            $pasien->delete();
            $data = [
                'message' => 'Data is Deleted'
            ];
            return response()->json($data, 200);
        } else {
            $data = [
                'message' => 'Data Not Found'
            ];
            return response()->json($data, 404);
        }
    }
    public function search($nama)
    {
        $pasien = Pasien::where('nama', 'like', "%$nama%")->get();
        if($pasien->isNotEmpty()) {
            $data = [
                'message' => 'Get Nama',
                'data' => $pasien
            ];
            return response()->json($data, 200);
        } else {
            $data = [
                'message' => 'Data Not Found'
            ];
            return response()->json($data, 404);
        }
    }
    public function positive()
    {
        $pasien = Pasien::where('status', 'like', "%positive%")->get();
        $total= count($pasien);
        $data = [
            'message' => 'Get Positive Patients Resource',
            'total' => $total,
            'data' => $pasien
        ];
        return response()->json($data, 200);
    }
    public function recovered()
    {
        $pasien = Pasien::where('status', 'like', "%recovered%")->get();
        $total= count($pasien);
        $data = [
            'message' => 'Get Recovered Patients Resource',
            'total' => $total,
            'data' => $pasien
        ];
        return response()->json($data, 200);
    }
    public function dead()
    {
        $pasien = Pasien::where('status', 'like', "%dead%")->get();
        $total= count($pasien);
        $data = [
            'message' => 'Get Dead Patients Resource',
            'total' => $total,
            'data' => $pasien
        ];
        return response()->json($data, 200);
    }
}
