<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\salaire;
use App\Models\entreprise;
use App\Models\employe;
use Illuminate\Support\Facades\DB;
use PDF;

class BulletinController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('bulletin.index');
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

     //cette fonction n'est pas utilisée
    public function getbulletin(Request $request)
    {
        //
        $journal = DB::table('Journal')
           ->whereBetween('created_at', [$request->from_date, $request->to_date])
           ->whereBetween('compte', [$request->from_compte, $request->to_compte])
           ->orderByDesc('Journal.created_at')
           ->get();
        //dd($journal);

        return view('journal.index')->with('journal', $journal);
    }


    public function downloadPDF2(Request $request)
    {
        
        $salaire = DB::table('salaire')
           ->whereBetween('created_at', [$request->from_date, $request->to_date])
           ->whereBetween('matricule', [$request->from_matricule, $request->to_matricule])
           ->orderBy('salaire.created_at')
           ->get();
        
        $entreprise = DB::table('entreprise')->where('id', 1)->first();
        //dd($entreprise);
        $pdf = PDF::loadView('bulletin.pdf3', ['salaire' => $salaire, 'entreprise' => $entreprise]);
     
        return $pdf->download('bulletin.pdf');
    }

    

     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function searchfromat(Request $request)
    {
        //
        if($request->ajax()) {
            $data = employe::where('matricule', 'LIKE', $request->mat1.'%')->get();
            $output = ' ';
            if (count($data) > 0) {
                $output = '<ul class="list-group" style="display:block;position:relative;z-index:1">';
                    foreach($data as $row) {
                        $output .= '<li class="list-group-item" id="aa">' .$row->matricule.' - '.$row->nom.' - '.$row->prenoms.'</li>';
                    }
                $output .= '</ul>';
            } 
            else{
                //$output .= '<li class="list-group-item">Compte Non Defini</li>';
            }
            return $output;
        }
        
       // return view('journal.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function searchtomat(Request $request)
    {
        //
        if($request->ajax()) {
            $data = employe::where('matricule', 'LIKE', $request->mat2.'%')->get();
            $output1 = ' ';
            if (count($data) > 0) {
                $output1 = '<ul class="list-group" style="display:block;position:relative;z-index:1">';
                    foreach($data as $row) {
                        $output1 .= '<li class="list-group-item" id="bb">' .$row->matricule.' - '.$row->nom.' - '.$row->prenoms.'</li>';
                    }
                $output1 .= '</ul>';
            } 
            else{
                //$output .= '<li class="list-group-item">Compte Non Defini</li>';
            }
            return $output1;
        }
        
       // return view('journal.index');
    }
}
