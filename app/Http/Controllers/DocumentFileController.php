<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DocumentFile;

class DocumentFileController extends Controller
{

    // Down load file

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
        $file = DocumentFile::find($id);
        $content = $file->content;
        $extension = \File::extension('file_upload/'. $content);
        $response = \Response::make('file_upload/' . $file->content, 200);

        return response()->download('file_upload/'. $content);

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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $documentfile = DocumentFile::find($id);
        $destinationPath = 'file_upload/';
            \File::delete($destinationPath . $documentfile->content);
        $documentfile->delete();

        return response()->json([
            'success' => 'File đã được xóa'
        ]);
    }
}
