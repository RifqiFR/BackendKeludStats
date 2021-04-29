<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\IndikatorSatuan;
use App\Models\Year;
use App\Models\NilaiPerTahun;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

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
    public function index(Request $request, IndikatorSatuan $indikatorsatuan)
    {
        $year = $request->year;
        $indikatorsatuanId = $request->indikatorsatuan;

        return NilaiPerTahun::where("tahun", "=", $year)
                ->where("indikator_satuan_id", "=", $indikatorsatuanId)
                ->get();
        // $indikatorsatuan->nilaiPerTahuns;
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
            "nilai" => "required|max:999999999",
            "tahun" => "required|integer",
            "indikator_satuan_id" => "required|integer"
        ]);

        try {
            $nilaipertahuns = NilaiPerTahun::where([
                ["tahun", $request->tahun],
                ["indikator_satuan_id", $request->indikator_satuan_id]
            ])->get();

            if(!$nilaipertahuns->isEmpty()){
                throw(new \Exception("Nilai per tahun yang sama sudah ada di database"));
            }

            $indikatorsatuan = IndikatorSatuan::findOrFail($request->indikator_satuan_id);
            $nilaipertahun = new NilaiPerTahun($request->all());

            $year = Year::findOrFail($request->tahun);

            $nilaipertahun->year()->associate($year);
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
            "nilai" => "required|max:999999999"
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
    public function destroy($tahun, $indikatorSatuanId)
    {
        NilaiPerTahun::where([
            ["tahun", $tahun],
            ["indikator_satuan_id", $indikatorSatuanId]
        ])->delete();

        return response(' ', 204);
    }
}
