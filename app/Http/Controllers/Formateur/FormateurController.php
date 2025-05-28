<?php

namespace App\Http\Controllers\Formateur;

use App\Http\Controllers\Controller;
use App\Models\Categorie;
use App\Models\Chapitre;
use App\Models\Cour;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Pest\Plugins\Parallel\Support\CompactPrinter;
use PhpParser\Node\Stmt\Else_;

class FormateurController extends Controller
{
    public function index(){
        $cours= Cour::all();
        $coursCount = Cour::count();
        $chapitresCount = Chapitre::count(); 
        $inscripteurCount = User::find(Auth()->id())->inscriptionsApprenants->count();
        $lastCourse = Cour::orderBy('id', 'desc')->take(3)->get();
        return view('formateur.dashboard',compact('inscripteurCount','coursCount', 'chapitresCount','cours','lastCourse'));
    }
    

        // ----------------- Start Analytics------------------------
        public function showAnalytics(){
            return view('formateur.showAnalytics');
        }
        // ----------------- End Analytics------------------------
}
