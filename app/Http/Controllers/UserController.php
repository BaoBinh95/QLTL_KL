<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Department;
use Gate;
use Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::paginate(config('setting.paging_number'));

        return view('users.user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $currentUser = Auth::user();
        $user = User::findOrFail($id);

        return view('users.profile.show', compact('user', 'currentUser'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        if (Gate::allows('update-info', $id)) {
            $user->name = $request->name;

            if ($request->hasFile('avatar')) {
                $avatar = $request->file('avatar');
                $filename = str_slug($user->name) . '-' . $avatar->getClientOriginalName();
                $request->file('avatar')->move(base_path() . '/public/images/avatar/', $filename);
                $user->avatar = 'images/avatar/' . $filename;
            }

            $user->save();

            $request->session()->flash('success', trans('session.user_update_success'));

            return back();
        }

        abort(403, trans('error.403'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    //List user in a department
    public function listUserDepartment($id)
    {
        $department = Department::find($id);
        $users = User::where('id_department', $department->id)->paginate(config('setting.paging_number'));

        return view('admin.users.users_department', compact('users', 'department'));

    }
}
