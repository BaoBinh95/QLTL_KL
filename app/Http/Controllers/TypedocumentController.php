<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TypeDocument;
use DB;
use App\Http\Requests\CreateTypeDocumentRequest;

class TypedocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $typedocuments = TypeDocument::paginate(config('setting.paging_number'));

        return view('users.typedocument.index', compact('typedocuments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.typedocument.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateTypeDocumentRequest $request)
    {
        $typeDocument = new TypeDocument;
        $typeDocument->name = $request->name;
        $typeDocument->description = $request->description;
        $typeDocument->save();

        return redirect()->action('TypedocumentController@index')->with('success', trans('session.typedoc_add_success'));
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
        $typedocument = TypeDocument::find($id);

        return \Response::json($typedocument);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CreateTypeDocumentRequest $request, $id)
    {
        $typeDocument = TypeDocument::find($id);
        $typeDocument->name = $request->name;
        $typeDocument->description = $request->description;
        $typeDocument->save();

        return \Response::json([
            'msg' => 'success',
            $typeDocument
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
        $typedocument = TypeDocument::find($id);

        DB::beginTransaction();
        try {
            $typedocument->delete();
            DB::commit();

            return redirect()->action('TypedocumentController@index')
                    ->with('success', trans('session.typedocument_delete_success'));
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()
                ->action('TypedocumentController@index');
        }
    }
}
