<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\fournisseurs;
use App\Models\plancpte;

class FournisseurController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $fournisseurs = DB::table('fournisseurs')
        ->orderByDesc('fournisseurs.created_at')
        ->get();
       
        return view('fournisseurs.index')->with('fournisseurs', $fournisseurs);
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
        $inp =array('compte'=>$request->cptef, 'Libelle'=>$request->siglefourn);
        fournisseurs::create($input);
        plancpte::create($inp);
        return redirect('fournisseurs')->with('flash_message','Enregistrement effectué!');
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
        $fournisseurs = fournisseurs::find($id);
        return view('fournisseurs.edit')->with('fournisseurs', $fournisseurs);
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
        $fournisseurs = fournisseurs::find($id);
        $input = $request->all();
        $fournisseurs->update($input);
        return redirect('fournisseurs')->with('flash_message', 'fournisseurs modifié!');
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
        fournisseurs::destroy($id);
        return redirect('fournisseurs')->with('flash_message', 'Enregistrement supprimé!');
    }
}
