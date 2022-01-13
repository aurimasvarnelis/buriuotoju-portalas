<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $users = User::all();
        return view('admin.index')->with('users', $users);
    }

    public function edit(User $user)
    {
        return view('admin.edit')->withUser($user);
    }

    public function update(Request $request, User $user)
    {
        $validate = null;
        $validate = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|password',
            'role'  => 'required'   
        ]);

        /*$validate = null;
        $validate = $request->validate([
            'name' => 'required|min:2',
            'email' => 'required|email'
        ]);*/
        if($validate) {
            $user->name = $request['name'];
            $user->email = $request['email'];
            $user->password = $request['password'];
            $user->role = $request['role'];
            $user->save();
            $request->session()->flash('success', 'Vartotojas "' .$user->name. '" sėkmingai atnaujintas.');
            return redirect()->back();
        }
    }

    public function delete(Request $request, User $user)
    {  
        if($user->hasRole('admin')){
            $id = Auth::user()->id;
            //$currentuser = User::find($id);
            if($user->id != $id)
            {
                $user->delete();
                $msg = "Vartotojas " . $user->name ." ištrintas sėkmingai.";
                $request->session()->flash('success', $msg);
                return redirect()->route('admin.index');
            }

            $msg = "Negalima ištrinti savo paskyros " . $user->name .".";
            $request->session()->flash('danger', $msg);
            return redirect()->route('admin.index');
        }

        if($user->hasRole('user') || $user->hasRole('moderator')){    
            $user->delete();
            $msg = "Vartotojas " . $user->name ." ištrintas sėkmingai.";
            $request->session()->flash('success', $msg);
            return redirect()->route('admin.index');
        }
    }

    public function create()
    {
        return view('admin.create');
    }

    public function createUpdate(Request $request)
    {
        $validate = null;
        $validate = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'role'  => 'required'   
        ]);
        $user = new User();
        if($validate) {
            $user->name = $request['name'];
            $user->email = $request['email'];
            $user->password = Hash::make($request['password']);
            $user->role = $request['role'];
            $user->save();
            $request->session()->flash('success', 'Vartotojas "' .$user->name. '" sėkmingai sukurtas.');
            return redirect()->back();
        }

        return view('admin.create');
    }
}