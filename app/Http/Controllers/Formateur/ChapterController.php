<?php

namespace App\Http\Controllers\Formateur;

use App\Http\Controllers\Controller;
use App\Models\Chapitre;
use Illuminate\Http\Request;

class ChapterController extends Controller
{
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
                'video' => '', 
                'resume' => $validatedData['resume'],
                'cour_id' => $id,
            ]);

            
            $videoPath = public_path('chapitres/'. $chapitre->id);
            $resumePath = public_path('resumes/'. $chapitre->id);
            
            if (!file_exists($videoPath)) mkdir($videoPath, 0777, true);
            if (!file_exists($resumePath)) mkdir($resumePath, 0777, true);
            
            
            if ($req->hasFile('video')) {
                $videoFile = $req->file('video');
                $videoName = $videoFile->getClientOriginalName();
                $videoFile->move($videoPath, $videoName);
                $chapitre->video = $videoName;
            }
            
            
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

        
        public function editChapter(Chapitre $chapitre)
        {
            // $chapitre = Chapitre::find($chapitre);
            $chapitres =Chapitre::all();
            return view('formateur.editChapter', compact('chapitre','chapitres'));
        }
        public function updateChapter(Request $req, $id)
    {
        $chapitre = Chapitre::find($id);
        $videoName = '';
        $resumeName = '';
        $validatedData = $req->validate([
            'title' => 'nullable|string|max:255',
            'duree' => 'nullable|numeric',
            'video' => 'nullable|file|mimes:mp4,mov,avi|max:5120000',
            'resume' => 'nullable|file|mimes:pdf,docx,txt',
        ]);

        // Définir les chemins de stockage
        $videoPath = public_path('chapitres/' . $id);
        $resumePath = public_path('resumes/' . $id);

        // Créer les dossiers s'ils n'existent pas
        if (!file_exists($videoPath)) mkdir($videoPath, 0777, true);
        if (!file_exists($resumePath)) mkdir($resumePath, 0777, true);
        // Déplacer  vidéo
        if ($req->hasFile('video')) {
            $oldVideoPath = $videoPath . '/' . $chapitre->video;
            if (file_exists($oldVideoPath)) {
                unlink($oldVideoPath); 
            }
            $videoFile = $req->file('video');
            $videoName = $videoFile->getClientOriginalName();
            $videoFile->move($videoPath, $videoName);
            $chapitre->video = $videoName; 
        } else {
            $videoName = $chapitre->video; 
        }
        
        if ($req->hasFile('resume')) {
            $oldResumePath = $resumePath . '/' . $chapitre->resume;
            if (file_exists($oldResumePath)) {
                unlink($oldResumePath); 
            }
            $resumeFile = $req->file('resume');
            $resumeName = $resumeFile->getClientOriginalName();
            $resumeFile->move($resumePath, $resumeName); 
            $chapitre->resume = $resumeName; 
        } else {
            $resumeName = $chapitre->resume; 
        }

    
   unset($validatedData['video'], $validatedData['resume']);

$chapitre->fill($validatedData);
$chapitre->save();

    // dd([
    //     'videoName' => $videoName,
    //     'stored_in_db' => $chapitre->video,
    //     'path' => $videoPath . '/' . $videoName,
    //     'file_exists' => file_exists($videoPath . '/' . $videoName),
    // ]);

    return redirect()->back();
}

}
