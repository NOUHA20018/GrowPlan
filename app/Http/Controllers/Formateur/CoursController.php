<?php

namespace App\Http\Controllers\Formateur;

use App\Http\Controllers\Controller;
use App\Mail\NewCourseCreated;
use App\Models\Categorie;
use App\Models\Chapitre;
use App\Models\Cour;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class CoursController extends Controller
{
    
    public function courses(){
        $cours = Cour::all();
        return view('formateur.courses',compact('cours'));
    }
    public function showCour(Cour $cour ,$id){
        $cour = Cour::with('apprenants','chapitres')->find($id);
        $cour->load(['apprenant_cours' => function($query) use ($cour) {
            $query->withPivot('progression');
        }]);
        
        return view('formateur.showCour',compact('cour'));
    }
    
       public function  deleteApprenant($id){
        $apprenant = User::where('role',3)->find($id);
        $apprenant->coursInscrits()->detach() ;
        return redirect()->back()->with('success', 'L\'apprenant a été désinscrit de tous les cours.');
       }



    public function createCourse(){
        $categories = Categorie::all()->where('status','=','active');
        $from='';
        return view('formateur.addCourses',compact('categories','from'));
    }
    public function storeCourse(Request $req){
        $validatedData = $req->validate([
            'title' => ['required','string','min:2'],
            'description' => ['nullable','string','min:4'],
            'prix' => ['required','numeric'],
            'date_creation' => ['nullable','date'],
            'categorie_id'=> ['required'],
            'image' =>['image','nullable','mimes:jpg,bmp,png']
        ]);
        
        $imagename= '';
        $hasfile = $req->hasFile('image');
        if($hasfile){ 
            $imagename=$req->file('image')->getClientOriginalName();
            $validatedData['image']=$imagename;
        }
        $validatedData['date_creation'] = $validatedData['date_creation'] ?? now()->toDateString();
        $validatedData['user_id'] = auth()->id();
        $cour = Cour::create($validatedData);
        $image_path = public_path('Cours/'.$cour->id);
        if($hasfile){
            $req->file('image')->move($image_path,$cour->image);
        }
        $admin = User::where('role', 1)->first();
        Mail::to($admin->email)->send(new NewCourseCreated($cour));
        $userId =$admin->id;
       Notification::create([
            'user_id' => $userId,
            'actor_id' => auth()->id(), 
            'type' => 'new_course',
            'message' => 'Nouveau cours: ' . $cour->title,
            'is_read' => false,
        ]);
        return redirect()->route('formateur.courses')->with('success', 'Le cours a bien été ajouté.');
    }

    public function courseInfo($id){
        if (!$id) {
            return redirect()->back()->with('error', 'not found');
        }else{
            $cours= Cour::with('chapitres')->find($id);
            $categories = Categorie::all()->where('status','=','active');
            return view('formateur.editCour',compact('cours','categories'));
        }
        
    }

    public function updateCourses(Request $req ,$id){
        $cours = Cour::with('chapitres')->find($id);
        $validatedData = $req->validate([
            'title' => ['nullable', 'string', 'min:2'],
            'description' => ['nullable', 'string', 'min:4'],
            'date_creation' => ['nullable', 'date', 'date_format:Y-m-d','before:today'],
            // 'user_id'=> ['nullable', 'exists:users,id'],
            'categorie_id'=> ['nullable', 'exists:categories,id'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg'],
            'prix' => ['required', 'numeric']
        ]);
        $imagename = '';
        $hasfile = $req->hasFile('image');
        if($hasfile && $req->file('image')->isValid()){
            $imagename = $req->file('image')->getClientOriginalName();
            $validatedData['image'] = $imagename;
            $image_path = public_path('Cours/'.$id);
            $req->file('image')->move($image_path,$imagename);
        }else{
            $imagename = $cours->image;
        }
        $cours->update($validatedData);
        return redirect()->route('formateur.courses')->with('success','courses updated successfult .'); 
    }

    public function destroyCours($id){
        $cours = Cour::find($id);
        if($cours){
            $imagePath = public_path('Cours/' . $id . '/' . $cours->image);
            if (file_exists($imagePath)) {
            unlink($imagePath);
             }   
             $folderPath = public_path('Cours/' . $id);
            if (is_dir($folderPath) && count(scandir($folderPath)) <= 2) {
                rmdir($folderPath);
            }
            $coursID = $cours->id;
            $chapitres = Chapitre::where('cour_id','=',$coursID)->get();
            if($chapitres){
            foreach ($chapitres as $chapitre){
                $chapitreVedioPath = public_path('chapitres/'.$chapitre->id.'/'.$chapitre->video);
                if(file_exists($chapitreVedioPath)){
                    unlink($chapitreVedioPath);
                }
                $folderVedioPath = public_path('chapitres/'.$chapitre->id);
                if(is_dir($folderVedioPath) && count(scandir($folderVedioPath)) <=2){
                    rmdir($folderVedioPath);
                }
                $chapitreResumePath = public_path('resumes/'.$chapitre->id.'/'.$chapitre->resume);
                if(file_exists($chapitreResumePath)){
                    unlink($chapitreResumePath);
                }
                $folderResumePath = public_path('resumes/'.$chapitre->id);
                if(is_dir($folderResumePath) && count(scandir($folderResumePath)) <=2){
                    rmdir($folderResumePath);
                }
            }
            }
            $cours->delete(); 
         return redirect()->back()->with('success', 'Cours supprimé avec succès.');
    }
    return redirect()->back()->with('error', 'Cours introuvable.');
    }

}

