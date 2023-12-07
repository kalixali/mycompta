<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\employe;
use PDF;

class EmployeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $employes = DB::table('employe')
        ->orderBy('employe.nom')
        ->get();
        return view('employes.index')->with('employes', $employes);
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
        $filename = time().$request->file('photo')->getClientOriginalName();
        $path = $request->file('photo')->storeAs('images', $filename, 'public');
        $input["photo"] = '/storage/'.$path;
        employe::create($input);
        return redirect('employes')->with('flash_message','Enregistrement effectué!');
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
        $employes = employe::find($id);
        return view('employes.edit')->with('employes', $employes);
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
        $employes = employe::find($id);
        $input = $request->all();
        $employes->update($input);
        return redirect('employes')->with('flash_message', 'employes modifié!');
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
        employe::destroy($id);
        return redirect('employes')->with('flash_message', 'Enregistrement supprimé!');
    }

    public function EmployesPDF2()
    {
        
        $employe = DB::table('employe')
           ->orderBy('employe.matricule')
           ->get();
        
        $entreprise = DB::table('entreprise')->where('id', 1)->first();
        //dd($entreprise);
        
        $pdf = PDF::loadView('employes.employespdf', ['employe' => $employe, 'entreprise' => $entreprise])->setPaper('a4', 'landscape');

        return $pdf->download('Employes.pdf');
    }
}
