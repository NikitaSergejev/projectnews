<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::orderBy('created_at', 'desc')->get();
        $comments = Comment::orderBy('created_at', 'desc')->get();
        $tasks = Task::orderBy('created_at', 'desc')->get();
        return view('comments.index',compact('comments','tasks', 'users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'body' => 'required|max:1000',
            ]);
        //$taskid - название поля в форме файл resources\views\Tasks\detail.blade.php
        $task=Task::where('id',$request->taskid)->first();
        if(trim($request->body)!=="")
        {
            Comment::create([
                'body' => $request->body,
                'user_id' => Auth::id(),
                'task_id' => $task->id
                ]);
        }
        return redirect('/show/'.$task->id);
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        $comment->delete(); // Удаление задачи из базы данных
        return redirect('/commentslist'); // Редирект на страницу списка товаров
    }
}
