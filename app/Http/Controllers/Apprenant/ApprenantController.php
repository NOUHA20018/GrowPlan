<?php

namespace App\Http\Controllers\Apprenant;

use App\Http\Controllers\Controller;
use App\Models\Categorie;
use App\Models\Cour;
use Illuminate\Http\Request;

class ApprenantController extends Controller
{
    public function dashboard(){
        return view('apprenant.dashboard');
    }
   public function index(Request $request)
    {
        $categories = Categorie::where('status', 'active')->get();
        $coursesQuery = Cour::query();   
        if ($request->has('categorie') && $request->categorie != 'all') {
            $coursesQuery->where('categorie_id', $request->categorie);
        }
        $cours = $coursesQuery->with('categorie')->paginate(9);
        
        return view('apprenant.index', compact('cours', 'categories'));
    }
}
