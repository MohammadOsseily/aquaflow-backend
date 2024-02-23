<?php

namespace App\Http\Controllers;


use App\Models\User;
use Hash;
use Illuminate\Http\Request;
use Symfony\Component\Console\Input\Input;

use function Laravel\Prompts\alert;

class UserController extends Controller
{
    /**
     * Show the form for creating the resource.
     */
    public function create(): never
    {
        abort(404);
    }

    /**how-users
     * Store the newly created resource in storage.
     */
    public function store(Request $request): never
    {
        abort(404);
    }

    /**
     * Display the resource.
     */
    public function show()
    {
        //
        $user = User::get();
        return $user;
    }

    /**
     * Show the form for editing the resource.
     */
    public function edit()
    {
        //
    }

    /**
     * Update the resource in storage.
     */
    public function update(Request $request)
    {
        $user = user::find($request->input('id'));
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = $request->input('password');
        $user->update();
    }
    public function checkExist(Request $request)
    {
        $user = User::where("email", $request->input('email'))->first();

        if (isset($user)) {

            return $user;
        } else {

            return false;
        }
    }
    public function login(Request $request)
    {
        $user = $this->checkExist($request);
        if (isset($user)) {

            if ($user->password ==  Hash::make($request->input('password'))) {
            }
        } else {

            alert("the email or password doesn't exist.");
        }
    }
    public function register(Request $request)
    {
        $input['email'] = User::find($request->input('email'));

        $rules = array('email' => 'unique:users,email');
    }


    /**
     * Remove the resource from storage.
     */
    public function destroy()
    {
        User::truncate();
    }
}
