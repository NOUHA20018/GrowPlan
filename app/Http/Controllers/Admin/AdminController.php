<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cour;
use App\Models\User;
use App\Models\ActivityLog;
use App\Models\Chapitre;
use App\Models\Notification;
use App\Models\Quizze;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    // Dashboard principal
    public function dashboard()
    {
        $lastCours = Cour::latest()->limit(5)->get();
        $pendingCount = Cour::where('status', 'en attente')->count();
        $validatedCount = Cour::where('status', 'valide')->count();
        $refusedCount = Cour::where('status', 'refuse')->count();
        return view('admin.dashboard', compact('lastCours','pendingCount','validatedCount','refusedCount'));
    }

    public function notifications(){
        $notifications=Notification::orderBy('created_at', 'desc')->get();
        return view('admin.notification',compact('notifications'));
    }
    public function enAttenteCourses()
    {
        $enAttenteCourses = Cour::with('admin')
            ->where('status', 'en attente')->get();
            // ->latest()->paginate(10);

        return view('admin.dashboard', [
            'enAttenteCourses' => $enAttenteCourses,
            
        ]);
    }

    public function showCourse($id){
        $course = Cour::with('chapitres','quizzes','categorie','user','apprenants')->find($id);
        return view('admin.showCour',compact('course'));
    }

    public function showChapitre($id){
        $chapitre = Chapitre::find($id);
        return view('admin.showChapitre',compact('chapitre'));
    }
    public function showQuiz($id){
        $quiz = Quizze::with('questions','apprenants','cour','user','chapitre')->find($id);
        return view('admin.showQuiz',compact('quiz'));
    }

    // button validation
    public function validateCourse($id){
        $course = Cour::find($id);
        if (!$course) {
            return redirect()->back()->with('error', 'Cours introuvable.');
        }
        $course->admin_id = Auth()->id();
        $course->status = 'valide';
        $course->save();
        $admin = User::find(Auth::id());
        $admin->cours_valides += 1;
        $admin->save();
        return redirect()->back()->with('success', 'Le cours a été validé avec succès.');
    }
    // button refuse
    public function refuseCourse($id){
        $course = Cour::find($id);
        if (!$course) {
        return redirect()->back()->with('error', 'Cours introuvable.');
        }
        $course->admin_id = Auth()->id();
        $course->status = 'refuse';
        $course->save();
        $user = Auth()->id;
        $user->cours_refuses +=1;
        $user->save();
        return redirect()->back()->with('success', 'Le cours a été refusé avec succès.');

    }

    // Courses valides
     public function validesCourses()
    {
        $validesCourses = Cour::with('admin')
            ->where('status', 'valide')->get();
            // ->latest()->paginate(10);
        return view('admin.dashboard', [
            'validesCourses' => $validesCourses,
        ]);
    }
    // Annule validation  ou refusion 
    public function enAttenteCourse($id)
     {
        $course = Cour::find($id);
        if (!$course) {
            return redirect()->back()->with('error', 'Cours introuvable.');
        }
        $course->admin_id = Auth()->id();
        $course->status = 'en attente';
        $course->save();
        return redirect()->back()->with('success', 'Le cours a été en attente.');

    }

    // Courses refusé
     public function refusesCourse()
    {
        $refusesCourses = Cour::with('admin')
            ->where('status', 'refuse')->get();
            // ->latest()->paginate(10);
        return view('admin.dashboard', [
            'refusesCourses' => $refusesCourses,
        ]);
    }

    // formateurs
    public function formateurs(){
        $formateurs = User::where('role','2')
       ->withCount([
            'cours',
            'formateur_cours_valides as cours_valides_count',
            'formateur_cours_refuses as cours_refuse_count', 
            'inscriptionsApprenants as coursInscrits_count',
            'formateurQuizzes as formateurQuizzes_count' ,
            'categories',
        ])
        ->with(['quizzes','paiements'])
        ->get()
        ->map(function($formateur) {
            $formateur->total_earnings = $formateur->total_earnings ?? $formateur->paiements->sum('montant');
            return $formateur;
        });
        return view('admin.dashboard',compact('formateurs'));
    }

    public function deleteFormateur($id){
        $formateur = User::where('role',2)->find($id);
        $formateur->delete();
        return redirect()->back()->with('success', 'Le formateur a été bien supprimer.');
       
    }
}