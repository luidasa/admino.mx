<?php

namespace App\Http\Controllers;

use App\Models\Condominio;
use Illuminate\Http\Request;

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
    public function index($id = null)
    {
        // Devuelve los datos del Condominio.

        if ($id ==null) {
            return view('panel');
        }
        $condominio = Condominio::find($id);
        if ($condominio == null) {
            return view('panel')->with('alert-info', 'Se actualizo la nueva ');
        } else {
            return view('panel', ['condominio' => $condominio]);
        }
    }

    public function postIndex(Request $request, $id) {

    }
}
