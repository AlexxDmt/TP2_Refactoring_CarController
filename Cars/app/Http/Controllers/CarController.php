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
     * @return Response
     */
    public function store()
    {
        $car = new Car();
        $car->title = request('nom');
        $car->description = request('description');
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
        return view('cars.show', ['car' => Car::find($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $car = Car::find($id);

        return view('cars.edit', compact('car'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param int $id
     * @return Response
     */
    public function update($id)
    {
        $car = Car::find($id);
        $car->title = request('title');
        $car->description = request('description');
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
        $car = Car::find($id);
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
     * Retourne le nombre de voitures françaises en BDD
     */
    public function count_fr()
    {
        return Car::where('country', '=', 'FR')->count();
    }

    /**
     * Retourne le nombre de voitures étrangères en BDD
     */
    public function count_strangers()
    {
        return Car::where('country', '!=', 'FR')->count();
    }

    /**
     * Retourne le nombre de voitures belges en BDD, à garder pour une éventuelle réutilisation
     */
    // public function count_belgium()
    // {
    //     return Car::where('country', '=', 'BE')->count();
    // }
}
