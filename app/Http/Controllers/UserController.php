<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\User;

class UserController extends Controller
{
    //Show Register Form
    public function create(){
        return view('users.register');
    }

    //Store New User
    public function store(Request $request){
        $formFields = $request->validate([
            'outletID' => ['required', Rule::unique('users', 'outletID')],
            'name' =>['required', 'min:3'],
            'managerID' => ['required', Rule::unique('users', 'managerID')],
            'email' =>['required', 'email', Rule::unique('users', 'email')],
            'contact' =>'required',
            'password' =>['required', 'confirmed', 'min:6']
        ], 
        [
            'outletID.required' => 'The outlet ID field is required.',
            'outletID.unique' => 'The outlet ID entered has already been registered.',
            'name.required' => 'The name field is required.',
            'name.min' => 'The name field requires at least 3 letters.',
            'managerID.required' => 'The manager ID field is required.',
            'managerID.unique' => 'The manager ID entered has already been registered.',
            'contact.required' => 'The contact field is required.',
            'password.required' => 'The password field is required.',
            'password.min' => 'The password field requires at least 6 letters.',
            'password.confirmed' => 'The confirmation password does not match.',
            'email.unique' => 'The email entered has already been used.',
            'email.required' => 'The email field is required.',
            'email.email' => 'The email field must be a valid email address.',
        ]);

        //Hash Password
        $formFields['password'] = bcrypt($formFields['password']);

        //Create User
        $user = User::create($formFields);
        
        //Login
        auth()->login($user);
        
        session()->flash('success', 'User created and logged in!');
        return redirect('/');
    }

    //Logout User
    public function logout(Request $request){
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        session()->flash('success', 'You have been logged out!');
        return redirect('/');
    }

    //Show Login Form
    public function login() {
        return view('users.login');
    }

    //Authenticate User
    public function authenticate(Request $request){
        $formFields = $request->validate([
            'email' =>['required', 'email'],
            'password' =>'required'
        ], 
        [
            'password.required' => 'The password field is required.',
            'email.required' => 'The email field is required.',
            'email.email' => 'The email field must be a valid email address.',
        ]);

        if(auth()->attempt($formFields)){
            $request->session()->regenerate();

            session()->flash('success', 'You are now logged in!');
            return redirect('/');
        }

        return back()->withErrors(['email'=>'Invalid credentials'])->onlyInput('email');
    }
}
