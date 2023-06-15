<?php

namespace App\Http\Controllers;

use App\Models\Sampah;
use Illuminate\Http\Request;
use App\Helpers\ApiFormatter;

class SampahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sampahs = Sampah::all();

        if ($sampahs) {
            return ApiFormatter::createApi(200, 'success', $sampahs);
        } else {
            return ApiFormatter::createApi(400, 'failed');
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
        try {
            if($request->total_karung_sampah <= 3){
                $kriteria = 'standar';
            }else{
                $kriteria = 'collapse';
            }

            $sampahs = Sampah::create([
                'kepala_keluarga' => $request->kepala_keluarga,
                'no_rumah' => $request->no_rumah,
                'rt_rw' => $request->rt_rw,
                'total_karung_sampah' => $request->total_karung_sampah,
                'kriteria' => $kriteria,
                'tanggal_pengangkutan' => $request->tanggal_pengangkutan,
            ]);

            if ($getDataSaved) {
                return apiFormatter::createApi(200, 'success', $getDataSaved);
            } else {
                return apiFormatter::createApi(400, 'failed');
            }
        } catch (Exception $error) {
            return ApiFormatter::createApi(400, 'failed', $error->getMessage());
            }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $sampahs = Sampah::find($id);
            if ($sampahs) {
                return apiFormatter::createApi(200, 'success', $sampahs);
            } else {
                return apiFormatter::createApi(400, 'failed');
            }
        } catch (Exception $error) {
            return apiFormatter::createApi(400, 'error', $error->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sampah $sampah)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        try {
            if($request->total_karung_sampah <= 3){
                $kriteria = 'standar';
            }else{
                $kriteria = 'collapse';
            }

            $sampahs = Sampah::find($id);
            $sampahs->update([
                'kepala_keluarga' => $request->kepala_keluarga,
                'no_rumah' => $request->no_rumah,
                'rt_rw' => $request->rt_rw,
                'total_karung_sampah' => $request->total_karung_sampah,
                'kriteria' => $kriteria,
                'tanggal_pengangkutan' => $request->tanggal_pengangkutan,
            ]);

            $sampahs = Sampah::where('id', $sampahs->id)->first();
            if ($sampahs) {
                return apiFormatter::createApi(200, 'success', $sampahs);
            } else {
                return apiFormatter::createApi(400, 'failed');
            }
        } catch (Exception $error) {
            return apiFormatter::createApi(400, 'error', $error->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $sampahs = Sampah::find($id);
            $cekBerhasil = $sampahs->delete();
            if ($cekBerhasil) {
                return apiFormatter::createApi(200, 'success', 'Data Terhapus!');
            } else {
                return apiFormatter::createApi(400, 'failed');
            }
        } catch (Exception $error) {
            return apiFormatter::createApi(400, 'error', $error->getMessage());
        }
    }

    public function trash()
    {
        try {
            $sampahs = Sampah::onlyTrashed()->get();
            if ($sampahs) {
                return apiFormatter::createApi(200, 'success', $sampahs);
            } else {
                return apiFormatter::createApi(400, 'failed');
            }
        } catch (Exception $error) {
            return apiFormatter::createApi(400, 'error', $error->getMessage());
        }
    }

    public function restore($id)
    {
        try {
            $sampahs = Sampah::onlyTrashed()->where('id', $id);
            $sampahs->restore();
            $dataRestore = Sampah::where('id', $id)-first();
            if ($dataRestore) {
                return apiFormatter::createApi(200, 'success', $dataRestore);
            } else {
                return apiFormatter::createApi(400, 'failed');
            }
        } catch (Exception $error) {
            return apiFormatter::createApi(400, 'error', $error->getMessage());
        }
    }

    public function permanentDelete($id)
    {
        try {
            $sampahs = Sampah::onlyTrashed()->where('id', $id);
            $proses = $sampahs->forceDelete();
            if ($proses) {
                return apiFormatter::createApi(200, 'success', 'Data Dihapus Permanen!');
            } else {
                return apiFormatter::createApi(400, 'failed');
            }
        } catch (Exception $error) {
            return apiFormatter::createApi(400, 'error', $error->getMessage);
        }
    }
}