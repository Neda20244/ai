<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GenerateController;

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/generate/loading', function (Request $request) {
    $job_id = $request->query('job_id'); 
    return view('loading', compact('job_id'));
})->name('generate.loading');
Route::get('/', [GenerateController::class, 'index'])->name('generate.form');
Route::post('/generate', [GenerateController::class, 'generate'])->name('generate.submit');
Route::get('/generated-posts', [GenerateController::class, 'showPosts'])->name('generated.posts');



