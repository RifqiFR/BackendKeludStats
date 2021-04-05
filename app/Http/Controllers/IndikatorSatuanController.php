<?php

namespace App\Http\Controllers;

use App\Http\Resources\IndikatorSatuanResource;
use Illuminate\Http\Request;
use App\Models\Subindikator;
use App\Models\IndikatorSatuan;

class IndikatorSatuanController extends Controller
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
    public function index(Subindikator $subindikator)
    {
        return IndikatorSatuanResource::collection($subindikator->indikatorSatuans);
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
            "nama_tabel_indikator" => "required|string",
            "satuan" => "required|string",
            "subindikator_id" => "required|integer",
        ]);

        try {
            $subindikator = Subindikator::findOrFail($request->subindikator_id);
            $indikatorsatuan = new IndikatorSatuan($request->all());

            $subindikator->indikatorsatuans()->save($indikatorsatuan);
            return $indikatorsatuan;
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
    public function update(Request $request, IndikatorSatuan $indikatorsatuan)
    {
        $request->validate([
            "nama_tabel_indikator" => "required|string",
            "satuan" => "required|string",
            "subindikator_id" => "required|integer",
        ]);

        try {
            $subindikator = Subindikator::findOrFail($request->subindikator_id);

            $indikatorsatuan->nama_tabel_indikator = $request->nama_tabel_indikator;
            $indikatorsatuan->satuan = $request->satuan;
            $subindikator->indikatorSatuans()->save($indikatorsatuan);

            return $indikatorsatuan;
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
        IndikatorSatuan::destroy($id);

        return response(' ', 204);
    }
}
