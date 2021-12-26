<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{

    public function index() {
        return view('users.index', [
            'title' => 'Users list',
            'users' => User::all()
        ]);
    }

    public function create() {
        return view('users.add', [
            'title' => 'Add new user',
        ]);
    }

    public function store(Request $request) {
        $request->validate([
            'name' => ['required']
        ]);

        try {
            User::create([
                'name' => (string) $request->input('name'),
            ]);
            Session::flash('success', 'Create a user successfully');
        } catch(\Exception $error) {
            Session::flash('error', $error->getMessage());
        }

        return redirect()->back();
    }

    public function show(User $user) {
//        return view('users.edit', [
//            'title' => 'Edit user',
//            'user' => $user
//        ]);
    }

    public function edit(User $user) {
        return view('users.edit', [
            'title' => 'Edit user',
            'user' => $user
        ]);
    }

    public function update(Request $request, User $user) {
        $request->validate([
            'name' => ['required']
        ]);
        try {
            $user = User::find($user->id);
            $user->name = $request->input('name');
            $user->save();
            Session::flash('success', 'Update user successfully!');
        } catch(\Exception $error) {
            Session::flash('error', 'Update user failed. Please try again!!!');
            return redirect('/users');
        }

        return redirect('/users/' . $user->id . '/edit');
    }

    public function destroy(Request $request) {
//        dd('Delete user id: ' . $request->input('id'));
        $user = User::where('id', $request->input('id'))->first();

        if ($user) {
            $user->delete();
            return response()->json([
                'error' => false,
                'message' => 'Delete user successfully!'
            ]);
        }

        return response()->json([ 'error' => true ]);
    }
}
