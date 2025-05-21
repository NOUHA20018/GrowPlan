<?php

namespace App\Http\Controllers\Formateur;

use App\Http\Controllers\Controller;
use App\Models\Categorie;
use App\Models\Chapitre;
use App\Models\Cour;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Exists;

class CategorieController extends Controller
{
    public function listCategories(){
        $categories =Categorie::all();
        $from ='';
        return view('formateur.categories',compact('categories','from'));

    }
    public function editCategory($id){
        $category = Categorie::find($id);
        return view('formateur.editCategory',compact('category'));
    }

   public function addCategory(Request $request)
    {
        $from = $request->query('from', 'list');
        $from = session()->put('from', $request->query('from', $from));
        return view('formateur.addCategories', compact('from'));
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
        $categorie = Categorie::create($validatedData);      
        $image_path = public_path('Categories/'.$categorie->id);
        if($hasfile){
             $req->file('image')->move($image_path,$categorie->image);
        };
        $from = $req->query('from');
            // dd($validatedData['creator'] );
            // $redirectTo = session()->pull('previous_url', 'formateur/categories');
            // return redirect($redirectTo)->with('success','Categorie a bien été crée.');
            if ($from === 'cours') {
                return redirect()->route('formateur.courses.create')->with('success', 'Catégorie ajoutée avec succès.');
            }
            return redirect()->route('formateur.categories.index')->with('success', 'Catégorie ajoutée avec succès.');
        }
       
public function updateCategory(Request $req ,$id){
    $categorie = Categorie::findOrFail($id);
    // dd($categorie);
   $validatedData = $req->validate([
    'title' => ['nullable', 'string', 'min:2'],
    'description' => ['nullable', 'string', 'min:4'],            
    'status' => ['nullable', 'in:active,desactive'],
    'slug' => ['nullable', Rule::unique('categories')->ignore($categorie->id)],
    'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg'],
]);

    // dd($validatedData);
    $imagePath = public_path('Categories/' . $id);
    // dd($id);
        if (!file_exists($imagePath)) 
            mkdir($imagePath, 0777, true);
        if ($req->hasFile('image')) {
            $oldImagePath = $imagePath . '/' . $categorie->image;
            if (file_exists($oldImagePath)) {
                unlink($oldImagePath); 
            }
            $imageFile = $req->file('image');
            $imageName = $imageFile->getClientOriginalName();
            $imageFile->move($imagePath, $imageName);
            $categorie->image = $imageName; 
        } else {
            $imageName = $categorie->image; 
        }
         unset($validatedData['image'], $validatedData['resume']);
        $categorie->fill($validatedData);
        $categorie->save();
    return redirect()->back()->with('success','Category updated successfully.');
}


 public function destroyCategory($id){
            $categorie = Categorie::find($id);
             if (!$categorie) {
                return redirect()->back()->with('error', 'Catégorie introuvable.');
            }
            $imagePath = public_path('Categories/' . $id . '/' . $categorie->image);
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }   
                $folderPath = public_path('Categories/' . $id);
                if (is_dir($folderPath) && count(scandir($folderPath)) <= 2) {
                    rmdir($folderPath);
                }
            $cours = Cour::where('categorie_id',$id)->get();
            foreach($cours as $cour){
                    $courImagePath = public_path('Cours/'.$cour->id.'/'.$cour->image);
                    if(file_exists($courImagePath)){
                        unlink($courImagePath);
                    }
                    $courFolderPath = public_path('Cours/'.$cour->id);
                    if(is_dir($courFolderPath) && count(scandir($courFolderPath)) <= 2){
                        rmdir($courFolderPath);
                    }
                    $chapitres = Chapitre::where('cour_id',$cour->id)->get();
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
                        $chapitre->delete();
                    }
                }
                $cour->delete();
            }
            $categorie->delete();
            return redirect()->back()->with('success','Categorie bien supprimer');

    }

}
