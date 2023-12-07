<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\codesjournaux;

class CodesjournauxController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $codesjournaux = codesjournaux::all();
        return view('codesjournaux.index')->with('codesjournaux', $codesjournaux);
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
        $input = $request->all();
        codesjournaux::create($input);
        return redirect('codesjournaux')->with('flash_message','Enregistrement effectué!');
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
        $codesjournaux = codesjournaux::find($id);
        return view('codesjournaux.edit')->with('codesjournaux', $codesjournaux);
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
        $codesjournaux = codesjournaux::find($id);
        $input = $request->all();
        $codesjournaux->update($input);
        return redirect('codesjournaux')->with('flash_message', 'Plan comptable modifié!');
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
        codesjournaux::destroy($id);
        return redirect('codesjournaux')->with('flash_message', 'Enregistrement supprimé!');
    }
}
