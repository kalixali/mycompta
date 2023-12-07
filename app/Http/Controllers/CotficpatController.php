<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\cotficpat;
use App\Models\salaire;
use App\Models\employe;
use Illuminate\Support\Facades\DB;

class CotficpatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $cotficpat = DB::table('cotficpat')
        ->whereYear('created_at', date("Y", time()))
        ->orderBy('cotficpat.created_at')
        ->get();
        
        return view('cotficpat.index')->with('cotficpat', $cotficpat);
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
        cotficpat::create($input);

        $cotficpat = DB::table('cotficpat')
        ->orderBy('cotficpat.created_at')
        ->get();

        return view('cotficpat.index')->with('cotficpat', $cotficpat);
        
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
        $cotficpat = cotficpat::find($id);
        return view('cotficpat.edit')->with('cotficpat', $cotficpat);
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
        $cotficpat = cotficpat::find($id);
        $input = $request->all();
        $cotficpat->update($input);
        return redirect('cotficpat')->with('flash_message', 'CR modifié!');
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
        cotficpat::destroy($id);
        return redirect('cotficpat')->with('flash_message', 'Enregistrement supprimé!');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function search3(Request $request)
    {
        //
        $cotficpat = DB::table('cotficpat')
        ->orderBy('cotficpat.created_at')
        ->get();

        $salbimp = DB::table('salaire')->where('matricule', $request->matricule)->first();
        $salbimp1 = DB::table('employe')->where('matricule', $request->matricule)->first();
                
        $salbimp->t_is_p = $request->t_is_p_a;
        $salbimp->is_p = (intval($salbimp->salbimp) * floatval($salbimp->t_is_p))/100;
        $salbimp->t_ta_fdfp = $request->t_ta_fdfp_a;
        $salbimp->ta_fdfp = (intval($salbimp->salbimp) * floatval($salbimp->t_ta_fdfp))/100;

        $salbimp->t_fpc_fdfp = $request->t_fpc_fdfp_a;
        $salbimp->fpc_fdfp = (intval($salbimp->salbimp) * floatval($salbimp->t_fpc_fdfp))/100;
        return view('cotficpat.index1', ['salbimp' => $salbimp, 'salbimp1' => $salbimp1, 'cotficpat' => $cotficpat]);
    }


      /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getcotficpat(Request $request)
    {
        //
        $cotficpat = DB::table('cotficpat')
           ->whereBetween('created_at', [$request->from_date, $request->to_date])
           ->orderByDesc('cotficpat.created_at')
           ->get();
        //dd($journal);

        return view('cotficpat.index')->with('cotficpat', $cotficpat);
    }
}
