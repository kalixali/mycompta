<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ventes;
use App\Models\achats;
use App\Models\entstock;
use App\Models\produit;
use App\Models\journal;
use App\Models\stockactu;
use App\Models\clients;
use App\Models\entreprise;
use Illuminate\Support\Facades\DB;
use PDF;

class VentesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $ventes = DB::table('ventes')
            ->whereYear('created_at', date("Y", time()))
            ->whereMonth ('created_at', date("m", time()))
            ->get();

        $vte = DB::table('ventes')
            ->select(DB::raw('SUM(mttc) as Tvmttc') )
            ->whereYear('created_at', date("Y", time()))
            ->whereMonth ('created_at', date("m", time()))
            ->get();

        $ach = DB::table('achats')
            ->select(DB::raw('SUM(mttc) as Tmttc') )
            ->whereYear('created_at', date("Y", time()))
            ->whereMonth ('created_at', date("m", time()))
            ->get();
        /*
        $ent = DB::table('entstock')
            ->select(DB::raw('SUM(mont) as Tmont') )
            ->whereYear('created_at', date("Y", time()))
            ->whereMonth ('created_at', date("m", time()))
            ->get();
        */
        $from_date = " ";
        $to_date = " ";

        //dd($ent[0]->Tmont);
        //$totach = intval($ach[0]->Tmttc) + intval($ent[0]->Tmont);
        //dd($totach);
        $marg = intval($vte[0]->Tvmttc) - intval($ach[0]->Tmttc);
        $fv = 'FV'.date("dmYHis", time());
        //dd($marg);
        return view('ventes.index', ['ventes' => $ventes, 'vte' => $vte, 'ach' => $ach, 'marg' => $marg, 'from_date' => $from_date, 'to_date' => $to_date, 'fv' => $fv]);
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
        $escpt = $request->escpte;
        $fr_vte = $request->fr_vte;
        //Enregistrer un achat
        //Enregistrer un achat dans le journal comptable
        //dd($input);
        if ($escpt = 0) {
            if ($fr_vte = 0) {
                $inp =array('refprod'=>$request->refprod, 'prod'=>$request->prod, 'qtite'=>$request->qtite, 'pu'=>$request->pu, 'mont'=>$request->netccial);
                $libjournal = 'ventes '.$request->prod.' Fact N° '.$request->numfact;
                $journal = array('compte'=>$request->cptevte, 'libellé'=>$libjournal, 'Mcredit'=>$request->netccial);
                $journaltva = array('compte'=>'4431', 'libellé'=>'TVA '.$libjournal, 'Mcredit'=>$request->mtva);
                $journalclt = array('compte'=>$request->cpteclt, 'libellé'=>$request->clt.' Fact N° '.$request->numfact, 'Mdebit'=>$request->mttc);
                //realisation de la vente et ecriture comptable
                ventes::create($input);
                journal::create($journal);
                journal::create($journaltva);
                journal::create($journalclt);
            } else {
                $inp =array('refprod'=>$request->refprod, 'prod'=>$request->prod, 'qtite'=>$request->qtite, 'pu'=>$request->pu, 'mont'=>$request->netccial);
                $libjournal = 'ventes '.$request->prod.' Fact N° '.$request->numfact;
                $journal = array('compte'=>$request->cptevte, 'libellé'=>$libjournal, 'Mcredit'=>$request->netccial);
                $journaltva = array('compte'=>'4431', 'libellé'=>'TVA '.$libjournal, 'Mcredit'=>$request->mtva);
                $journalfrvte = array('compte'=>'7071', 'libellé'=>'Port et autres frais facturés N° '.$request->numfact, 'Mcredit'=>$request->fr_vte);
                $journalclt = array('compte'=>$request->cpteclt, 'libellé'=>$request->clt.' Fact N° '.$request->numfact, 'Mdebit'=>$request->mttc);
                //realisation de la vente et ecriture comptable
                ventes::create($input);
                journal::create($journal);
                journal::create($journaltva);
                journal::create($journalfrvte);
                journal::create($journalclt);
            }
        }
        else {

            //escompte different de zéro
            if ($fr_vte = 0) {
                //escompte different de zéro
                $inp =array('refprod'=>$request->refprod, 'prod'=>$request->prod, 'qtite'=>$request->qtite, 'pu'=>$request->pu, 'mont'=>$request->netccial);
                $libjournal = 'ventes '.$request->prod.' Fact N° '.$request->numfact;
                $journal = array('compte'=>$request->cptevte, 'libellé'=>$libjournal, 'Mcredit'=>$request->netccial);
                $journaltva = array('compte'=>'4431', 'libellé'=>'TVA '.$libjournal, 'Mcredit'=>$request->mtva);
                $journalclt = array('compte'=>$request->cpteclt, 'libellé'=>$request->clt.' Fact N° '.$request->numfact, 'Mdebit'=>$request->mttc);
                $journalescpt = array('compte'=>'673', 'libellé'=>'Escompte Accordé Fact N° '.$request->numfact, 'Mdebit'=>$request->escompte);
                //realisation de la vente et ecriture comptable
                ventes::create($input);
                journal::create($journal);
                journal::create($journaltva);
                journal::create($journalescpt);
                journal::create($journalclt);
            } else {
                $inp =array('refprod'=>$request->refprod, 'prod'=>$request->prod, 'qtite'=>$request->qtite, 'pu'=>$request->pu, 'mont'=>$request->netccial);
                $libjournal = 'ventes '.$request->prod.' Fact N° '.$request->numfact;
                $journal = array('compte'=>$request->cptevte, 'libellé'=>$libjournal, 'Mcredit'=>$request->netccial);
                $journaltva = array('compte'=>'4431', 'libellé'=>'TVA '.$libjournal, 'Mcredit'=>$request->mtva);
                $journalfrvte = array('compte'=>'7071', 'libellé'=>'Port et autres frais facturés N° '.$request->numfact, 'Mcredit'=>$request->fr_vte);
                $journalescpt = array('compte'=>'673', 'libellé'=>'Escompte Accordé Fact N° '.$request->numfact, 'Mdebit'=>$request->escompte);
                $journalclt = array('compte'=>$request->cpteclt, 'libellé'=>$request->clt.' Fact N° '.$request->numfact, 'Mdebit'=>$request->mttc);
                //realisation de la vente et ecriture comptable
                ventes::create($input);
                journal::create($journal);
                journal::create($journaltva);
                journal::create($journalfrvte);
                journal::create($journalescpt);
                journal::create($journalclt);
            }
        }
        // mettre à jour le stock actuel
        $actu = DB::table('stockactu')->where('prod', $request->prod)->first();
        if (DB::table('stockactu')->where('prod', $request->prod)->exists()) {
            
            // mise à jour du stock
            $actu->qtite = intval($actu->qtite) - intval($request->qtite);
            $actu->mont = intval($actu->qtite) * intval($actu->pu);
            $affected = DB::table('stockactu')
              ->where('prod', $request->prod)
              ->update(['qtite' => $actu->qtite, 'pu' => $actu->pu, 'mont' => $actu->mont]);
        }
        else {

            //stockactu::create($inp);
            
        }
        //effacer les lignes vides du tableau
        $deleted = DB::table('stockactu')->where('qtite', '<=', 0)->delete();
        //return redirect('ventes')->with('flash_message','Enregistrement effectué!');
        $ventes = DB::table('ventes')
            ->whereYear('created_at', date("Y", time()))
            ->whereMonth ('created_at', date("m", time()))
            ->get();
        $vente = DB::table('ventes')
            ->where('numfact', $request->numfact)
            ->get();

        $vte = DB::table('ventes')
            ->select(DB::raw('SUM(mttc) as Tvmttc') )
            ->whereYear('created_at', date("Y", time()))
            ->whereMonth ('created_at', date("m", time()))
            ->get();
        //utilisé pour calculer la marge
        $ach = DB::table('achats')
            ->select(DB::raw('SUM(mttc) as Tmttc') )
            ->whereYear('created_at', date("Y", time()))
            ->whereMonth ('created_at', date("m", time()))
            ->get();
       
        $from_date = " ";
        $to_date = " ";
        $vent= DB::table('ventes')->where('numfact', $request->numfact)->first();
        $marg = intval($vte[0]->Tvmttc) - intval($ach[0]->Tmttc);
        
        //dd($marg);
        //return view('ventes.index1', ['ventes' => $ventes, 'vente' => $vente, 'vte' => $vte, 'ach' => $ach, 'vent' => $vent, 'marg' => $marg, 'from_date' => $from_date, 'to_date' => $to_date]);
        $fvte = strlen($request->numfact);
       
        if ($fvte > 16 ) {
            // ...
            return view('ventes.ventescan1', ['vente' => $vente, 'vent' => $vent])->with('flash_message','Enregistrement effectué!');
        }
        else {
            return view('ventes.index1', ['ventes' => $ventes, 'vente' => $vente, 'vte' => $vte, 'ach' => $ach, 'vent' => $vent, 'marg' => $marg, 'from_date' => $from_date, 'to_date' => $to_date]);       
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function ventescan()
    {
        $fa = 'FVSC'.date("dmYHis", time());
        return view('ventes.ventescan')->with('fa', $fa);;
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
        $ventes = ventes::find($id);
        return view('ventes.edit')->with('ventes', $ventes);
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
        $ent = DB::table('ventes')->where('id', $id)->first();
        $actu = DB::table('stockactu')->where('prod', $ent->prod)->first();
        $jr = DB::table('journal')->where('libellé', 'like', '%'.$ent->numfact)->delete();
        //dd($jr1); [0]

        $actu->qtite = intval($actu->qtite) + intval($ent->qtite);
        $actu->pu = (intval($actu->mont)+intval($ent->netccial))/(intval($actu->qtite)+intval($ent->qtite));
        $actu->mont = intval($actu->qtite) * intval($actu->pu);

        $affected = DB::table('stockactu')
              ->where('prod', $ent->prod)
              ->update(['qtite' => $actu->qtite, 'pu' => $actu->pu, 'mont' => $actu->mont]);

        //effacer les lignes vides du tableau
        $deleted = DB::table('stockactu')->where('qtite', '<=', 0)->delete();
                
        ventes::destroy($id);
        
        //données à afficher
        $ventes = DB::table('ventes')
            ->whereYear('created_at', date("Y", time()))
            ->whereMonth ('created_at', date("m", time()))
            ->get();
        $vente = DB::table('ventes')
            ->where('numfact', $request->numfact)
            ->get();

        $vte = DB::table('ventes')
            ->select(DB::raw('SUM(mttc) as Tvmttc') )
            ->whereYear('created_at', date("Y", time()))
            ->whereMonth ('created_at', date("m", time()))
            ->get();
        //utilisé pour calculer la marge
        $ach = DB::table('achats')
            ->select(DB::raw('SUM(mttc) as Tmttc') )
            ->whereYear('created_at', date("Y", time()))
            ->whereMonth ('created_at', date("m", time()))
            ->get();
       
        $from_date = " ";
        $to_date = " ";
        $vent= DB::table('ventes')->where('numfact', $request->numfact)->first();
        $marg = intval($vte[0]->Tvmttc) - intval($ach[0]->Tmttc);
        
        $fvte = strlen($request->numfact);
       
        if ($fvte > 16 ) {
            // ...
            return view('ventes.ventescan1', ['vente' => $vente, 'vent' => $vent])->with('flash_message','Enregistrement effectué!');
        }
        else {
            return view('ventes.index1', ['ventes' => $ventes, 'vente' => $vente, 'vte' => $vte, 'ach' => $ach, 'vent' => $vent, 'marg' => $marg, 'from_date' => $from_date, 'to_date' => $to_date]);       
        }
        //return redirect('ventes')->with('flash_message', 'Enregistrement supprimé!');
    }

   /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function searchvte1(Request $request)
    {
        //
        if($request->ajax()) {
            $data = clients::where('sigleclt', 'LIKE', $request->sigleclt.'%')->get();
            $output = ' ';
            if (count($data) > 0) {
                $output = '<ul class="list-group" style="display:block;position:relative;z-index:1">';
                    foreach($data as $row) {
                        //$output .= '<li class="list-group-item">' .$row->refprod.'</li>';
                        $output .= '<li class="list-group-item">' .$row->sigleclt.' - '.$row->cptec.'</li>';
                    }
                $output .= '</ul>';
            } 
            else{
                //$output .= '<li class="list-group-item"></li>';
            }
            return $output;
        }
        
        //return view('ventes.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function searchvte2(Request $request)
    {
        //
        if($request->ajax()) {
            $data = produit::where('refprod', 'LIKE', $request->refprod.'%')->get();
            $output = ' ';
            if (count($data) > 0) {
                $output = '<ul class="list-group" style="display:block;position:relative;z-index:1">';
                    foreach($data as $row) {
                        //$output .= '<li class="list-group-item">' .$row->refprod.'</li>';
                        $output .= '<li class="list-group-item">' .$row->refprod.' - '.$row->prod.' - '.$row->puvte.' - '.$row->cptevte.'</li>';
                    }
                $output .= '</ul>';
            } 
            else{
                //$output .= '<li class="list-group-item"></li>';
            }
            return $output;
        }
        
        return view('ventes.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    //recherche scan-retourne le produit scanné
    public function searchach3(Request $request)
    {
        //
        if($request->ajax()) {
            //$data = $request->id;
            $dat = produit::where('id', 'LIKE', $request->id.'%')->get();
            $data = $dat[0]->refprod.'-'.$dat[0]->prod.'-'.$dat[0]->puvte.'-'.$dat[0]->cptevte;
            //print_r(json_encode($data));           
            //return $data[0]->prod;
            return $data;
            //return view('achats.indexscan')->with('data', $data);
        }
        //return view('achats.indexscan')->with('data', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
      /*
    public function searchvte(Request $request)
    {
        //
        
        $produit = DB::table('produit')
            ->where('refprod', 'like', $request->refprod)
            ->first();
            //->get();
        //dd($produit);
        $ventes = DB::table('ventes')
        ->whereYear('created_at', date("Y", time()))
        ->get();
        return view('ventes.index1', ['produit' => $produit, 'ventes' => $ventes]);
    }
    */

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function searchfactvte(Request $request)
    {
        //recherche de la dernière facture enregistrée
        if($request->ajax()) {
            $data = ventes::where('numfact', 'LIKE', $request->numfact.'%')->orderByDesc('ventes.created_at')->distinct()->limit(1)->get();
            $output = ' ';
            if (count($data) > 0) {
                $output = '<ul class="list-group" style="display:block;position:relative;z-index:1">';
                    foreach($data as $row) {
                        //$output .= '<li class="list-group-item">' .$row->refprod.'</li>';
                        $output .= '<li class="list-group-item">'.$row->numfact.'</li>';
                    }
                $output .= '</ul>';
            } 
            else{
                //$output .= '<li class="list-group-item"></li>';
            }
            return $output;
        }
        
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function searchfactvte1(Request $request)
    {
        //Recherche de la facture à imprimer
        
        if($request->ajax()) {
            //$data = achats::where('numfact', 'LIKE', $request->numfact1.'%')->orderByDesc('achats.created_at')->distinct()->limit(5)->get();
            $data = DB::table('ventes')->select('numfact')->where('numfact', 'LIKE', $request->numfact1.'%')->orderByDesc('ventes.created_at')->distinct()->get();
            $output = ' ';
            if (count($data) > 0) {
                $output = '<ul class="list-group" style="display:block;position:relative;z-index:1">';
                    foreach($data as $row) {
                        //$output .= '<li class="list-group-item">' .$row->refprod.'</li>';
                        $output .= '<li class="list-group-item">'.$row->numfact.'</li>';
                    }
                $output .= '</ul>';
            } 
            else{
                //$output .= '<li class="list-group-item"></li>';
            }
            return $output;
        }
        
        //return view('achats.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getventes(Request $request)
    {
        //

        $from_date = $request->from_date;
        $to_date = $request->to_date;

        $ventes = DB::table('ventes')
           ->whereBetween('created_at', [$request->from_date, $request->to_date])
           ->orderByDesc('ventes.created_at')
           ->get();

        $vte = DB::table('ventes')
           ->select(DB::raw('SUM(mttc) as Tvmttc') )
           ->whereBetween('created_at', [$request->from_date, $request->to_date])
           ->get();

        $ach = DB::table('achats')
            ->select(DB::raw('SUM(mttc) as Tmttc') )
            ->whereBetween('created_at', [$request->from_date, $request->to_date])
            ->get();
        /*
        $ent = DB::table('entstock')
            ->select(DB::raw('SUM(mont) as Tmont') )
            ->whereBetween('created_at', [$request->from_date, $request->to_date])
            ->get();
        */
        //dd($ent[0]->Tmont);
        //$totach = intval($ach[0]->Tmttc) + intval($ent[0]->Tmont);
        //dd($totach);
        $marg = intval($vte[0]->Tvmttc) - intval($ach[0]->Tmttc);
        $fv = 'FV'.date("dmYHis", time());
        //dd($marg);
        return view('ventes.index', ['ventes' => $ventes, 'vte' => $vte, 'ach' => $ach, 'marg' => $marg, 'from_date' => $from_date, 'to_date' => $to_date, 'fv' => $fv]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function downloadvte(Request $request)
    {
        
        $entreprise = DB::table('entreprise')->where('id', 1)->first();

        $from_date1 = $request->from_date1;
        //dd($from_date1);
        $to_date1 = $request->to_date1;

        $ventes = DB::table('ventes')
           ->whereBetween('created_at', [$request->from_date1, $request->to_date1])
           ->orderByDesc('ventes.created_at')
           ->get();
        //dd($ventes);

        $vte = DB::table('ventes')
        ->select(DB::raw('SUM(qtite) as Tqtite'), DB::raw('SUM(mont) as Tmont'), DB::raw('SUM(remise) as Tremise'), DB::raw('SUM(netccial) as Tmontht'), DB::raw('SUM(escpte) as Tescpte'), DB::raw('SUM(netfcier) as Tnetfcier'), DB::raw('SUM(mtva) as Tmtva'), DB::raw('SUM(mttc) as Tvmttc'), DB::raw('SUM(fr_vte) as Tfr_vte'), DB::raw('SUM(netpay) as Tnetpay'))
           ->whereBetween('created_at', [$request->from_date1, $request->to_date1])
           ->get();

        // Achats + entrez en stock donne le montant total depensé

        $ach = DB::table('achats')
            ->select(DB::raw('SUM(mttc) as Tachmttc') )
            ->whereBetween('created_at', [$request->from_date1, $request->to_date1])
            ->get();

        /*
            $ent = DB::table('entstock')
            ->select(DB::raw('SUM(mont) as Tmont') )
            ->whereBetween('created_at', [$request->from_date1, $request->to_date1])
            ->get();
        */
        //dd($ent[0]->Tmont);
        //$totach = intval($ach[0]->Tmttc); //+ intval($ent[0]->Tmont);
        //dd($totach);
        $marg = intval($vte[0]->Tvmttc) - intval($ach[0]->Tachmttc);
        //dd($marg);
        //$pdf = PDF::loadView('ventes.indexpdf', ['entreprise' => $entreprise, 'ventes' => $ventes, 'vte' => $vte, 'totach' => $totach, 'marg' => $marg, 'from_date' => $from_date, 'to_date' => $to_date]);
        $tescpt = $vte[0]->Tescpte;
        $rem = $vte[0]->Tremise;
        $tfr_vte = $vte[0]->Tfr_vte;
        //affiche la date du jour
        $dat = date("d/m/Y", time());
        // dans le cas où l'escompte et les frais d'achats sont nulls                
        if (is_null($tescpt ) && is_null($tfr_vte )) {
            if (is_null($rem )) {
                $pdf = PDF::loadView('ventes.indexvtepdf', ['entreprise' => $entreprise, 'ventes' => $ventes, 'vte' => $vte, 'ach' => $ach, 'marg' => $marg, 'dat' => $dat]);
                return $pdf->download('ventes.pdf');
            } else
            {
                $pdf = PDF::loadView('ventes.indexvtepdfrem', ['entreprise' => $entreprise, 'ventes' => $ventes, 'vte' => $vte, 'ach' => $ach, 'marg' => $marg, 'dat' => $dat])->setPaper('a4', 'landscape');
                return $pdf->download('ventes.pdf');
            }
        } 
        // dans le cas où l'escompte et les frais d'achats sont differents de zéros
        elseif (!is_null($tescpt ) && !is_null($tfr_vte )) {
            if (is_null($rem )) {
                $pdf = PDF::loadView('ventes.indexvtepdfescpt_frvte', ['entreprise' => $entreprise, 'ventes' => $ventes, 'vte' => $vte, 'ach' => $ach, 'marg' => $marg, 'dat' => $dat])->setPaper('a4', 'landscape');
                return $pdf->download('ventes.pdf');
            } else
            {
                $pdf = PDF::loadView('ventes.indexvtepdfescpt_frvte_rem', ['entreprise' => $entreprise, 'ventes' => $ventes, 'vte' => $vte, 'ach' => $ach, 'marg' => $marg, 'dat' => $dat])->setPaper('a4', 'landscape');
                return $pdf->download('ventes.pdf');
            }
        }
        // dans le cas où l'escompte est different de zéro
        elseif (!is_null($tescpt )) {
            if (is_null($rem )) {
                $pdf = PDF::loadView('ventes.indexvtepdfescpt', ['entreprise' => $entreprise, 'ventes' => $ventes, 'vte' => $vte, 'ach' => $ach, 'marg' => $marg, 'dat' => $dat])->setPaper('a4', 'landscape');
                return $pdf->download('ventes.pdf');
            } else
            {
                $pdf = PDF::loadView('ventes.indexvtepdfescpt_rem', ['entreprise' => $entreprise, 'ventes' => $ventes, 'vte' => $vte, 'ach' => $ach, 'marg' => $marg, 'dat' => $dat])->setPaper('a4', 'landscape');
                return $pdf->download('ventes.pdf');
            }
        }
        // dans le cas où les frais d'achats sont differents de zéros
        elseif (!is_null($tfr_vte )) {
            if (is_null($rem )) {
                $pdf = PDF::loadView('ventes.indexvtepdf_frvte', ['entreprise' => $entreprise, 'ventes' => $ventes, 'vte' => $vte, 'ach' => $ach, 'marg' => $marg, 'dat' => $dat])->setPaper('a4', 'landscape');
                return $pdf->download('ventes.pdf');
            } else
            {
                $pdf = PDF::loadView('ventes.indexvtepdf_frvte_rem', ['entreprise' => $entreprise, 'ventes' => $ventes, 'vte' => $vte, 'ach' => $ach, 'marg' => $marg, 'dat' => $dat])->setPaper('a4', 'landscape');
                return $pdf->download('ventes.pdf');
            }
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

     public function downloadfactvte(Request $request)
     {
         
         //$fact = DB::table('ventes')->where('numfact', $request->numfact)->first();
         $fact = DB::table('ventes')
            ->where('numfact', $request->numfact1)
            ->get();
        
        $totfact = DB::table('ventes')
        ->select(DB::raw('SUM(mont) as Tmont'), DB::raw('SUM(remise) as Tremise'), DB::raw('SUM(netccial) as Tmontht'), DB::raw('SUM(escpte) as Tescpte'), DB::raw('SUM(netfcier) as Tnetfcier'), DB::raw('SUM(mtva) as Tmtva'), DB::raw('SUM(mttc) as Tvmttc'), DB::raw('SUM(fr_vte) as Tfr_vte'), DB::raw('SUM(netpay) as Tnetpay') )
        ->where('numfact', $request->numfact1)
        ->from('ventes')
        ->get();

        //dd($totfact);
        $tescpt = $totfact[0]->Tescpte;
        $rem = $totfact[0]->Tremise;
        $tfr_vte = $totfact[0]->Tfr_vte;

        $nfact = $request->numfact1;

        $dat = date("d/m/Y", time());

        $entreprise = DB::table('entreprise')->where('id', 1)->first();
         //dd($entreprise);
         //$pdf = PDF::loadView('ventes.indexpdf', ['entreprise' => $entreprise, 'ventes' => $ventes, 'vte' => $vte, 'totach' => $totach, 'marg' => $marg, 'from_date' => $from_date, 'to_date' => $to_date]);
         //$pdf = PDF::loadView('ventes.facturepdf', ['fact' => $fact, 'totfact' => $totfact, 'entreprise' => $entreprise, 'nfact' => $nfact]);
        // dans le cas où l'escompte et les frais d'achats sont nulls
         if (is_null($tescpt ) && is_null($tfr_vte )) {
            if (is_null($rem )) {
                $pdf = PDF::loadView('ventes.facturepdf', ['fact' => $fact, 'totfact' => $totfact, 'entreprise' => $entreprise, 'nfact' => $nfact, 'dat' => $dat]);
                return $pdf->download('Facturevte.pdf');
            } else
            {
                $pdf = PDF::loadView('ventes.facturepdf_rem', ['fact' => $fact, 'totfact' => $totfact, 'entreprise' => $entreprise, 'nfact' => $nfact, 'dat' => $dat]);
                return $pdf->download('Facturevte.pdf');
            }
        }
        
        // dans le cas où l'escompte et les frais d'achats sont differents de zéros
        elseif (!is_null($tescpt ) && !is_null($tfr_vte )) {
            if (is_null($rem )) {
                $pdf = PDF::loadView('ventes.facturepdf_escpte_frvte', ['fact' => $fact, 'totfact' => $totfact, 'entreprise' => $entreprise, 'nfact' => $nfact, 'dat' => $dat]);
                return $pdf->download('Facturevte.pdf');
            } else
            {
                $pdf = PDF::loadView('ventes.facturepdf_escpte_frvte_rem', ['fact' => $fact, 'totfact' => $totfact, 'entreprise' => $entreprise, 'nfact' => $nfact, 'dat' => $dat]);
                return $pdf->download('Facturevte.pdf');
            }
        }

        // dans le cas où l'escompte est different de zéro
        elseif (!is_null($tescpt )) {
            if (is_null($rem )) {
                $pdf = PDF::loadView('ventes.facturepdf_escpte', ['fact' => $fact, 'totfact' => $totfact, 'entreprise' => $entreprise, 'nfact' => $nfact, 'dat' => $dat]);
                return $pdf->download('Facturevte.pdf');
            } else
            {
                $pdf = PDF::loadView('ventes.facturepdf_escpte_rem', ['fact' => $fact, 'totfact' => $totfact, 'entreprise' => $entreprise, 'nfact' => $nfact, 'dat' => $dat]);
                return $pdf->download('Facturevte.pdf');
            }
        }
        // dans le cas où les frais d'achats sont differents de zéros
        elseif (!is_null($tfr_vte )) {
            if (is_null($rem )) {
                $pdf = PDF::loadView('ventes.facturepdf_frvte', ['fact' => $fact, 'totfact' => $totfact, 'entreprise' => $entreprise, 'nfact' => $nfact, 'dat' => $dat]);
                return $pdf->download('Facturevte.pdf');
            } else
            {
                $pdf = PDF::loadView('ventes.facturepdf_frvte_rem', ['fact' => $fact, 'totfact' => $totfact, 'entreprise' => $entreprise, 'nfact' => $nfact, 'dat' => $dat]);
                return $pdf->download('Facturevte.pdf');
            }
        }
     }

}
