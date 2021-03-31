<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subindikator;
use App\Models\Indikator;

class SubindikatorController extends Controller
{
    public function __construct() {
        $this->middleware('auth:api', ['except' => ['index', 'show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Indikator $indikator)
    {
        return $indikator->subindikators;
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
            "nama_subindikator" => "required|string",
            "indikator_id" => "required|integer",
        ]);

        try {
            $indikator = Indikator::findOrFail($request->indikator_id);
            $subindikator = new Subindikator($request->all());

            $indikator->subindikators()->save($subindikator);
            return $subindikator;
        }catch(\Exception $e){
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
    public function update(Request $request, Subindikator $subindikator)
    {
        $request->validate([
            "nama_subindikator" => "required|string",
            "indikator_id" => "required|integer",
        ]);

        try {
            $indikator = Indikator::findOrFail($request->indikator_id);

            $subindikator->nama_subindikator = $request->nama_subindikator;
            $indikator->subIndikators()->save($subindikator);

            return $subindikator;
        }catch(\Exception $e){
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
        Subindikator::destroy($id);
        
        return response(' ',204);
    }
}
