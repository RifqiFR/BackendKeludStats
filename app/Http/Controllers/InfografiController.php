<?php

namespace App\Http\Controllers;

use App\Http\Resources\InfografiResources;
use Illuminate\Http\Request;
use App\Models\Infografi;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;

class InfografiController extends Controller
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
    public function index()
    {
        return InfografiResources::collection(
            Infografi::orderBy('date', 'desc')->get()
        );
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
            "judul" => "required|string",
            "gambar" => "max:2000|mimes:jpeg,jpg,png,svg|required",
            "caption" => "required|string",
            "date" => "required"
        ]);

        if ($picture = $request->file("gambar")) {
            $pictureName = $picture->storePublicly(Infografi::$FOLDER_NAME, "public");
            $pictureName = str_replace(Infografi::$FOLDER_NAME . "/", '', $pictureName);
        }

        $infografi = new Infografi($request->all());
        $infografi->gambar = $pictureName;
        try {
            $infografi->date = new Carbon($request->date);
        } catch (\Throwable $th) {
            abort(422);
        }
        $infografi->save();

        return new InfografiResources($infografi);
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
    public function update(Request $request, Infografi $infografi)
    {
        $request->validate([
            "judul" => "required|string",
            "gambar" => "max:2000|mimes:jpeg,jpg,png,svg",
            "caption" => "required|string",
            "date" => "required|string"
        ]);

        if ($picture = $request->file("gambar")) {
            $lastpicture = public_path(Infografi::$FOLDER_NAME . "/" . $infografi->gambar);
            File::delete($lastpicture);
            $pictureName = $picture->storePublicly(Infografi::$FOLDER_NAME, "public");
            $pictureName = str_replace(Infografi::$FOLDER_NAME . "/", '', $pictureName);
            $infografi->gambar = $pictureName;
        }

        $infografi->judul = $request->judul;
        $infografi->caption = $request->caption;
        try {
            $infografi->date = new Carbon($request->date);
        } catch (\Throwable $th) {
            abort(422);
        }
        $infografi->save();

        return response()->json(new InfografiResources($infografi));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Infografi $infografi)
    {
        $lastpicture = public_path("storage\\" . Infografi::$FOLDER_NAME . "\\" . $infografi->gambar);
        File::delete($lastpicture);

        $infografi->delete();

        return response(null, 204);
    }
}
