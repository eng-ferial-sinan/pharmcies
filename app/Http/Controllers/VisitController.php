<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\visit;
class VisitController extends Controller
{
    //

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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $visits =visit::all();
        return view('admin.visit.index')->with('visits',$visits) ;
    }
}
