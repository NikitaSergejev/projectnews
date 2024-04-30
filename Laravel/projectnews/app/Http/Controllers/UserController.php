<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Auth; //сервис аутентификации
use Hash; //Библиотека для кодирования паролей
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::orderBy('created_at', 'desc')->get();
        $roles = User::distinct('role')->pluck('role');
        return view('users.index', compact('users', 'roles'));
    }
    //-----------------list user by role
    public function userByrole(Request $request){

        $data = $request->all();//данные, переданы формой
        $roles = User::distinct('role')->pluck('role');
        $selectRole=$data['role'];
        //если выбран All - все
        if($data['role']=="0"){
             // Возвращаем полный список пользователей
            return redirect('/users');
        }else{//если выбрана категория
            //запрос на выбор по категории
            $users = User::where('role', $data['role'])->get();
            return view('users.index',compact('users','roles','selectRole'));
        }
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = User::distinct('role')->pluck('role');
        return view('users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' =>'required|string|max:255',
            'email' =>'required|string|email|max:255|unique:users',
            'password' =>'required|string|min:6|confirmed',
            'password_confirmation' =>'required',
        ]);
        //---------запрос на добавление пользователя
        User::create([
            'name'=> $request->name,
            'email'=> $request->email,
            'password' => Hash::make($request->password),
            'role'=>$request->role,
        ]);
        return redirect('users');
    }

    public function form_register(){
        $roles = User::distinct('role')->pluck('role');
        return view('users.register', compact('roles'));
    }

    public function register_store(Request $request)
    {
        $request->validate([
            'name' =>'required|string|max:255',
            'email' =>'required|string|email|max:255|unique:users',
            'password' =>'required|string|min:6|confirmed',
            'password_confirmation' =>'required',
        ]);
        $request['role'] = 'user';
        //---------запрос на добавление пользователя
        User::create([
            'name'=> $request->name,
            'email'=> $request->email,
            'password' => Hash::make($request->password),
            'role'=>$request->role,
        ]);
        return view('users.result');
    }
    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $roles=array('admin','manager','user');
        return view ('users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255'
        ]);
        if(!isset($request->role)) $request->role=Auth::user()->role;
        if($request->password) {//если пароль меняют!
            $request->validate([
                'password'=>'required|string|min:6|confirmed',
                'password_confirmation' =>'required',
            ]);
            $user->update([
                'name'=> $request->name,
                'password'=>Hash::make($request->password),
                'role'=>$request->role,
            ]);
        }else{//пароль НЕ меняют
            $user->update([
                'name'=> $request->name,
                'role'=>$request->role,
            ]);
        }
        return redirect('/users');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete(); // Удаление задачи из базы данных
        return redirect('/users'); // Редирект на страницу списка товаров
    }
}
