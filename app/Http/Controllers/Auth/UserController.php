<?php

namespace App\Http\Controllers\Auth;

// use App\Http\Controllers\Auth\Hash;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Session;

class UserController extends Controller
{

    // Create A default Admin User Funciton ?



    // first step to open the URL
    public function create()
    {
        return view('User.create');
    }
    // Storing the Data from The form on URL to store on database
    public function store(UserRequest $request)
    {

        // Check username is not Duplicated
        $request->validate(
            [
                'username' => 'required|string|max:255|unique:users,username'
            ],
            [
                // Show error message, and add if($errors->any())
                'username.unique' => 'This username is already taken. Please choose another.', // Custom error message
            ]
        );
        User::create([
            'username' => $request->username,
            'full_name' => $request->full_name,
            'password' => $request->password,
        ]);
        return redirect()->route('index.user');
    }

    // Index, show all users
    // open the URL
    public function index()
    {
        // Bring The data from database
        $users = User::all();
        // send the Data to URL while loading the URL of user.index View
        return view('User.index', compact('users'));
    }

    // Edit  1- Open the URL 2- Recieve and update
    public function edit($id)
    {
        $user = User::find($id);
        return view('User.edit', compact('user'));
    }
    // 2- update function when click on button
    public function update(Request $request)
    {
        $user = user::find($request->id); // the id sent on the form
        $user->update([
            'id' => $request->id,
            'full_name' => $request->full_name,
            'password' => $request->password
        ]);
        // Return to Index Page
        return redirect()->route('index.user');
    }

    public function showLoginForm()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }
        return view('welcome');
    }



    // Login Section start
    public function login(Request $request)
    {
        // Retrieve the first user that matches the username
        $user = User::where('username', $request->username)->first();
        // Check if the user exists and if the password matches
        if ($user && $request->password == $user->password && $user->active == false) {
            return redirect('/')->with('Fail', 'User deactivated');}
            elseif(  $user && $request->password == $user->password && $user->active == true  ){
                Auth::login($user);
                return redirect()->route('dashboard');
            }else{

                return redirect('/')->with('Fail', 'Wrong username or Password');
            }
        }
            // return redirect()->route('index.maintenance');


    // Update start
    // Update activations

    public function toggleActive($id)
    {
        $user = User::findOrFail($id);
        $user->active = !$user->active;
        $user->save();

        return redirect()->route('index.user')->with('success', 'User status updated successfully.');
    }
    // Update end
    
    public function logout(Request $request)
    {
        // Log the user out
        Auth::logout();
        
        // Invalidate the session
        $request->session()->invalidate();
        
        // Regenerate the CSRF token to prevent CSRF attacks
        $request->session()->regenerateToken();
        
        // Redirect the user to the login page or wherever you prefer
        return redirect('/')->with('status', 'You have been logged out successfully.');
    }
    // Logout Section end


    // Change Password
    public function change(){
        $user = Auth::user();
        return view('user.change',compact('user'));
    }
    public function changePass(Request $request){
        $user = user::find($request->id); // the id sent on the form
        $user->update([
            'id' => $request->id,
            'password' => $request->password
        ]);
        // Return to Index Page
        return redirect()->route('change.user')->with('success', 'Password Has changed successfully.');
    }
}
