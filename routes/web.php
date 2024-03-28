<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Http\Controllers\UsersController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/sanpham', [HomeController::class, 'products'])->name('product');
Route::get('/themsanpham', [HomeController::class, 'getAdd']);
Route::post('/themsanpham', [HomeController::class, 'postAdd'])->name('post-add');
Route::put('/themsanpham', [HomeController::class, 'putAdd']);
// Route::get('/demo-response', function(){
//     $contentArr = [
//         'name'=> 'laravel',
//         'lesson' =>'khoa hoc lap trinh',
//         'academy'=> 'unicode'
//     ];
//     return $contentArr;
// });
// Route::get('/getData', [HomeController::class, 'getArr']);

// Route::get('/demo-response', function () {
// $content = "Hoc laravel tai unicode";
// $content = json_encode([
//     'item1',
//     'item2'
// ]);
// $response = new Response($content);
// $response->header('Content-Type', 'application/json');
// $response = new Response();
// $response -> cookie('unicode', 'Training PHP-laravel',30);
// return $response;
// return view('Clients.demo-test');
// gán view cho response
//     $response = response()
//     ->view('Clients.demo-test', [
//         'title' => 'hoc http respone',
//     ], 201 )
//     -> header('Content-Type', 'application/json')
//     -> header('API-key', '123456');
//     return $response;
// });
// Trả Response về dạng JSON

Route::get('/demo-response', function () {
    $contentArr = [
        'name' => 'laravel',
        'lesson' => 'khoa hoc lap trinh',
        'academy' => 'unicode'
    ];
    return response()
    ->json($contentArr, 201)
    ->header('API-key', '1234');
});
// Response trả về dạng chuyển hướng(Ridirect)
// Route::get('/demo-reponse-2', function(){
    
//     return view('Clients.demo-test');
// })->name('demo-respone');
Route::post('/demo-reponse-2', function(Request $request){
    if (!empty($request->username)){
        // return redirect(route('demo-respone'));
        return back()->with('mess', 'validate thanh cong');
    }
    return redirect(route('demo-respone'))->with('mess', 'validate khon thanh cong');
});

// response dạng downlod file
Route::get('/download-image', [HomeController::class,'dowloadImage'])->name('downloadImage');
Route::get('/downloadDoc', [HomeController::class,'dowloadDoc'])->name('downloadDoc');
Route::prefix('users')->name('users.')->group(function(){
    Route::get('/', [UsersController::class,'index'])->name('index');
    Route::get('/add', [UsersController::class,'add'])->name('add');
    Route::post('/add', [UsersController::class,'postAdd'])->name('postAdd');
    Route::get('/edit/{id}',[UsersController::class,'getEdit'])->name('edit');
    Route::post('/update',[UsersController::class,'postEdit'])->name('postEdit');
    Route::get('/delete/{id}',[UsersController::class,'delete'])->name('delete');
});


// Route::get('/demo', function(){
//     $tasks = [
//         ['name' => 'Task1'],
//         ['name' => 'Task2'],
//         ['name' => 'Task3'],
//         ['name' => 'Task4'],
//     ];
//     return view('Clients.demo-test', ['tasks' => $tasks]);
// })->name('demo-test');
