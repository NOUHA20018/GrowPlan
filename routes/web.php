<?php

use App\Http\Controllers\Apprenant\ApprenantController;
use App\Http\Controllers\Formateur\CategorieController;
use App\Http\Controllers\Formateur\ChapterController;
use App\Http\Controllers\Formateur\CoursController;
use App\Http\Controllers\Formateur\FormateurController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Formateur\QuizzeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', function () {
    return view('welcome');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
// Formateur Routes
Route::middleware(['auth', 'formateur'])->name('formateur.')->group(function () {
    // Dashboard
    Route::get('formateur/dashboard', [FormateurController::class, 'index'])->name('dashboard');
    
    // Courses Management
    Route::get('formateur/courses', [CoursController::class, 'courses'])->name('courses');
    Route::get('formateur/courses/create', [CoursController::class, 'createCourse'])->name('courses.create');
    Route::post('formateur/courses/store', [CoursController::class, 'storeCourse'])->name('courses.store');
    Route::get('formateur/courses/{id}/info', [CoursController::class, 'courseInfo'])
    ->where('id', '\d+')->name('courses.info');
    Route::patch('formateur/courses/{id}/update',[CoursController::class,'updateCourses'])->name('update.courses');
    Route::delete('forurmateur/courses/{id}/destroy',[CoursController::class,'destroyCours'])->name('cours.destroy');
    
    // Categories Management
    Route::get('formateur/categories', [CategorieController::class, 'listCategories'])->name('categories.index');
    Route::get('formateur/categories/create', [CategorieController::class, 'addCategory'])->name('categories.create');
    Route::post('formateur/categories/store', [CategorieController::class, 'storeCategory'])->name('categories.store');
    Route::get('formateur/categories/{id}/edit', [CategorieController::class, 'editCategory'])->name('categories.edit');
    Route::delete('formateur/categories/{id}', [CategorieController::class, 'destroyCategory'])->name('categories.delete');
    Route::patch('formateur/categories/{id}/edit', [CategorieController::class, 'updateCategory'])->name('categories.update');
    
    // Chapters Management
    Route::get('formateur/courses/{id}/chapters/create', [ChapterController::class, 'createChapter'])
    ->where('id', '\d+')->name('chapters.create');
    Route::post('formateur/courses/{id}/chapters/store', [ChapterController::class, 'storeChapter'])->name('chapters.store');
    Route::get('formateur/courses/chapter/{chapitre}/edit', [ChapterController::class, 'editChapter'])
    ->where('id', '\d+')->name('chapters.edit');
    Route::patch('formateur/update/chapitre/{id}',[ChapterController::class,'updateChapter'])->name('update.chapitre');
    // Analytics
    Route::get('formateur/analytics',[FormateurController::class,'showAnalytics'])->name('analytics');
    Route::get('/phpinfo', function () {
        phpinfo();
        Route::post('/upload-video', [FormateurController::class, 'upload']);
    });
    
    // Quizze Management
    Route::prefix('formateur')->group(function () {
        Route::controller(QuizzeController::class)->group(function () {
            Route::get('/cour/quizzes', 'quizzes')->name('quizzes');
            Route::get('/cour/quiz/{id}/show', 'showQuiz')->name('showQuiz');
            Route::get('/cour/quiz/{id}/edit', 'editQuiz')->name('editQuiz');
            Route::patch('/cour/quiz/{id}/update', 'updateQuiz')->name('updateQuiz');
            Route::get('/cour/{id}/chapitre/quiz/create/{chapitreId?}', 'addQuiz')->name('addQuiz');
            Route::post('/cour/{id}/chapitre/quiz/store/{chapitreId?}',  'storeQuiz')->name('storeQuiz');
            Route::post('/cour/{id}/chapitre/quiz/create/{chapitreId?}', 'addQuestion')->name('addQuestion');
            Route::delete( '/question/{id}',  'deleteQuestion')->name('deleteQuestion');
        });
    });
});

Route::controller(ApprenantController::class)->middleware(['auth', 'apprenant'])->name('apprenant.')->group(function () {
    Route::get('apprenant/dashboard',  'dashboard')->name('dashboard');
    Route::get('apprenant/index',  'index')->name('index');
    Route::get('apprenant/cours/{id}',  'show')->name('cours.show');

    
});


require __DIR__.'/auth.php';


