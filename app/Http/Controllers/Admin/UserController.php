<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use DB;
use Mail;
use App\Models\Department;
use App\Http\Requests\CreateUserRequest;

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
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $departments = Department::all();

        return view('admin.users.create', compact('departments'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateUserRequest $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = \Hash::make('secret');
        $user->id_role = config('setting.role.user');
        $user->id_department = $request->department;
        $user->save();

        $data = array(
            'name' => $user->name,
            'email' => $user->email,
            'password' => 'secret',
        );


        Mail::send('emails.reminder', ['data' => $data], function($message) use ($user) {
            $message->from('phamha.test@gmail.com', 'Document Mamagement');
            $message->to($user->email)->subject(' This is your account\'s Document Mamagement !');
        });

        return redirect()->action('UserController@index')->with('success', trans('session.user_create_success'));

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);

        DB::beginTransaction();
        try {
            $user->delete();
            DB::commit();

            return redirect()->action('UserController@index')
                    ->with('success', trans('session.user_delete_success'));
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()
                ->action('UserController@index');
        }
    }

    // set manager
    public function setManager($id)
    {
        $user = User::find($id);
        //tim phong ban hien tai cua user
        $manager = User::where('id_department', $user->id_department)->where('id_role', 2)->first();
        //phong ban chua co truong phong
        if (count($manager) == 0) {
            $user->id_role = config('setting.role.manager');
            $user->save();
            return redirect()->action('UserController@listUserDepartment', $user->id_department)->with('success', trans('session.user_update_manager_success'));
        } else {
            $user->id_role = config('setting.role.manager');
            $user->save();
            $manager->id_role = config('setting.role.user');
            $manager->save();

            return redirect()->action('UserController@listUserDepartment', $user->id_department)->with('success', trans('session.user_update_manager_success'));

        }

        return redirect()->action('UserController@listUserDepartment', $user->id_department)->withErrors(trans('session.not_found'));
    }
}
