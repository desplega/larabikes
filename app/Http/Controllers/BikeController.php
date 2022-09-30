<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bike;

class BikeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bikes = Bike::orderBy('id', 'DESC')->paginate(10);
        $total = Bike::count();

        return view('bikes.list', ['bikes' => $bikes, 'total' => $total]);
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
    public function store(Request $request)
    {
        $request->validate([
            'marca' => 'required|max:255',
            'modelo' => 'required|max:255',
            'precio' => 'required|numeric',
            'kms' => 'required|integer',
            'matriculada' => 'sometimes',
        ]);

        $bike = Bike::create($request->all());

        return redirect()->route('bikes.show', $bike->id)
            ->with('success', "Moto $bike->marca $bike->modelo añadida satisfactoriamente");
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
    public function edit(Bike $bike)
    {
        return view('bikes.update', ['bike' => $bike]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bike $bike)
    {
        $request->validate([
            'marca' => 'required|max:255',
            'modelo' => 'required|max:255',
            'precio' => 'required|numeric',
            'kms' => 'required|integer',
            'matriculada' => 'sometimes',
        ]);

        //$request->mergeIfMissing(['matriculada' => 0]); // or use the array '+' as shown below:
        $bike->update($request->all() + ['matriculada' => 0]);

        return back()->with('success', "Moto $bike->marca $bike->modelo actualizada");
    }

    /**
     * Show the form to remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Bike $bike)
    {
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

        $bike->delete();

        return redirect('bikes')
            ->with('success', "Moto $bike->marca $bike->modelo eliminada");
    }

    public function search(Request $request)
    {
        $request->validate([
            'marca' => 'required|max:16',
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
}
