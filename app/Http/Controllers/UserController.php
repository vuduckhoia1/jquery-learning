<?php

namespace App\Http\Controllers;


use App\Models\Post;
use App\Models\Skill;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    public function register()
    {
        $data['title'] = 'Register';
        return view('user/register', $data);
    }

    public function register_action(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'username' => 'required|unique:users',
            'password' => 'required',
            'password_confirmation' => 'required:same:password'
        ]);
        $user = new User([
            'email' => $request->email,
            'username' => $request->username,
            'password' => Hash::make($request->password)
        ]);
        $user->save();
        return redirect()->route('login')->with(['message' => 'registration success. Please login']);
    }

    public function login_action(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $request->session()->regenerate();
            return redirect()->intended('/');
        }
        return back()->withErrors(['msg' => 'Wrong email or password']);
    }

    public function login_action_admin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $request->session()->regenerate();
            return redirect('/admin_index');
        }
        return back()->withErrors(['msg' => 'Wrong email or password']);
    }
    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/login');
    }

    public function login()
    {
        $data['title'] = 'Login';
        return view('user/login', $data);
    }

    public function index()
    {

        // $this->authorize('index',auth()->user());
        $data['title'] = 'Users Index';
        $data['users'] = User::all();
        return view('admin/users', $data);
    }

    public function edit($id)
    {
        //        dd(auth()->user()->role==0||auth()->user()->role==0);
        //        dd(auth()->user()->id==$id);
        $cnt_user = User::whereId($id)->first();
        //        dd(auth()->user()->id==$cnt_user->id);
        $this->authorize('edit', $cnt_user);
        $data['title'] = 'Edit User';
        $data['user'] = User::findOrFail($id);
        return view('user/update', $data);
    }

    public function update(Request $request, $id)
    {
        $data['user'] = User::findOrFail($id);
        $pass = Hash::make($request->password);
        $role = $request->role;

        User::where(['id' => $id])->update(['email' => $request->email, 'username' => $request->username, 'password' => $pass, 'role' => $role]);

        return redirect()->route('user.index')->with('message', 'Update successfully!');
    }

    public function delete($id)
    {
        $this->authorize('destroy', auth()->user());
        Post::whereUser_id($id)->delete();
        User::where(['id' => $id])->delete();
        return redirect()->route('user.index')->with('message', 'Delete successfully!');
    }

    public function create()
    {
        return view('admin/users/new');
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'username' => 'required|unique:users',
            'password' => 'required',
        ]);
        $user = new User([
            'email' => $request->email,
            'username' => $request->username,
            'password' => Hash::make($request->password)
        ]);
        $user->save();

        foreach ($request->skills as $skill) {

            $skill_new = new Skill;
            $skill_new->name = $skill;
            $skill_new->user_id = $user->id;
            $skill_new->save();
        }

        return redirect()->route('users.index');
    }
}
