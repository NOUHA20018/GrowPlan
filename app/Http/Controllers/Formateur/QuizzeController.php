<?php

namespace App\Http\Controllers\Formateur;

use App\Http\Controllers\Controller;
use App\Models\Chapitre;
use App\Models\Cour;
use App\Models\Question;
use App\Models\Quizze;
use App\Models\Reponses_possibles;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Exists;

class QuizzeController extends Controller
{
    public function quizzes(){
        $quizzes = Quizze::with(['cour','chapitre'])->get(); 
        // $quiz=Quizze::find(1);

        // dd($quiz);
        return view('formateur.quizzes', compact('quizzes'));
    }
   public function showQuiz($id)
{
    $quiz = Quizze::with(['chapitre', 'cour', 'user'])->findOrFail($id);
    $questions = $quiz->questions()->with('reponses_possible')->get();
    // foreach($questions as $q){
    //     foreach($q->reponses_possible as $op){
    //         dd($op);
    //     }
    // }
    return view('formateur.showQuiz', compact('quiz', 'questions'));
}

    public function addQuiz($id,$chapitreId = null){
        $cour = Cour::find($id);
        if($chapitreId){
            $courChapitres = Chapitre::find($chapitreId);
        }else{
        $courChapitres = Chapitre::where('cour_id', $id)->get();
        }
        return view('formateur.addQuiz',compact('cour','courChapitres'));
    }

    public function storeQuiz(Request $req,$id){
        $validatedData = $req->validate([
            'title'=>['required','string','min:3'],
            'description'=>['nullable','string','min:3'],
            'questions'=>['array','required'],
            'questions.*.text' =>['string','required'],
            'questions.*.options'=>['array','required'],
            'questions.*.options.*.text' =>['string','required'],
            'questions.*.options.*.is_correct' =>['nullable'],
        ]);
        // foreach($validatedData['questions.*.options'] as $va){dd($va);}
        // dd($validatedData);
        $quiz = new Quizze();
        $quiz->title = $validatedData['title'];
        $quiz->description = $validatedData['description'];
        $quiz->chapitre_id =$req->chapterQuiz ?: null;
        $quiz->cour_id = $id;
        $quiz->user_id = Auth()->id();
        $quiz->save();
        // dd($quiz);
        if($validatedData['questions']){
            // for ($i=0; $i < count($validatedData['questions']); $i++)
            foreach ($validatedData['questions'] as $questionData) {
                $question = new Question();
                $question->question_text = $questionData['text'];
                $question->quizze_id = $quiz->id;
                $question->save();
                // dd($question);
                // if($validatedData['questions.*.options']){
                    foreach($questionData['options'] as $option){
                    // for ($i=0; $i <count($validatedData['questions'.$i.'options']) ; $i++)
                    $reponse_possible = new Reponses_possibles();
                    $reponse_possible->question_id = $question->id;
                    $reponse_possible->option_text = $option['text'];
                    $reponse_possible->is_correct = isset($option['is_correct']) ? true : false;
                    $reponse_possible->save();
                    }
        
                }
            // }
        }
        return redirect()->route('formateur.quizzes',$id)->with('success', 'Quiz enregistré avec succès.');

    }

    public function editQuiz($id){
        $quiz = Quizze::find($id);
        $chapitres = Chapitre::all();
        $cours = Cour::all();
        $questions = Question::where('quizze_id',$id)->get();
        return view('formateur.editQuiz',compact('quiz','chapitres','cours','questions'));
    }

    public function updateQuiz(Request $req ,$id){
        $quiz = Quizze::find($id);
        $validatedData = $req->validate([
        'title' => ['nullable', 'string', 'min:3'],
        'description' => ['nullable', 'string', 'min:3'],
        'chapitre_id' => ['nullable', 'exists:chapitres,id'],
        'cour_id' => ['nullable', 'exists:cours,id'],
        'question_text' => ['nullable', 'array'],
        'question_text.*' => ['nullable', 'string', 'min:3'],
        'questions' => ['nullable', 'array'],
        'questions.*.option_text' => ['nullable', 'array'],
        'questions.*.option_text.*' => ['nullable', 'string', 'min:1'],
        'questions.*.correct' => ['nullable', 'integer'],    
        ]);
        $quiz->update([
        'title' => $validatedData['title'],
        'description' => $validatedData['description'],
        'chapitre_id' => $validatedData['chapitre_id'],
        'cour_id' => $validatedData['cour_id'],
        ]);
        
        if (!empty($validatedData['question_text'])){
            $questions = Question::where('quizze_id',$quiz->id)->with('reponses_possible')->get();
            foreach ($validatedData['question_text'] as $index=>$question_text) {
                $question = Question::with('reponses_possible')->find($index);
                if($question){
                    $question->update([
                        'question_text' => $validatedData['question_text'][$index],
                    ]);
                    $question->reponses_possible()->delete();
                       $options = $validatedData['questions'][$index]['option_text'] ?? [];
                        $correctIndex = $validatedData['questions'][$index]['correct'] ?? null;

                        foreach ($options as $idx => $option_text) {
                            $question->reponses_possible()->create([
                                'option_text' => $option_text,
                                'is_correct' => ($correctIndex == $idx) ? 1 : 0,
                            ]);
                        }
  
                        
                    
                }
            }
        }   
        
        return redirect()->route('formateur.quizzes')->with('success','quiz bien modifié!');
        
    }
            public function deleteQuestion($id)
            {
                $question = Question::findOrFail($id);
                $question->delete();

                return response()->json(['success' => true]);
            }

            public function addQuestion(Request $request, $quizId)
            {
                $request->validate([
                    'question_text' => 'required|string',
                    'options' => 'required|array|min:3',
                    'correct_option' => 'required|integer',
                ]);

                $quiz = Quizze::findOrFail($quizId);
                $question = new Question();
                $question->quizze_id = $quiz->id;
                $question->question_text = $request->input('question_text');
                $question->save();

                $options = $request->input('options');
                $correctIndex = $request->input('correct_option');

                foreach ($options as $index => $optionText) {
                    $option = new Reponses_possibles();
                    $option->question_id = $question->id;
                    $option->option_text = $optionText;
                    $option->is_correct = ($index == $correctIndex);
                    $option->save();
                }

                return redirect()->route('formateur.editQuiz', $quiz->id)
                                ->with('success', 'Nouvelle question ajoutée avec succès.');
            }

}
