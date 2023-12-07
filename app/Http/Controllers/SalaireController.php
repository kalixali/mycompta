<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\employe;
use App\Models\salaire;
use App\Models\journal;
use Illuminate\Support\Facades\DB;
use PDF;


class SalaireController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $salaire = DB::table('salaire')
        ->whereYear('created_at', date("Y", time()))
        ->whereMonth ('created_at', date("m", time()))
        ->orderByDesc('salaire.created_at')
        ->get();

        return view('salaire.index')->with('salaire', $salaire);
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
        salaire::create($input);

        $salaire = DB::table('salaire')
        ->whereYear('created_at', date("Y", time()))
        ->whereMonth ('created_at', date("m", time()))
        ->orderByDesc('salaire.created_at')
        ->get();

        return view('salaire.index')->with('salaire', $salaire);
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
        $salaire = salaire::find($id);
        return view('salaire.edit')->with('salaire', $salaire);
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
        $salaire = salaire::find($id);
        $input = $request->all();
        $salaire->update($input);
        return redirect('salaire')->with('flash_message', 'salaire modifié!');
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
        salaire::destroy($id);
        return redirect('salaire')->with('flash_message', 'Enregistrement supprimé!');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function searchsal(Request $request)
    {
        //
        $salaire = DB::table('salaire')
        ->whereYear('created_at', date("Y", time()))
        ->whereMonth ('created_at', date("m", time()))
        ->orderByDesc('salaire.created_at')
        ->get();
        
        $emp = DB::table('employe')->where('matricule', $request->matricule)->first();
        return view('salaire.index1', ['emp' => $emp, 'salaire' => $salaire]);
    }


     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getsalaire(Request $request)
    {
        //
        $salaire = DB::table('salaire')
           ->whereBetween('created_at', [$request->from_date, $request->to_date])
           ->orderByDesc('salaire.created_at')
           ->get();
        
        return view('salaire.index')->with('salaire', $salaire);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function comptasalaire()
    {
        //
        //Afficher le journal
        $journal = DB::table('Journal')
        ->whereYear('created_at', date("Y", time()))
        ->whereMonth ('created_at', date("m", time()))
        ->orderByDesc('Journal.created_at')
        ->get();
       
        return view('salaire.cptapaie')->with('journal', $journal);
    }

    //Comptabiliser la paie

     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function comptasal(Request $request)
    {
        if (DB::table('salaire')->where('cptabiliser', '=', 'False')->whereBetween('created_at', [$request->from_date, $request->to_date])->exists()) {   
        //Appointements et primes du mois 
            $Tsalbase = DB::table('salaire')
           ->select(DB::raw('SUM(salbase) + SUM(sursal) as Tsalbase'))
           ->where('nation', '=', 'Ivoirienne')
           ->where('cptabiliser', '=', 'False')
           ->whereBetween('created_at', [$request->from_date, $request->to_date])
           ->get();
            //dd($Tsalbase);
           $Tprimes = DB::table('salaire')
           ->select(DB::raw('SUM(totprimes) as Tprimes'))
           ->where('nation', '=', 'Ivoirienne')
           ->where('cptabiliser', '=', 'False')
           ->whereBetween('created_at', [$request->from_date, $request->to_date])
           ->get();

           $Tsalbase1 = DB::table('salaire')
           ->select(DB::raw('SUM(salbase) + SUM(sursal) as Tsalbase'))
           ->where('nation', '<>', 'Ivoirienne')
           ->where('cptabiliser', '=', 'False')
           ->whereBetween('created_at', [$request->from_date, $request->to_date])
           ->get();
           
           $Tprimes1 = DB::table('salaire')
           ->select(DB::raw('SUM(totprimes) as Tprimes'))
           ->where('nation', '<>', 'Ivoirienne')
           ->where('cptabiliser', '=', 'False')
           ->whereBetween('created_at', [$request->from_date, $request->to_date])
           ->get();
           $Tindemnite = DB::table('salaire')
           ->select(DB::raw('SUM(totindemnitetax) + SUM(totindemnite) as Tindemnite'))
           ->where('cptabiliser', '=', 'False')
           ->whereBetween('created_at', [$request->from_date, $request->to_date])
           ->get();
        $journal0 = array('compte'=>'6611', 'libellé'=>'Appointements, personnel national', 'Mdebit'=>$Tsalbase[0]->Tsalbase);
        $journalp = array('compte'=>'6612', 'libellé'=>'Primes et gratifications, personnel national', 'Mdebit'=>$Tprimes[0]->Tprimes);
        $journal1 = array('compte'=>'6621', 'libellé'=>'Appointements, personnel non national', 'Mdebit'=>$Tsalbase1[0]->Tsalbase);
        $journalp1 = array('compte'=>'6622', 'libellé'=>'Primes et gratifications, personnel non national', 'Mdebit'=>$Tprimes1[0]->Tprimes);
        $journalind = array('compte'=>'6638', 'libellé'=>'Indemnités forfaitaires', 'Mdebit'=>$Tindemnite[0]->Tindemnite);
        $remuneration = $Tsalbase[0]->Tsalbase+$Tprimes[0]->Tprimes+$Tsalbase1[0]->Tsalbase+$Tprimes1[0]->Tprimes+$Tindemnite[0]->Tindemnite;
       
        $journalremuneration= array('compte'=>'422', 'libellé'=>'Renumerations dues', 'Mcredit'=>$remuneration);
        //accompte - avance - cr et charges fiscales à deduire
        $Taccompte = DB::table('salaire')
           ->select(DB::raw('SUM(accompte) as Taccompte'))
           ->where('cptabiliser', '=', 'False')
           ->whereBetween('created_at', [$request->from_date, $request->to_date])
           ->get();
        $Tavance = DB::table('salaire')
           ->select(DB::raw('SUM(avance) as Tavance'))
           ->where('cptabiliser', '=', 'False')
           ->whereBetween('created_at', [$request->from_date, $request->to_date])
           ->get();
        $Tcr = DB::table('salaire')
           ->select(DB::raw('SUM(cr) as Tcr'))
           ->where('cptabiliser', '=', 'False')
           ->whereBetween('created_at', [$request->from_date, $request->to_date])
           ->get();
        
        $Tchargfisc = DB::table('salaire')
           ->select(DB::raw('SUM(igr) + SUM(imps) + SUM(cn) as Tchargfisc'))
           ->where('cptabiliser', '=', 'False')
           ->whereBetween('created_at', [$request->from_date, $request->to_date])
           ->get();
         
        $remuneration1 = $Taccompte[0]->Taccompte+$Tavance[0]->Tavance+$Tcr[0]->Tcr+$Tchargfisc[0]->Tchargfisc;
        
        $journalremuneration1= array('compte'=>'422', 'libellé'=>'Renumerations dues', 'Mdebit'=>$remuneration1);
        $journalav = array('compte'=>'4211', 'libellé'=>'Personnel, Avances', 'Mcredit'=>$Tavance[0]->Tavance);
        $journalac = array('compte'=>'4212', 'libellé'=>'Personnel, Accomptes', 'Mcredit'=>$Taccompte[0]->Taccompte);
        $journalcr = array('compte'=>'4313', 'libellé'=>'Caisse retraite obligatoire', 'Mcredit'=>$Tcr[0]->Tcr);
        $journalcf = array('compte'=>'4472', 'libellé'=>'Impôts sur salaires', 'Mcredit'=>$Tchargfisc[0]->Tchargfisc);

        //Reglement de la renumeration due
        $remunerationdu = $remuneration-$remuneration1;
        //dd($remunerationdu);
        $journalrdu = array('compte'=>'422', 'libellé'=>'Renumerations dues', 'Mdebit'=>$remunerationdu);
        $journalbq = array('compte'=>'521', 'libellé'=>'Banque', 'Mcredit'=>$remunerationdu);
        
        journal::create($journal0);
        journal::create($journalp);
        journal::create($journal1);
        journal::create($journalp1);
        journal::create($journalind);
        journal::create($journalremuneration);
        journal::create($journalremuneration1);
        journal::create($journalav);
        journal::create($journalac);
        journal::create($journalcr);
        journal::create($journalcf);
        journal::create($journalrdu);
        journal::create($journalbq);

        //mise à jour
        $affected = DB::table('salaire')
        ->where('cptabiliser', '=', 'False')
        ->whereBetween('created_at', [$request->from_date, $request->to_date])
        ->update(['cptabiliser' => 'True']);
     
        //Afficher le journal
       $journal = DB::table('Journal')
       ->whereYear('created_at', date("Y", time()))
       ->whereMonth ('created_at', date("m", time()))
       ->orderByDesc('Journal.created_at')
       ->get();

       return back()->with('journal', $journal)->with('success', 'Félicitation, La comptabilisation a reussie!');
    } else {
       //Afficher le journal
       $journal = DB::table('Journal')
       ->whereYear('created_at', date("Y", time()))
       ->whereMonth ('created_at', date("m", time()))
       ->orderByDesc('Journal.created_at')
       ->get();
        return back()->with('journal', $journal)->with('warning', 'La comptabilisation a Echouée!');
        }
    }
    //Comptabiliser le charges patronales
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function comptapatron()
    {
        //
        //Afficher le journal
        $journal = DB::table('Journal')
        ->whereYear('created_at', date("Y", time()))
        ->whereMonth ('created_at', date("m", time()))
        ->orderByDesc('Journal.created_at')
        ->get();

        return view('salaire.cptapatron')->with('journal', $journal);
    }

     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function comptapatronal(Request $request)
    {
        if (DB::table('cotsocpat')->where('cptabiliser_soc', '=', 'False')->whereBetween('created_at', [$request->from_date, $request->to_date])->exists()) {
            if (DB::table('cotficpat')->where('cptabiliser_fisc', '=', 'False')->whereBetween('created_at', [$request->from_date, $request->to_date])->exists()) {
                //Calcul Charges patronales sociales 
                $Tprest_fam = DB::table('cotsocpat')
                ->select(DB::raw('SUM(prest_fam) as Tprest_fam'))
                ->whereBetween('created_at', [$request->from_date, $request->to_date])
                ->get();
                $Tacc_trv = DB::table('cotsocpat')
                ->select(DB::raw('SUM(acc_trv) as Tacc_trv'))
                ->whereBetween('created_at', [$request->from_date, $request->to_date])
                ->get();
                
                $Tcr_p = DB::table('cotsocpat')
                ->select(DB::raw('SUM(cr_p) as Tcr_p'))
                ->whereBetween('created_at', [$request->from_date, $request->to_date])
                ->get();
                $Tchargsocial = $Tprest_fam[0]->Tprest_fam+$Tacc_trv[0]->Tacc_trv+$Tcr_p[0]->Tcr_p;
                
                $journalpf = array('compte'=>'4311', 'libellé'=>'Prestations familiales', 'Mcredit'=>$Tprest_fam[0]->Tprest_fam);
                $journalatrv = array('compte'=>'4312', 'libellé'=>'Accident de travail', 'Mcredit'=>$Tacc_trv[0]->Tacc_trv);
                $journalcrp = array('compte'=>'4313', 'libellé'=>'Caisse de retraite obligatoire', 'Mcredit'=>$Tcr_p[0]->Tcr_p);
                $journalchgsocial= array('compte'=>'664', 'libellé'=>'Charges sociales', 'Mdebit'=>$Tchargsocial);
                
                //Calcul Charges patronales fiscales 
                $Tis_p = DB::table('cotficpat')
                ->select(DB::raw('SUM(is_p) as Tis_p'))
                ->whereBetween('created_at', [$request->from_date, $request->to_date])
                ->get();
                $Tta_fdfp = DB::table('cotficpat')
                ->select(DB::raw('SUM(ta_fdfp) as Tta_fdfp'))
                ->whereBetween('created_at', [$request->from_date, $request->to_date])
                ->get();
                
                $Tfpc_fdfp = DB::table('cotficpat')
                ->select(DB::raw('SUM(fpc_fdfp) as Tfpc_fdfp'))
                ->whereBetween('created_at', [$request->from_date, $request->to_date])
                ->get();
                $fpc = $Tfpc_fdfp[0]->Tfpc_fdfp/2;
                $Tchargfiscal = $Tis_p[0]->Tis_p+$Tta_fdfp[0]->Tta_fdfp+$fpc;
                //dd($Tchargfiscal);
                $journalchgfiscal= array('compte'=>'44281', 'libellé'=>'Etat, autres impots et taxes', 'Mcredit'=>$Tchargfiscal);
                $journalchgfiscal1= array('compte'=>'44282', 'libellé'=>'Etat, autres impots et taxes FPC à regulariser', 'Mcredit'=>$fpc);
                $journalfpc = array('compte'=>'6415', 'libellé'=>'Formation professionnelle continu', 'Mdebit'=>$Tfpc_fdfp[0]->Tfpc_fdfp);
                $journalta = array('compte'=>'6414', 'libellé'=>'Taxes apprentissage', 'Mdebit'=>$Tta_fdfp[0]->Tta_fdfp);
                $journaltis = array('compte'=>'6413', 'libellé'=>'Taxes sur appointements', 'Mdebit'=>$Tis_p[0]->Tis_p);
                //Reglement Charges patronales sociales
                $journalbqr = array('compte'=>'521', 'libellé'=>'Banque (Reglement Charges patronales sociales)', 'Mcredit'=>$Tchargsocial);
                $journalcrpr1 = array('compte'=>'4313', 'libellé'=>'Caisse de retraite obligatoire', 'Mdebit'=>$Tcr_p[0]->Tcr_p);
                $journalatrvr1 = array('compte'=>'4312', 'libellé'=>'Accident de travail', 'Mdebit'=>$Tacc_trv[0]->Tacc_trv);
                $journalpfr1 = array('compte'=>'4311', 'libellé'=>'Prestations familiales', 'Mdebit'=>$Tprest_fam[0]->Tprest_fam);
                //Reglement Charges patronales fiscales 
                $journalbqrr = array('compte'=>'521', 'libellé'=>'Banque (Reglement Charges patronales fiscales)', 'Mcredit'=>$Tchargfiscal+$fpc);
                $journalchgfiscalr= array('compte'=>'44281', 'libellé'=>'Etat, autres impots et taxes', 'Mdebit'=>$Tchargfiscal);
                $journalchgfiscal1r= array('compte'=>'44282', 'libellé'=>'Etat, autres impots et taxes FPC à regulariser', 'Mdebit'=>$fpc);
                //dd($journalbqrr);
                //journaux Reglement Charges patronales fiscales 
                journal::create($journalchgfiscalr);
                journal::create($journalchgfiscal1r);
                journal::create($journalbqrr);
                //journaux Reglement Charges patronales sociales 
                journal::create($journalpfr1);  
                journal::create($journalatrvr1);
                journal::create($journalcrpr1);
                journal::create($journalbqr);
                //Journaux charges patronales fiscales
                journal::create($journaltis);
                journal::create($journalta);
                journal::create($journalfpc);
                journal::create($journalchgfiscal);
                journal::create($journalchgfiscal1);
                //journaux charges patronales sociales
                journal::create($journalchgsocial);
                journal::create($journalpf);
                journal::create($journalatrv);
                journal::create($journalcrp);

                //mise à jour
                $affected = DB::table('cotsocpat')
                ->where('cptabiliser_soc', '=', 'False')
                ->whereBetween('created_at', [$request->from_date, $request->to_date])
                ->update(['cptabiliser_soc' => 'True']);
                //---------------------
                $affected1 = DB::table('cotficpat')
                ->where('cptabiliser_fisc', '=', 'False')
                ->whereBetween('created_at', [$request->from_date, $request->to_date])
                ->update(['cptabiliser_fisc' => 'True']);
                //--------Affichage du journal---------------
                $journal = DB::table('Journal')
                ->whereYear('created_at', date("Y", time()))
                ->whereMonth ('created_at', date("m", time()))
                ->orderByDesc('Journal.created_at')
                ->get();
                return back()->with('journal', $journal)->with('success', 'Félicitation, La comptabilisation a reussie!');
            }
        } else {
            //Afficher le journal
            $journal = DB::table('Journal')
            ->whereYear('created_at', date("Y", time()))
            ->whereMonth ('created_at', date("m", time()))
            ->orderByDesc('Journal.created_at')
            ->get();
             return back()->with('journal', $journal)->with('warning', 'La comptabilisation a Echouée!');
        }
    }  
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function searchmat(Request $request)
    {
        //
        if($request->ajax()) {
            $data = employe::where('matricule', 'LIKE', $request->mat.'%')->get();
            $output = ' ';
            if (count($data) > 0) {
                $output = '<ul class="list-group" style="display:block;position:relative;z-index:1">';
                    foreach($data as $row) {
                        $output .= '<li class="list-group-item">' .$row->matricule.' - '.$row->nom.' - '.$row->prenoms.'</li>';
                    }
                $output .= '</ul>';
            } 
            else{
                //$output .= '<li class="list-group-item">Compte Non Defini</li>';
            }
            return $output;
        }
        
        //return view('journal.index');
    }

}
