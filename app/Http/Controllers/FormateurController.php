<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Models\Chapitre;
use App\Models\Cour;
use Illuminate\Http\Request;
use Pest\Plugins\Parallel\Support\CompactPrinter;

class FormateurController extends Controller
{
    // ----------------- start Courses------------------------
    public function index(){
        $cours= Cour::all();
        return view('formateur.dashboard',compact('cours'));
    }
    public function courses(){
        $cours = Cour::all();

        return view('formateur.courses',compact('cours'));
    }
    public function createCourse(){
        $categories = Categorie::all();
        return view('formateur.addCourses',compact('categories'));
    }
    public function storeCourse(Request $req){
        $validatedData = $req->validate([
            'title' => ['required','string','min:2'],
            'description' => ['nullable','string','min:4'],
            'prix' => ['required','integer'],
            'date_creation' => ['nullable','date'],
            'categorie_id'=> ['required'],
            'image' =>['image','nullable','mimes:jpg,bmp,png']
        ]);
        // dd($validatedData['image']);
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
        
        return redirect()->route('formateur.courses')->with('success', 'Le cours a bien été ajouté.');
    }

    public function courseInfo($id){
        if (!$id) {
            return redirect()->back()->with('error', 'not found');
        }else{
            $cours= Cour::with('chapitres')->find($id);
            // $chapitres = Chapitre::all();
            return view('formateur.showCour',compact('cours'));
        }
        
    }

    public function editCourses($id){
        $cours = Cour::find($id);
        return view('formateur.editCourses',compact('cours'));
    }


    // ----------------- End Courses------------------------

    // ----------------- start Categories------------------------
    public function listCategories(){
        $categories =Categorie::all();
        return view('formateur.categories',compact('categories'));

    }
    public function showCategory(){
        
        return view('formateur.addCategories');
    }

    public function storeCategory(Request $req){
        $validatedData = $req->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'slug' => ['required', 'string', 'max:255', 'unique:categories'],
            'status' => ['required', 'in:active,desactive'],
            'image' => ['required', 'image', 'mimes:jpeg,png,jpg,svg', 'max:10240'],
            'user_id' => '',
        ]);
        $validatedData['user_id'] = auth()->id();
        $imagename= '';
        $hasfile = $req->hasFile('image');
        if($hasfile){
            $imagename = $req->file('image')->getClientOriginalName();
            $validatedData['image'] = $imagename;
        }
        // dd($validatedData);    
        $categorie = Categorie::create($validatedData);      
        $image_path = public_path('Categories/'.$categorie->id);
        if($hasfile){
             $req->file('image')->move($image_path,$categorie->image);
        };
            // dd($validatedData);
            // dd($validatedData['creator'] );
            return redirect()->route('formateur.courses.create')->with('success','Categorie a bien été crée.');
            // return redirect()->back()->with('success','L\'admin a bien été crée.');
        }

        // ----------------- End Categories------------------------


        // ----------------- start Chapters------------------------
        public function createChapter($id){
            $chapitres = Chapitre::all();
            return view('formateur.addChapters' ,compact('chapitres','id'));
        }
     
        public function storeChapter(Request $req,$id)
        {
            $validatedData = $req->validate([
                'title' => 'required|string|max:255',
                'duree' => 'required|numeric',
                'video' => 'required|file|mimes:mp4,mov,avi|max:5120000',
                'resume' => 'nullable|file|mimes:pdf,docx,txt',
                'cour_id' =>''
            ]);
            $validatedData['cour_id'] = auth()->id();
            $chapitre = Chapitre::create([
                'title' => $validatedData['title'],
                'duree' => $validatedData['duree'],
                'video' => '', // temporaire
                'resume' => $validatedData['resume'],
                'cour_id' => $id,
            ]);

            // Définir les chemins de stockage
            $videoPath = public_path('chapitres/'. $chapitre->id);
            $resumePath = public_path('resumes/'. $chapitre->id);
            // Créer les dossiers si non existants
            if (!file_exists($videoPath)) mkdir($videoPath, 0777, true);
            if (!file_exists($resumePath)) mkdir($resumePath, 0777, true);
            
            // Déplacer la vidéo
            if ($req->hasFile('video')) {
                $videoFile = $req->file('video');
                $videoName = $videoFile->getClientOriginalName();
                $videoFile->move($videoPath, $videoName);
                $chapitre->video = $videoName;
            }
            
            // Déplacer le résumé si présent
            if ($req->hasFile('resume')) {
                $resumeFile = $req->file('resume');
                $resumeName = $resumeFile->getClientOriginalName();
                $resumeFile->move($resumePath, $resumeName);
                $chapitre->resume = $resumeName;
            }

            $chapitre->save();
            return redirect()->route('formateur.courses.info', ['id' => $chapitre->cour_id])->with('success', 'Chapitre ajouté');
        }


        public function upload(Request $request)
        {
            $file = $request->file('file');
            $chunkNumber = $request->resumableChunkNumber;
            $totalChunks = $request->resumableTotalChunks;
            $identifier = $request->resumableIdentifier;
            $filename = $request->resumableFilename;
        
            $temp_dir = storage_path("app/temp/$identifier");
        
            if (!is_dir($temp_dir)) {
                mkdir($temp_dir, 0777, true); // Création du dossier temporaire
            }
        
            // Mouv la partie dyal vidéo
            $file->move($temp_dir, "chunk.$chunkNumber");
        
            // Si kulchi les morceaux dakhlou
            if (count(scandir($temp_dir)) - 2 == $totalChunks) {
                // Assemble chunks
                $finalPath = storage_path("app/public/videos/$filename");
                $output = fopen($finalPath, 'ab');
        
                // L'assemblage de la vidéo
                for ($i = 1; $i <= $totalChunks; $i++) {
                    $chunk = file_get_contents("$temp_dir/chunk.$i");
                    fwrite($output, $chunk);
                }

                fclose($output);
                array_map('unlink', glob("$temp_dir/*"));
                rmdir($temp_dir);
            }
        
            return response('Chunk reçu', 200); 
        }
        // ----------------- End Chapters------------------------
        
}
