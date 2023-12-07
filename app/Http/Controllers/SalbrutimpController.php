<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\salbrutimp;
use App\Models\employes;
use App\Models\avtagenat;
use App\Models\entreprise;
use App\Models\cotsocemp;
use App\Models\cotficemp;
use App\Models\retenues;
use App\Models\indemnite;


use Illuminate\Support\Facades\DB;
use PDF;

class SalbrutimpController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
       $salbrutimp = DB::table('salbrutimp')
        ->whereYear('created_at', date("Y", time()))
        ->orderBy('salbrutimp.created_at')
        ->get();

        return view('salbrutimp.index')->with('salbrutimp', $salbrutimp);
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
        salbrutimp::create($input);

        $salbrutimp = DB::table('salbrutimp')
        ->orderBy('salbrutimp.created_at')
        ->get();

        return view('salbrutimp.index')->with('salbrutimp', $salbrutimp);
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
        $salbrutimp = salbrutimp::find($id);
        return view('salbrutimp.edit')->with('salbrutimp', $salbrutimp);
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
        $salbrutimp = salbrutimp::find($id);
        $input = $request->all();
        $salbrutimp->update($input);
        return redirect('salbrutimp')->with('flash_message', 'CR modifié!');
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
        salbrutimp::destroy($id);
        return redirect('salbrutimp')->with('flash_message', 'Enregistrement supprimé!');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        //
        $salbrutimp = DB::table('salbrutimp')
        ->orderBy('salbrutimp.created_at')
        ->get();
        //$salbrutimp = DB::table('salbrutimp')->where('matricule', $request->matricule)->first();
        $empl = DB::table('employes')->where('matricule', $request->matricule)->first();
        //$avg = DB::table('avtagenat')->where('matricule', $request->matricule)->orderByDesc('avtagenat.created_at')->limit(1)->get();

        $avg = DB::table('avtagenat')->where('matricule', $request->matricule)->whereMonth ('created_at', date("m", time()))->get();
        //dd($avg);
        $prime = DB::table('prime')->where('matricule', $request->matricule)->whereMonth ('created_at', date("m", time()))->get();
        //dd($prime);
        $heuresup = DB::table('heuresup')->where('matricule', $request->matricule)->whereMonth ('created_at', date("m", time()))->get();
        $indemnite = DB::table('indemnite')->where('matricule', $request->matricule)->whereMonth ('created_at', date("m", time()))->get();
        $indemnitetax = DB::table('indemnitetax')->where('matricule', $request->matricule)->whereMonth ('created_at', date("m", time()))->get();
        $retenues = DB::table('retenues')->where('matricule', $request->matricule)->whereMonth ('created_at', date("m", time()))->get();
        $cotsocemp = DB::table('cotsocemp')->where('matricule', $request->matricule)->whereMonth ('created_at', date("m", time()))->get();
        $cotficemp = DB::table('cotficemp')->where('matricule', $request->matricule)->whereMonth ('created_at', date("m", time()))->get();


        $empl->totavtagenat = intval($avg[0]->avg_logement) + intval($avg[0]->avg_vehicule) + intval($avg[0]->avg_otr);
        
        $empl->totprimes = intval($prime[0]->prime_ancien) + intval($prime[0]->prime_diplo) + intval($prime[0]->prime_rendement) + intval($prime[0]->prim_risq) + intval($prime[0]->prime_otr);

        $empl->totmhs = intval($heuresup[0]->msup15) + intval($heuresup[0]->msup50) + intval($heuresup[0]->msup75) + intval($heuresup[0]->msup100);

        $empl->totindemnite = intval($indemnite[0]->ind_salissure) + intval($indemnite[0]->ind_trsport) + intval($indemnite[0]->ind_outillage) + intval($indemnite[0]->ind_tournee) + intval($indemnite[0]->ind_otr);
        $empl->totindemnitetax = intval($indemnitetax[0]->ind_logement) + intval($indemnitetax[0]->ind_nourriture) + intval($indemnitetax[0]->ind_otr);

        $empl->totretenues = intval($retenues[0]->accompte) + intval($retenues[0]->avance) + intval($retenues[0]->autres);
        $empl->totcotsocemp = intval($cotsocemp[0]->cr);

        $empl->totcotficemp = intval($cotficemp[0]->is) + intval($cotficemp[0]->cn) + intval($cotficemp[0]->igr);

        
        $empl->salbimp = intval($empl->salbase) + intval($empl->sursal) + intval($empl->totavtagenat) + intval($empl->totprimes) + intval($empl->totmhs);

        $empl->salnet = intval($empl->salbimp) - intval($empl->totcotsocemp) - intval($empl->totcotficemp);

        $empl->salpaye = intval($empl->salnet) - intval($empl->totretenues) + intval($indemnite[0]->ind_trsport);
        //dd($empl->salpaye);

        return view('salbrutimp.index1', ['empl' => $empl, 'salbrutimp' => $salbrutimp]);
    }


    public function downloadPDF(Request $request)
    {
        //$salbrutimp = DB::table('salbrutimp')
        //->orderBy('salbrutimp.created_at')
        //->get();
        $salbrutimp = DB::table('salbrutimp')->where('matricule', $request->matricule)->first();
        $empl = DB::table('employes')->where('matricule', $request->matricule)->first();
        $avg = DB::table('avtagenat')->where('matricule', $request->matricule)->first();
        $prime = DB::table('prime')->where('matricule', $request->matricule)->first();
        $heuresup = DB::table('heuresup')->where('matricule', $request->matricule)->first();
         $cotsocemp = DB::table('cotsocemp')->where('matricule', $request->matricule)->first();
        $cotficemp = DB::table('cotficemp')->where('matricule', $request->matricule)->first();
        $retenues = DB::table('retenues')->where('matricule', $request->matricule)->first();
        $indemnite = DB::table('indemnite')->where('matricule', $request->matricule)->first();

        $entreprise = DB::table('entreprise')->where('id', 1)->first();


        $empl->totavtagenat = intval($avg->avg_logement) + intval($avg->avg_vehicule) + intval($avg->avg_otr);
        $empl->totprimes = intval($prime->prime_ancien) + intval($prime->prime_diplo) + intval($prime->prime_rendement) + intval($prime->prim_risq) + intval($prime->prime_otr);
        $empl->totmhs = intval($heuresup->msup15) + intval($heuresup->msup50) + intval($heuresup->msup75) + intval($heuresup->msup100);
        
        $empl->salbimp = intval($empl->salbase) + intval($empl->sursal) + intval($empl->totavtagenat) + intval($empl->totprimes) + intval($empl->totmhs);

        $empl->salnet = intval($empl->salbimp) + intval($cotsocemp->cr) + intval($cotficemp->cn) + intval($cotficemp->is) + intval($cotficemp->igr);
        
        $empl->salpay = intval($empl->salnet) + intval($retenues->accompte) + intval($retenues->avance) + intval($indemnite->ind_trsport);
                  
        $pdf = PDF::loadView('salbrutimp.pdf2', ['empl' => $empl, 'salbrutimp' => $salbrutimp, 'entreprise' => $entreprise, 'heuresup' => $heuresup, 'cotsocemp' => $cotsocemp, 'cotficemp' => $cotficemp, 'retenues' => $retenues, 'indemnite' => $indemnite]);

        return $pdf->download('bulletin.pdf');

    }

    


     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getsalbrutimp(Request $request)
    {
        //
        $salbrutimp = DB::table('salbrutimp')
           ->whereBetween('created_at', [$request->from_date, $request->to_date])
           ->orderByDesc('salbrutimp.created_at')
           ->get();
        //dd($journal);

        return view('salbrutimp.index')->with('salbrutimp', $salbrutimp);
    }

     
    
}
