<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\IndikatorSatuan;
use App\Models\NilaiPerTahun;

class NilaiPerTahunController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['index', 'show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(IndikatorSatuan $indikatorsatuan)
    {
        return $indikatorsatuan->nilaipertahun;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            "tahun" => "required|integer",
            "nilai" => "required|max:999999999",
            "indikatorsatuan_id" => "required|integer",
        ]);

        try {
            $indikatorsatuan = IndikatorSatuan::findOrFail($request->indikatorsatuan_id);
            $nilaipertahun = new NilaiPerTahun($request->all());

            $indikatorsatuan->nilaipertahuns()->save($nilaipertahun);
            return $nilaipertahun;
        } catch (\Exception $e) {
            abort(422, $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, NilaiPerTahun $nilaipertahun)
    {
        $request->validate([
            "tahun" => "required|integer",
            "nilai" => "required|max:999999999",
            "indikatorsatuan_id" => "required|integer",
        ]);

        try {
            $indikatorsatuan = IndikatorSatuan::findOrFail($request->indikatorsatuan_id);

            $nilaipertahun->tahun = $request->tahun;
            $nilaipertahun->nilai = $request->nilai;
            $indikatorsatuan->nilaipertahuns()->save($nilaipertahun);

            return $nilaipertahun;
        } catch (\Exception $e) {
            abort(422, $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        NilaiPerTahun::destroy($id);

        return response(' ', 204);
    }
}
