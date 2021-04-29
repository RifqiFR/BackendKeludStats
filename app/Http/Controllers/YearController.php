<?php

namespace App\Http\Controllers;

use App\Models\Year;
use Illuminate\Http\Request;

class YearController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['index']]);
    }

    public function index() {
        return Year::all();
    }

    public function store(Request $request) {
        $request->validate([
            "tahun" => "integer|unique:years,tahun"
        ]);

        $newYear = new Year($request->all());
        $newYear->save();
        return response()->json($newYear, 201);
    }


    public function destroy($tahun)
    {
        Year::destroy($tahun);

        return response(' ',204);
    }
}
