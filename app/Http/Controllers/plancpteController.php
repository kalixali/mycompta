<?php

namespace App\Http\Controllers;
use App\Models\plancpte;

use Illuminate\Http\Request;

class plancpteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $plancpte = plancpte::all();
        return view('plancpte.index')->with('plancpte', $plancpte);
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
        plancpte::create($input);
        return redirect('plancpte')->with('flash_message','Enregistrement effectué!');
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
        $plancpte = plancpte::find($id);
        return view('plancpte.edit')->with('plancpte', $plancpte);
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
        $plancpte = plancpte::find($id);
        $input = $request->all();
        $plancpte->update($input);
        return redirect('plancpte')->with('flash_message', 'Plan comptable modifié!');
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
        plancpte::destroy($id);
        return redirect('plancpte')->with('flash_message', 'Enregistrement supprimé!');
    }
}
