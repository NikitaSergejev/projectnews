<?php
use App\Http\Controllers\Controller;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
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

Route::get('/', [TaskController::class, 'listLimit']);
Route::get('/show/{task}', [TaskController::class, 'show'])->name('task.show');
Route::get('/news', [CategoryController::class, 'listmenu']);
Route::get('/categorynews/{category}', [CategoryController::class, 'newsByCategory']);
Route::get('/search/', [CategoryController::class, 'search']);
Route::get('/catalog/{search}', [CategoryController::class, 'catalog']);
Route::get('/newsBySort', [CategoryController::class, 'newsBySort']);
//------
Route::post('/comments',[CommentController::class, 'store'])->name('comments.store');

/*Route::get('/', function () {
    return view('startMainPage');//Main start page for user, start - это форма Login
});*/
Route::group(['middleware'=>['auth']], function () {
    //только для авторизованных пользователей
    Route::get('/dashboard',[Controller::class, 'dashboard'])->name('dashboard');
    //---------------------admin, manager
    Route::middleware('manager')->group(function() {
    //---------------------Category list CRUD
    Route::get('/categorylist',[CategoryController::class, 'index']);
    Route::get('/addcategory',[CategoryController::class,'create']);
    Route::post('/addcategory', [CategoryController::class, 'store']);

    Route::get('/editcategory/{category}', [CategoryController::class, 'edit']);// Показать форму редактирования
    Route::post('/editcategory/{category}', [CategoryController::class, 'update']);// Обновление данных

    Route::delete('/deletecategory/{category}', [CategoryController::class,'destroy']);
    //--------Comment list CRUD
    Route::get('/commentslist',[CommentController::class,'index']);
    Route::delete('/deletecomment/{comment}',[CommentController::class, 'destroy']);

    //---------------------Task list CRUD
    //список - вывод на страницу - get
    Route::get('/productlist',[TaskController::class,'index']);
    //обработка данных формы - выбор категории - post
    Route::post('/productBycategory', [TaskController::class, 'taskByCategory']);
    //--------add task
    Route::get('/addtask',[TaskController::class,'create']);//create a new task
    Route::post('/addtask',[TaskController::class,'store']);//verify data in form
    //-------- edit task
    Route::get('/edittask/{task}',[TaskController::class,'edit']);
    Route::post('/edittask/{task}',[TaskController::class,'update']);
    ///------- delete task
    Route::delete('/deletetask/{task}',[TaskController::class, 'destroy']);
    });//end Route::middleware('manager')->group(function()
    //------------admin
    Route::middleware('admin')->group(function(){
    //------------by register user
        //список - вывод на страницу - get
        Route::get('/users',[UserController::class,'index'])->name('admin');
        //обработка данных формы - выбор роли - user
        Route::post('/userByrole', [UserController::class, 'userByRole']);
        //--------add user
        Route::get('/adduser',[UserController::class,'create']);//admin create a new user
        Route::post('/adduser',[UserController::class,'store']);//verify data in form
        ///------- delete user
        Route::delete('/deleteuser/{user}',[UserController::class, 'destroy']);

    });//end Route::middleware('admin')->group(function()
    Route::get('/profile/{user}', [UserController::class,'edit']);//редактирование профиля для пользователя
    //-------- edit task
    Route::get('/edituser/{user}',[UserController::class,'edit']);
    Route::post('/edituser/{user}',[UserController::class,'update']);

});//конец Route::group(['middleware'=>['auth']], function ()


//-----login to admin panel
Route::get('/login',[AuthController::class, 'login'])->name('login');//вывод страницы - форма Логин
Route::post('/login',[AuthController::class,'authenticate']);//обработка формы логин
Route::get('/register',[UserController::class, 'form_register'])->name('form_register');//вывод страницы - форма Логин
Route::post('/register',[UserController::class,'register_store']);//обработка формы логин
Route::get('/logout',[AuthController::class, 'logout'])->name('logout');


