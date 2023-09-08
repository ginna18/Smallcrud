<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\planta;

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
    public function index(Request $request){

        //recuperar las plantas no borradas del usuario
        $plantas=$request->user()->plantas()->paginate(config('pagination.plantas',10));

        //recupear las plantas  borradas del usuario
        $deletedPlantas=$request->user()->plantas()->onlyTrashed()->get();


        //cargar la vista de home pasandole las plantas
        return view('home',['plantas'=>$plantas,'deletedPlantas'=>$deletedPlantas]);
    }
}
