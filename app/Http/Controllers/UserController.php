<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function login(Request $request){
        $data = $request->validate([
            'logingname' => 'required',
            'logingpassword' => 'required'
        ]);
        //si el usuario mete las credenciales correctas, creamos la sesion
        if(auth()->attempt(['name'=> $data['logingname'], 'password' => $data['logingpassword']])){
            $request->session()->regenerate();
        }
        return redirect('/');
    }
    public function logout(){
        auth()->logout();
        return redirect('/');
    }
    public function register(Request $request){
        $data = $request->validate([
            'name' => 'required|min:3|max:30|unique:users,name', //unico en la tabla de users y la columna de name
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|max:200'
        ]);
        $user = User::create($data);
        auth()->login($user);
        return redirect('/');
    }
}
