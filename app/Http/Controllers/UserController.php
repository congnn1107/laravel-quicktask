<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $users = User::all();
        return view('pages.user.index', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        return view('pages.user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\CreateUserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateUserRequest $request)
    {
        //
        $params = $request->validated();
        $result = User::create($params);

        if ($result) {
            $key = "success";
            $message = __('pages.create_user_success');
        } else {
            $key = 'error';
            $message = __('pages.has_error');
        }

        return back()->with($key, $message);
    }

    /**
     * Display the specified resource.
     *
     * @param  $user
     * @return \Illuminate\Http\Response
     */
    public function show($user)
    {
        //
        $user = User::findOrFail($user);

        return view('pages.user.show', ['user' => $user, 'notes' => $user->notes]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($user)
    {
        //
        $user = User::findOrFail($user);

        return view('pages.user.edit', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateUserRequest  $request
     * @param  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, $user)
    {
        //
        $params = $request->only(['first_name', 'last_name']);

        $user = User::findOrFail($user);

        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;

        if ($user->id  != Auth::user()->id) {
            $user->is_active = !empty($request->is_active) ? 1 : 0;
        }

        if ($user->save()) {
            $key = 'success';
            $message = __('pages.update_success');
        } else {
            $key = 'error';
            $message = __('pages.has-error');
        }

        return back()->with($key, $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($user)
    {
        $user = User::findOrFail($user);
        $user->notes()->delete();
        $user->delete();

        return redirect()->route('user.index');
    }
}
