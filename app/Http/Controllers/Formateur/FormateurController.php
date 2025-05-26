<?php

namespace App\Http\Controllers\Formateur;

use App\Http\Controllers\Controller;
use App\Models\Categorie;
use App\Models\Chapitre;
use App\Models\Cour;
use Illuminate\Http\Request;
use Pest\Plugins\Parallel\Support\CompactPrinter;
use PhpParser\Node\Stmt\Else_;

class FormateurController extends Controller
{
    public function index(){
        $cours= Cour::all();
        $coursCount = Cour::count();
        $chapitresCount = Chapitre::count(); 
        $lastCourse = Cour::orderBy('id', 'desc')->take(5)->get();
        return view('formateur.dashboard',compact('coursCount', 'chapitresCount','cours','lastCourse'));
    }

        // ----------------- Start Analytics------------------------
        public function showAnalytics(){
            return view('formateur.showAnalytics');
        }
        // ----------------- End Analytics------------------------
}
