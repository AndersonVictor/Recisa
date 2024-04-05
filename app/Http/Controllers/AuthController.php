<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //Redireccionar al usuario que no inicio sesion
    public function login(){
        if(!empty(Auth::check())){
            if(Auth::user()->user_level == 1){
                //Redireccionar al link de acuerdo al rol
                return redirect('admin/dashboard');
            }
        }
        return view('auth.login');
    }
    //Validar los datos ingresados en el login
    public function AuthLogin(Request $request){
        //Verificar que los datos se estan recibiendo dd($request->all());
        //Si el usaurio da en la opcionde recordar credenciales
        $remember=!empty($request->remember) ? true : false;
        //un inicio de sesion de un usaurio
        if(Auth::attempt(['username' => $request->username, 'password' => $request->password,'status' => 1],$remember)){
            if(Auth::user()->user_level== 1){
                return redirect('admin/dashboard');
            }
        }else{
            // Verificar si el usuario existe pero su cuenta ha sido eliminada
            $user = User::where('username', $request->username)->first();
            if ($user && $user->status == 0) {
                return redirect()->back()->withErrors('Usted no tiene acceso');
            }
            // Si el usuario no existe o la contraseña es incorrecta
            return redirect()->back()->withErrors('Por favor, ingrese su usuario y contraseña correctas');
        }
    }
    public function Logout(){
        Auth::logout();
        return redirect(url(''));
    }

}
