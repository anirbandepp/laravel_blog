<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function index()
    {
        $users = User::latest()->paginate(20);
        return view('admin.user.index', ['users' => $users]);
    }

    public function create()
    {
        return view('admin.user.create');
    }

    public function store(Request $r)
    {
        $validate =  $this->validate($r, [
            'name' => 'required|string|max:255',
            'email' => 'require|email|unique:users,email',
            'password' => 'required|min:8',
        ]);

        $user = User::create([
            'name' => $r->name,
            'email' => $r->email,
            'password' => bcrypt($r->password),
            'description' => $r->description,
        ]);

        Session::flash('success', 'User created successfully');
        return redirect()->back();
    }

    public function edit($id)
    {
        $user = User::find($id);
        return view('admin.user.edit', ['user' =>  $user]);
    }

    public function update(Request $r)
    {
        $user = User::find($r->id);
        $user->name = $r->name;
        $user->email = $r->email;
        $user->password = bcrypt($r->password);
        $user->description = $r->description;
        $user->update();

        Session::flash('success', 'User updated successfully');
        return redirect()->route('user_index');
    }

    public function destory($id)
    {
        $obj = User::find($id);
        $obj->delete();
        Session::flash('success', 'User deleted successfully');
        return redirect()->route('user_index');
    }

    public function show()
    {
        $u = Auth::user();
        $w = array(
            'info' => $u
        );
        return view('admin.user.show')->with($w);
    }

    public function profile_update(Request $r)
    {
        $this->validate($r, [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,$user->id',
            'password' => 'sometimes|nullable|min:8',
            'image' => 'sometimes|nullable|image|max:2048'
        ]);

        $name = $r->name;
        $email = $r->email;
        $password = bcrypt($r->password);
        $description = $r->description;

        $id =  auth()->user()->id;

        $obj = User::find($id);
        $obj->name = $name;
        $obj->email = $email;
        $obj->password = $password;
        $obj->description = $description;

        if ($r->hasFile('image')) {
            $image = $r->image;
            $img_new_name = time() . '.' .  $image->getClientOriginalExtension();
            $image->move('storage/user/', $img_new_name);
            // Save image into database
            $obj->image =  'storage/user/' . $img_new_name;
        }
        $obj->update();

        Session::flash('success', 'User updated successfully');
        return redirect()->route('user_index');
    }
}
