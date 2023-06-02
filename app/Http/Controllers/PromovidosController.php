<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\clsDLPromovido;
use DB;
use File;

class PromovidosController extends Controller
{
	public function index()
     {
        ///return view('promovidos.index');
     }

	public function create()
     {
        return view('promovidos.create');
     }

}