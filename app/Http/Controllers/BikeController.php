<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\BikeRequest;
use App\Http\Requests\BikeUpdateRequest;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Gate;
use App\Models\Bike;

class BikeController extends Controller
{
    public function __construct()
    {
        // Ponemos el middleware auth a todos los métodos excepto algunos
        $this->middleware('verified')->except('index', 'show', 'search'); // 'verified' is more restrictive than 'auth'

        $this->middleware('password.confirm')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bikes = Bike::orderBy('id', 'DESC')->paginate(10);

        return view('bikes.list', ['bikes' => $bikes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('bikes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BikeRequest $request)
    {
        $datos = $request->only(['marca', 'modelo', 'precio', 'kms', 'matriculada']);
        $datos['imagen'] = null;
        $datos['matricula'] = $request->has('matriculada') ? strtoupper($request->input('matricula')) : null;
        $datos['color'] = strtoupper($request->input('color')) ?? null;
        $datos['user_id'] = $request->user()->id;

        if ($request->hasFile('imagen')) {
            $ruta = $request->file('imagen')->store(config('filesystems.bikesImageDir'));
            $datos['imagen'] = pathinfo($ruta, PATHINFO_BASENAME);
        }

        $bike = Bike::create($datos);

        return redirect()->route('bikes.show', $bike->id)
            ->with('success', "Moto $bike->marca $bike->modelo añadida satisfactoriamente")
            ->cookie('lastInsertID', $bike->id, 0);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Bike $bike)
    {
        return view('bikes.show', ['bike' => $bike]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Bike $bike)
    {
        if ($request->user()->cant('delete', $bike))
            abort(403, 'No puedes editar una moto que no es tuya.');

        $updated_counter = $request->cookie('updated_counter') ?? 0;
        return view('bikes.update', ['bike' => $bike, 'updated_counter' => $updated_counter]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BikeUpdateRequest $request, Bike $bike)
    {
        if ($request->user()->cant('delete', $bike))
            abort(403, 'No puedes editar una moto que no es tuya.');

        $datos = $request->only(['marca', 'modelo', 'precio', 'kms']);

        $datos['matriculada'] = $request->has('matriculada') ? 1 : 0;
        $datos['matricula'] = $request->has('matriculada') ? strtoupper($request->input('matricula')) : null;
        $datos['color'] = strtoupper($request->input('color')) ?? null;

        if ($request->hasFile('imagen')) {
            if ($bike->imagen)
                $aBorrar = config('filesystems.bikesImageDir') . '/' . $bike->imagen;
            $imagenNueva = $request->file('imagen')->store(config('filesystems.bikesImageDir'));
            $datos['imagen'] = pathinfo($imagenNueva, PATHINFO_BASENAME);
        }

        if ($request->filled('eliminarimagen') && $bike->imagen) {
            $aBorrar = config('filesystems.bikesImageDir') . '/' . $bike->imagen;
            $datos['imagen'] = null;
        }

        if ($bike->update($datos)) {
            if (isset($aBorrar))
                Storage::delete($aBorrar);
        } else {
            if (isset($imagenNueva))
                Storage::delete($imagenNueva);
        }

        $updated_counter = $request->cookie('updated_counter') ?? 0;
        Cookie::queue('updated_counter', ++$updated_counter);

        return back()->with('success', "Moto $bike->marca $bike->modelo actualizada");
    }

    /**
     * Show the form to remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request, Bike $bike)
    {
        if ($request->user()->cant('delete', $bike))
            abort(403, 'No puedes borrar una moto que no es tuya.');

        return view('bikes.delete', ['bike' => $bike]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Bike $bike)
    {
        if (!$request->hasValidSignature())
            abort(401, 'La firma de la URL no se pudo validar');

        if ($request->user()->cant('delete', $bike))
            abort(403, 'No puedes borrar una moto que no es tuya.');

        $bike->delete();

        // Remove bike image
        if ($bike->imagen != null) {
            $path = config('filesystems.bikesImageDir') . '/' . $bike->imagen;
            Storage::delete($path);
        }

        return redirect('bikes')
            ->with('success', "Moto $bike->marca $bike->modelo eliminada");
    }

    public function search(Request $request)
    {
        $request->validate([
            'marca' => 'max:16',
            'modelo' => 'max:16'
        ]);

        $marca = $request->input('marca', '');
        $modelo = $request->input('modelo', '');

        $bikes = Bike::where('marca', 'like', "%$marca%")
            ->where('modelo', 'like', "%$modelo%")
            ->paginate(10)
            ->appends(['marca' => $marca, 'modelo' => $modelo]); // To be used when method is GET

        // Add marca and model for POST method
        return view('bikes.list', ['bikes' => $bikes, 'marca' => $marca, 'modelo' => $modelo]);
    }

    public function editLast()
    {
        if (!Cookie::has('lastInsertID'))
            return redirect()->route('bikes.create');

        $id = Cookie::get('lastInsertID');
        return redirect()->route('bikes.edit', $id);
    }

    /**
     * Use white for text on light colors.
     * Light color is considered when at least to main colors are high (above '0xA0')
     */
    public static function whiteText($color)
    {
        $red = hexdec(substr($color, 1, 2));
        $green = hexdec(substr($color, 3, 2));
        $blue = hexdec(substr($color, 5, 2));

        $luminance = $red * 0.299 + $green * 0.587 + $blue * 0.114;

        return ($luminance > 186 ? '' : 'color: white;');
    }
}
