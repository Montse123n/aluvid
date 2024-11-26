<?php
namespace App\Http\Controllers;

use App\Models\Sector;
use Illuminate\Http\Request;

class SectorController extends Controller
{
    public function index()
    {
        $sectores = Sector::all();
        return view('sectores.index', compact('sectores'));
    }

    public function show($id)
    {
        $sector = Sector::findOrFail($id);
        return view('sectores.show', compact('sector'));
    }
}
