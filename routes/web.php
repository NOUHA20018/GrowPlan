<?php

use App\Http\Controllers\FormateurController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
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
    Route::get('formateur/courses', [FormateurController::class, 'courses'])->name('courses');
    Route::get('formateur/courses/create', [FormateurController::class, 'createCourse'])->name('courses.create');
    Route::post('formateur/courses/store', [FormateurController::class, 'storeCourse'])->name('courses.store');

    // Categories Management
    Route::get('formateur/categories', [FormateurController::class, 'listCategories'])->name('categories.index');
    Route::get('formateur/categories/create', [FormateurController::class, 'showCategory'])->name('categories.create');
    Route::post('formateur/categories/store', [FormateurController::class, 'storeCategory'])->name('categories.store');

    // Course Information
    Route::get('formateur/courses/{id}/info', [FormateurController::class, 'courseInfo'])
    ->where('id', '\d+')->name('courses.info');
    Route::get('formateur/courses/{id}/edit',[FormateurController::class,'editCourses'])->name('edit.courses');
    Route::patch('formateur/courses/{id}/update',[FormateurController::class,'updateCourses'])->name('update.courses');

    // Chapters Management
    Route::get('formateur/courses/{id}/chapters/create', [FormateurController::class, 'createChapter'])
    ->where('id', '\d+')->name('chapters.create');
    Route::post('formateur/courses/{id}/chapters/store', [FormateurController::class, 'storeChapter'])->name('chapters.store');

    // PHP Info (for debugging or system info)
    Route::get('/phpinfo', function () {
        phpinfo();
    });


    Route::post('/upload-video', [FormateurController::class, 'upload']);

});


require __DIR__.'/auth.php';


