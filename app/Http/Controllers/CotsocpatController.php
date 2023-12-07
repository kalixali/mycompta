<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\cotsocpat;
use App\Models\salaire;
use Illuminate\Support\Facades\DB;

class CotsocpatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $cotsocpat = DB::table('cotsocpat')
        ->whereYear('created_at', date("Y", time()))
        ->orderBy('cotsocpat.created_at')
        ->get();
        return view('cotsocpat.index')->with('cotsocpat', $cotsocpat);
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
        cotsocpat::create($input);

        $cotsocpat = DB::table('cotsocpat')
        ->orderBy('cotsocpat.created_at')
        ->get();

        return view('cotsocpat.index')->with('cotsocpat', $cotsocpat);

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
        $cotsocpat = cotsocpat::find($id);
        return view('cotsocpat.edit')->with('cotsocpat', $cotsocpat);
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
        $cotsocpat = cotsocpat::find($id);
        $input = $request->all();
        $cotsocpat->update($input);
        return redirect('cotsocpat')->with('flash_message', 'Enregistrement modifié!');
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
        cotsocpat::destroy($id);
        return redirect('cotsocpat')->with('flash_message', 'Enregistrement supprimé!');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function search4(Request $request)
    {
        //
        $cotsocpat = DB::table('cotsocpat')
        ->orderBy('cotsocpat.created_at')
        ->get();

        $salbimp = DB::table('salaire')->where('matricule', $request->matricule)->first();
                
        $salbimp->t_prest_fam = $request->t_prest_fam_a;
        $salbimp->prest_fam = (intval($salbimp->salbimp) * floatval($salbimp->t_prest_fam))/100;
        $salbimp->t_acc_trv = $request->t_acc_trv_a;
        $salbimp->acc_trv = (intval($salbimp->salbimp) * floatval($salbimp->t_acc_trv))/100;

        $salbimp->t_cr_p = $request->t_cr_p_a;
        $salbimp->cr_p = (intval($salbimp->salbimp) * floatval($salbimp->t_cr_p))/100;
        return view('cotsocpat.index1', ['salbimp' => $salbimp, 'cotsocpat' => $cotsocpat]);
    }

      /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getcotsocpat(Request $request)
    {
        //
        $cotsocpat = DB::table('cotsocpat')
           ->whereBetween('created_at', [$request->from_date, $request->to_date])
           ->orderByDesc('cotsocpat.created_at')
           ->get();
        //dd($journal);

        return view('cotsocpat.index')->with('cotsocpat', $cotsocpat);
    }
}
