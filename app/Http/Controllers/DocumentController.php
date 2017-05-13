<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Document;
use App\Models\TypeDocument;
use App\Models\DocumentFile;
use App\Models\Department;
use App\Http\Requests\CreateDocumentRequest;
use Input;
use Auth;
use Carbon\Carbon;
use DB;
use App\Models\User;
use Khill\Lavacharts\Lavacharts;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //nếu user hiện tại là admin thì thấy tất cả các tài liệu
        if(Auth::user()->hasRole('admin')) {
            $data = DB::table('users')
                        ->join('documents', 'users.id', '=', 'documents.id_user')
                        ->join('document_files', 'documents.id', '=', 'document_files.id_document')
                        ->get();

            $documents = Document::paginate(config('setting.paging_number'));
        }
        //nếu user hiện tại là manager, user thì thấy các tài liệu public và tài liệu của các nhân viên phòng mình quản lý.
        else {
            $data = DB::table('users')
                        ->join('documents', 'users.id', '=', 'documents.id_user')
                        ->join('document_files', 'documents.id', '=', 'document_files.id_document')
                        ->where('status', '=', 0)
                        ->orWhere('users.id_department', '=', Auth::user()->id_department)
                        ->get();

            $documents = DB::table('users')
                        ->join('documents', 'users.id', '=', 'documents.id_user')
                        ->where('status', 0)
                        ->orWhere('users.id_department', '=', Auth::user()->id_department)
                        ->paginate(config('setting.paging_number'));
        }

        return view('users.documents.index',compact('documents', 'data'));
    }

    //show my documents
    public function mydocument()
    {
        //user hiện tại
        $user = Auth::user();
        //Tai lieu cua id hien tai
        $data = DB::table('documents')
                        ->join('document_files', 'document_files.id_document', '=', 'documents.id')
                        ->where('id_user', $user->id)
                        ->get();
        //dd($data);
        $documents = Document::where('id_user', $user->id)->paginate(config('settings.paging_number'));

        return view('users.user.mydocument', compact('documents', 'data'));

    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $typedocuments = TypeDocument::pluck('name', 'id');

        return view('users.documents.create', compact('typedocuments'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateDocumentRequest $request)
    {
        //lấy department của user hiện tại
        $user = Auth::user()->id_department;
        $department_user = Department::find($user)->alias;
        //upload file
        $document = new Document;
        $document->title = $request->title;
        $document->description = $request->description;
        $document->status = $request->status;
        $document->id_user = Auth::user()->id;
        $document->id_typedoc = $request->id_typedoc;
        $document->created_at = Carbon::now();
        $document->updated_at = Carbon::now();
        $document->save();
        //upload multi file
        $files = Input::file('content');
        $file_count = count($files);
        $uploadcount = 0;
        // save into database
        foreach ($files as $file) {
            $documentFiles = new DocumentFile;
            if(isset($file)) {
                $destinationPath = 'file_upload';
                $file_name = uniqid() . '[' . $department_user . ']' . ' ' . $file->getClientOriginalName();
                $upload_success = $file->move($destinationPath, $file_name);
                $documentFiles->content = $file_name;
                $documentFiles->id_document = $document->id;
                $documentFiles->save();
                $uploadcount ++;
            }
        }

        if($uploadcount == $file_count) {
            return redirect()->action('DocumentController@index')->with('success', trans('session.document_add_success'));
        } else {
            return redirect()->action('DocumentController@index')
                ->with('errors', trans('session.document_upload_fail'));
        }
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
        $document = Document::find($id);
        $typedocuments = TypeDocument::pluck('name', 'id');
        $document_files = $document->documentFiles;
        //dd($document_files);
        return view('users.documents.edit', compact('document', 'typedocuments', 'document_files'));
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
        $document = Document::find($id);
        //update thông tin document
        $document->title = $request->title;
        $document->description = $request->description;
        $document->status = $request->status;
        $document->save();

        //alias department cua user hien tai
        $user = Auth::user()->id_department;
        $department_user = Department::find($user)->alias;

        // xóa các file cũ trong csdl
        // $oldFiles = $document->documentFiles;
        // foreach ($oldFiles as $file) {
        //     $destinationPath = 'documents/';
        //     \File::delete($destinationPath . $file->content);

        //     $file->delete();
        // }

        //upload file mới
        $files = Input::file('content');

        $file_count = count($files);
        $uploadcount = 0;
        if($file_count != 0) {
            foreach ($files as $file) {
                $documentFiles = new DocumentFile;
                if(isset($file)) {
                    $destinationPath = 'file_upload/';
                    $file_name = uniqid() . '[' . $department_user . ']' . ' ' . $file->getClientOriginalName();
                    $upload_success = $file->move($destinationPath, $file_name);
                    $documentFiles->content = $file_name;
                    $documentFiles->id_document = $document->id;
                    $documentFiles->save();
                    $uploadcount ++;
                }
            }
        }

        if($uploadcount == $file_count) {
            return redirect()->action('DocumentController@index')->with('success', trans('session.document_edit_success'));
        } else {
            return redirect()->action('DocumentController@index')
                ->with('errors', trans('session.document_upload_fail'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            // xóa document
            $document = Document::find($id);
            // xóa file trong thư mục public
            $document_files = DocumentFile::where('id_document', '=', $document->id)->get();
            foreach ($document_files as $file) {
                $destinationPath = 'file_upload/';
                \File::delete($destinationPath . $file->content);
            }

            $document->delete();

            return redirect()->action('DocumentController@index')
                ->with('success', trans('session.document_delete_success'));
        } catch(Exception $e) {
            return redirect()->action('DocumentController@index')
                ->with('errors', trans('session.document_delete_fail'));
        }
    }

    //DashBoard
    public function dashboard()
    {
        // thong ke
        $allDoc= Document::all();
        $allDepartment = Department::all();

        foreach ($allDepartment as $item) {
            $item->countDoc = DB::table('departments')
                    ->join('users', 'users.id_department', '=', 'departments.id')
                    ->join('documents', 'documents.id_user', '=', 'users.id')
                    ->where('id_department', $item->id)
                    ->count();
        }
        // chart
        $lava = new Lavacharts; // See note below for Laravel

        $reasons = $lava->DataTable();

        $reasons->addStringColumn('Reasons')
                ->addNumberColumn('Percent');
        foreach($allDepartment as $item) {
            $reasons->addRow([$item->name, $item->countDoc]);
        }

        $lava->PieChart('IMDB', $reasons, [
            'is3D'   => true,
            'slices' => [
                ['offset' => 0.2],
                ['offset' => 0.25],
                ['offset' => 0.3]
            ]
        ]);

        return view('admin.dashboard', compact('allDoc', 'allDepartment', 'lava'));
    }

    // List document of a department
    public function documentDepartment($departmentID)
    {
        $department = Department::find($departmentID);

        $documents = DB::table('users')->where('id_department', $department->id)
                    ->join('documents', 'documents.id_user', '=', 'users.id')
                    ->paginate(config('setting.paging_number'));
        $data = DB::table('documents')->join('document_files', 'id_document', '=', 'documents.id')->get();

        return view('admin.departments.documents', compact('documents', 'data'));
    }
}
