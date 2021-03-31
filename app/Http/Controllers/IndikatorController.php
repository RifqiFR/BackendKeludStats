<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Indikator;

class IndikatorController extends Controller
{
    public function __construct() {
        $this->middleware('auth:api', ['except' => ['index', 'show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Indikator::all();
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
            "nama_indikator" => "required|string"
        ]);
        
        return Indikator::create($request->all());
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
    public function update(Request $request, Indikator $indikator)
    {
        $request->validate([
            "nama_indikator" => "required|string"
        ]);

        $indikator->nama_indikator = $request->nama_indikator; 
        $indikator->save();

        return $indikator;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Indikator::destroy($id);
        
        return response(' ',204);
    }
}
