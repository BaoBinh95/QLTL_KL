<?php

namespace App\Http\Controllers;

use Input;
use DB;
use Mail;
use Hash;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Department;
use App\Http\Requests\EditDepartmentRequest;
use App\Http\Requests\CreateDepartmentRequest;
use App\Http\Requests\CreateUserRequest;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $departments = Department::paginate(config('setting.paging_number'));

        return view('admin.departments.index', compact('departments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.departments.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateDepartmentRequest $request)
    {
        $department = new Department;
        $department->name = $request->name;
        $department->alias = $request->alias;
        $department->address = $request->address;
        $department->save();

        return redirect()->action('DepartmentController@index')->with('success', trans('session.department_add_success'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $department = Department::find($id);

        return \Response::json($department);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $department = Department::find($id);

        return \Response::json($department);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditDepartmentRequest $request, $id)
    {
        $department = Department::find($id);
        $department->name = $request->name;
        $department->alias = $request->alias;
        $department->address = $request->address;
        $department->save();

        return \Response::json([
            'msg' => 'success',
            $department
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $department = Department::find($id);

        DB::beginTransaction();
        try {
            $department->delete();
            DB::commit();

            return redirect()->action('DepartmentController@index')
                    ->with('success', trans('session.department_delete_success'));
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()
                ->action('DepartmentController@index');
        }
    }

    //Add User belongsTo Department
    public function getcreateUser($id) {
        $department = Department::find($id);

        return view('admin.departments.add_user', compact('department'));
    }

    public function createUser(CreateUserRequest $request, $id){
        $department = Department::find($id);
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make('secret');
        $user->id_role = config('setting.role.user');
        $user->id_department = $department->id;
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

        return redirect()->action('DepartmentController@index')->with('success', trans('session.user_create_success'));

    }
}
