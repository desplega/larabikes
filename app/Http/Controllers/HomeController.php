<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bike;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $bikes = $request->user()
            ->bikes()
            ->orderBy('id', 'DESC')
            ->paginate(config('pagination.bikes', 10));

        $deletedBikes = $request->user()
            ->bikes()
            ->onlyTrashed()
            ->get();

        return view('home', ['bikes' => $bikes, 'deletedBikes' => $deletedBikes]);
    }

    public function search(Request $request)
    {
        $request->validate([
            'marca' => 'max:16',
            'modelo' => 'max:16'
        ]);

        $marca = $request->input('marca', '');
        $modelo = $request->input('modelo', '');

        $bikes = $request->user()->bikes()
            ->where('marca', 'like', "%$marca%")
            ->where('modelo', 'like', "%$modelo%")
            ->paginate(10)
            ->appends(['marca' => $marca, 'modelo' => $modelo]); // To be used when method is GET

        // Add marca and model for POST method
        return view('home', ['bikes' => $bikes, 'marca' => $marca, 'modelo' => $modelo]);
    }
}
