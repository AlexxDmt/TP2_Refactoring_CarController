<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;

class CarController extends Controller
{
    public $title = "Parc automobile";

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $cars = Car::all();
        $frenchCars = $cars->where('country', 'FR')->count(); // retourne le décompte des voitures françaises uniquement
        $title = $this->title;

        return view('cars.index', compact('cars', 'frenchCars', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('cars.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
        ]);

        $car = new Car();
        $car->title = $validatedData['nom'];
        $car->description = $validatedData['description'];
        $car->save();

        return redirect('/cars');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return view('cars.show', ['car' => Car::findOrFail($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $car = Car::findOrFail($id);

        return view('cars.edit', compact('car'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id id of the resource to update
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
        ]);

        $car = Car::findOrFail($id);
        $car->title = $validatedData['title'];
        $car->description = $validatedData['description'];
        $car->save();

        return redirect('/cars');
    }

    /**
     * Destroy the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        $car = Car::findOrFail($id);
        $car->delete();

        return redirect('/cars');
    }

    /**
     * Retourne le nombre de cars en BDD
     */
    public function count()
    {
        return Car::count();
    }

    /**
     * Retourne le nombre de voitures d'une nationalité donnée en BDD
     * @param string $nationality
     * @return int
     */
    public function count_nationality($nationality)
    {
        return Car::where('country', '=', $nationality)->count();
    }
}
