<?php

namespace App\Http\Controllers\Apprenant;

use App\Http\Controllers\Controller;
use App\Models\apprenants_quizzes;
use App\Models\Categorie;
use App\Models\Chapitre;
use App\Models\Cour;
use App\Models\Inscription;
use App\Models\Quizze;
use Illuminate\Http\Request;

class ApprenantController extends Controller
{
    public function dashboard(){
        return view('apprenant.dashboard');
    }
   public function index(Request $request)
    {
        $categories = Categorie::where('status', 'active')->get();
        $coursesQuery = Cour::query()->where('status','valide');   
        if ($request->has('categorie') && $request->categorie != 'all') {
            $coursesQuery->where('categorie_id', $request->categorie);
        }
        $cours = $coursesQuery->with('categorie')->paginate(9);
        
        return view('apprenant.index', compact('cours', 'categories'));
    }
//    public function show(Cour $cour)
    // {
    //     $cour->load([
    //         'chapitres' => function($query) {
    //             $query->orderBy('created_at')->withCount('quizzes');
    //         },
    //         'chapitres.quizzes' => function($query) {
    //             $query->withCount('questions');
    //         },
    //         'user',
    //         'categorie'
    //     ]);

    //     return view('apprenant.showCour', compact('cour'));
    // }  
    public function show( $id)
    {
    $cour = Cour::with('chapitres','user','categorie')->find($id);
        return view('apprenant.showCour', compact('cour'));
    }

   public function showChapter(Chapitre $chapitre)
    {
        // dd([
        //     'chapitre_id' => $chapitre->id,
        //     'cour_id' => $chapitre->cour_id,
        // ]);
        
        $chapitre->load(['cour', 'quizzes']);
        if (!$chapitre->id) {
            abort(404, "Chapitre not found");
        }
    $previousChapter = Chapitre::where('cour_id', $chapitre->cour_id)
        ->when($chapitre->id, function ($query, $id) {
            return $query->where('id', '<', $id);
        })
        ->orderBy('id', 'desc')
        ->first();
        $nextChapter = Chapitre::where('cour_id', $chapitre->cour_id)
        ->when($chapitre->id, function ($query, $id) {
            return $query->where('id', '>', $id);
        })
        ->orderBy('id', 'asc')
        ->first();
        return view('apprenant.showChapter', [
            'chapitre' => $chapitre,
            'previousChapter' => $previousChapter,
            'nextChapter' => $nextChapter
        ]);
    }

    public function showQuiz($id){
        $quiz = Quizze::with('questions.reponses_possible')->findOrFail($id);
        return view('apprenant.showQuiz',compact('quiz'));
    }

    public function reponses(Request $req,$id){
        // dd($req->option_text);
        $quiz = Quizze::with('questions.reponses_possible')->findOrFail($id);
        $score = 0;
        $responses_json = [];
       
        foreach($quiz->questions as $question){
            $questionId=$question->id;
            if(isset($req->option_text[$questionId])){
                $selectedReponseId = $req->option_text[$questionId];
                $responses_json[$questionId] = $selectedReponseId;
                $correctAnswer = $question->reponses_possible->firstWhere('is_correct', 1);

                if ($correctAnswer && $selectedReponseId == $correctAnswer->id) {
                    $score++;
                }
                
                
            }
        }
        $reponse=new apprenants_quizzes();
        $reponse->apprenant_id=Auth()->id();
        $reponse->quiz_id= $id;
        $reponse->date_passage=now();
        $reponse->responses_json= json_encode($responses_json);;
        $reponse->score=$score;
        $reponse->save();   
        return redirect()->route('apprenant.reponses_correct',$id)->with('success', 'Quiz soumis avec succès. Score : ' . $score);

    }
    public function reponses_correct($id){
        $quiz =Quizze::with('questions.reponses_possible')->find($id);
        dd($quiz);
        return view('apprenant.reponses_correct',compact('quiz'));
    }
        public function sinscrire($id){
            $user = Auth()->user();
            $cour = Cour::find($id);
            if(!$user->coursInscrits()->where('cour_id',$id)->exists()){
                $user->coursInscrits()->attach($id,['inscrit_le'=>now(),'status'=>Inscription::STATUS_ACCEPTE]);
            return redirect()->route('apprenant.paiement', $id)
                ->with('success', 'Vous êtes maintenant inscrit, passez au paiement.');
            }
        return redirect()->route('apprenant.cours.show', $id)
            ->with('info', 'Vous êtes déjà inscrit à ce cours.');
        }

        public function paiement($id)
        {
            $cour = Cour::findOrFail($id);
            return view('apprenant.paiement', compact('cour'));
        }

        public function viewResume($id){
            $chapitre = Chapitre::find($id);
            return view('apprenant.viewResume',compact('chapitre'));
        }


    
}
