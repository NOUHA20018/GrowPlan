<?php

namespace App\Http\Controllers\Formateur;

use App\Http\Controllers\Controller;
use App\Models\Categorie;
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
    public function showCategory($id){
        $category = Categorie::find($id);
        return view('formateur.showCategory',compact('category'));
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
        public function destroyCategory($id){
            $categorie = Categorie::find($id);
            
            if($categorie){
            $imagePath = public_path('Categories/' . $id . '/' . $categorie->image);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }   
             $folderPath = public_path('Categories/' . $id);
        if (is_dir($folderPath) && count(scandir($folderPath)) <= 2) {
            rmdir($folderPath);
        }
            $categorie->delete();
            return redirect()->back()->with('success','Categorie bien supprimer');
        }

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


}
