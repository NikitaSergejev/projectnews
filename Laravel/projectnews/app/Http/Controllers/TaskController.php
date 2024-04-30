<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Category;//для вывода данных из модели Category;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories=Category::orderBy('name', 'asc')->get();
        $tasks = Task::orderBy('created_at', 'desc')->get();
        return view('tasks.index', compact('tasks','categories'));
    }

    //-----------------list task by category
    public function taskByCategory(Request $request){
        //из формы передан id категории
        $data = $request->all();//данные, переданы формой
        $categories=Category::orderBy('name','asc')->get();//все категории
        $selectCategory=$data['category_id'];
        //если выбран All - все
        if($data['category_id']=="0"){
            return redirect('/productlist');//возврат на полный список товаров
        }else{//если выбрана категория
            //запрос на выбор по категории
            $tasks = Task::where('category_id', $data['category_id'])->get();
            return view('tasks.index',compact('tasks','categories','selectCategory'));
        }
    }
    //--limit3
    public function listLimit()
    {
        $tasks = Task::orderBy('created_at', 'DESC')->take(3)->get();
        return view('startMainPage', compact('tasks'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //список категорий для выбора
        $categories=Category::orderBy('name','asc')->get();
        return view('tasks.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       $request->validate([
            'title'=>'required',
            'description'=>'required',
            'category_id'=> 'required'
        ]);
        $data = $request ->all();//данные, переданы формой
        $filename = $request->file('image')->getClientOriginalName();//Имя файла картинки
        $data['image']= $filename;//запись имя файла для бд
        Task::create($data);//добавили данные в базу(INSERT)
        //-----------------закачка картинки root/images/
        $file = $request->file('image');//путь исходной картинки
        if($filename){
            //загрузка изображения из $file на сервер
            $file->move('../public/images/', $filename);//загрузка изображения

        }
        return redirect('/productlist');//возврат к списку новостей

    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        return view('tasks.detail', compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        $categories=Category::orderBy('name','asc')->get();
        return view('Tasks.edit', compact('task', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        $request->validate([
            'title'=>'required',
            'description'=>'required',
            'category_id'=> 'required'
        ]);
        $data = $request ->all();//данные, переданы формой
        if($request->file('image')){
            $filename = $request->file('image')->getClientOriginalName();//Имя файла картинки
            $data['image']= $filename;//запись имя файла для бд
            //-----------------закачка картинки root/images/
            $file = $request->file('image');//путь исходной картинки
            if($filename){
                //загрузка изображения из $file на сервер
                $file->move('../public/images/', $filename);//загрузка изображения
            }
        }
        $task->update($data);//update data
        return redirect('/productlist');//возврат к списку новостей
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $task->delete(); // Удаление задачи из базы данных
        return redirect('/productlist'); // Редирект на страницу списка товаров
    }
}
