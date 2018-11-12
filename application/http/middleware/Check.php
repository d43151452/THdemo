<?php

namespace app\http\middleware;

use app\index\model\Users;

class Check
{
    public function handle($request, \Closure $next)
    {
        if(session('user_id')){
            return $next($request);
        }
        if(\Cookie::get('token')){
            $user = Users::where('token',\Cookie::get('token'))->find();
            if($user){
                session('user_id',$user->id);
                session('uname',$user->uname);
                session('token',$user->token);
                return $next($request);
            }
        }
        return redirect('/login.html');
    }
}
