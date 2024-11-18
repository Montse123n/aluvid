<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductTypeController extends Controller
{
    public function index($sector)
    {
        $tipos = []; // Obtener tipos de producto por sector de la base de datos
        return view('admin.tipos.index', compact('tipos', 'sector'));
    }

    public function create($sector)
    {
        return view('admin.tipos.create', compact('sector'));
    }

    public function store(Request $request, $sector)
    {
        // Lógica para crear un tipo de producto
        return redirect()->route('admin.showTypes', $sector);
    }

    public function edit($sector, $tipo)
    {
        return view('admin.tipos.edit', compact('sector', 'tipo'));
    }

    public function update(Request $request, $sector, $tipo)
    {
        // Lógica para actualizar un tipo de producto
        return redirect()->route('admin.showTypes', $sector);
    }

    public function destroy($sector, $tipo)
    {
        // Lógica para eliminar un tipo de producto
        return redirect()->route('admin.showTypes', $sector);
    }
}
