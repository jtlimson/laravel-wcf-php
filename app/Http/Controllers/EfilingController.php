<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Efiling;

class EfilingController extends Controller
{

    
    public function CopyToBackUp(Request $request) {

        $client = new Efiling();
        $branch = "01";
        $result = $client->CopyToBackUp($request->pin, $branch);
        return redirect()->route('GetStagingFiles', $request->pin);
    }

    public function CreateStagingDirectory()
    {
        return view('CreateStagingDirectory');
    } 

    public function PostCreateStagingDirectory(Request $request)
    {
     
        $client = new Efiling();
        $branch = "01";
        $result = $client->CreateStagingDirectory($request->pin, $branch);       
        return redirect()->route('index'); //redirect to index
    }

    public function DeleteStagingDirectory(Request $request) 
    {
        $client = new Efiling();
        $branch = "01";
        $result = $client->DeleteStagingDirectory($request->pin, $branch);
        return redirect()->route('index'); //redirect to index
    }
    
    public function DeleteStagingFiles(Request $request) {

        $client = new Efiling();
        $branch = "01";
        $result = $client->DeleteStagingFiles($request->pin, $request->fileName, $branch);
        
        return redirect()->route('GetStagingFiles', $request->pin);
    }


    public function GetStagingFiles(Request $request)
    {
        $client = new Efiling();
        $branch = "01";
        $result = $client->GetStagingFiles($request->pin, $branch);
        return view('getstagingfiles')->withData($result);
    }

    public function GetFiles(Request $request) 
    {
        return null; // view
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $client = new Efiling();
        $branch = "01";

        $result = $client->GetStagingDirectories($branch);

      //  if(!is_array($result)) $result = [$result];

        return view('index')->withData($result);
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
        //
    }
}
