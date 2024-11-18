<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{


    public function index()
    {
        $sectores = ['Aluminio', 'Vidrio', 'Herrajes']; // Lista de sectores, podría venir de una base de datos
        return view('admin.index', compact('sectores'));
    }
}
