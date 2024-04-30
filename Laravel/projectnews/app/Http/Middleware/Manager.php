<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Manager
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();
        //Для пользователя с ролью admin or manager - т.е открываем доступ 2м ролям к функционалу
        //елси роль пользователя не admin and no manager - отправим на страницу dashboard
        if($user && ($user->role ==='admin'|| $user->role === 'manager')) {
            return $next($request);
        }
        return redirect()->route('dashboard');
    }
}
