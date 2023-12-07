<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\achats;
use App\Models\produit;
use App\Models\journal;
use App\Models\stockactu;
use App\Models\fournisseurs;
use Illuminate\Support\Facades\DB;
use PDF;

class AchatsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        //
        $from_date = " ";
        $to_date = " ";
        //
        $achats = DB::table('achats')
        ->whereYear('created_at', date("Y", time()))
        ->whereMonth ('created_at', date("m", time()))
        ->get();

        $ach = DB::table('achats')
            ->select(DB::raw('SUM(mttc) as Tachmttc') )
            ->whereYear('created_at', date("Y", time()))
            ->whereMonth ('created_at', date("m", time()))
            ->get();
        
        $fa = 'FA'.date("dmYHis", time());
        
        return view('achats.index', ['ach' => $ach, 'achats' => $achats, 'from_date' => $from_date, 'to_date' => $to_date, 'fa' => $fa]);
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
        $fr_ach = $request->fr_ach;
        //Enregistrer un achat
        //Enregistrer un achat dans le journal comptable
        //dd($input);
        if ($escpt = 0) {
            if ($fr_ach = 0) {
                $inp =array('refprod'=>$request->refprod, 'prod'=>$request->prod, 'qtite'=>$request->qtite, 'pu'=>$request->pu, 'mont'=>$request->netccial);
                $libjournal = 'Achat '.$request->prod.' Fact N° '.$request->numfact;
                $journal = array('compte'=>$request->cpteach, 'libellé'=>$libjournal, 'Mdebit'=>$request->netccial);
                $journaltva = array('compte'=>'4452', 'libellé'=>'TVA '.$libjournal, 'Mdebit'=>$request->mtva);
                $journalfourn = array('compte'=>$request->cptef, 'libellé'=>$request->siglefourn.' Fact N° '.$request->numfact, 'Mcredit'=>$request->mttc);
                achats::create($input);
                journal::create($journal);
                journal::create($journaltva);
                journal::create($journalfourn);
            } else {
                $inp =array('refprod'=>$request->refprod, 'prod'=>$request->prod, 'qtite'=>$request->qtite, 'pu'=>$request->pu, 'mont'=>$request->netccial);
                $libjournal = 'Achat '.$request->prod.' Fact N° '.$request->numfact;
                $journal = array('compte'=>$request->cpteach, 'libellé'=>$libjournal, 'Mdebit'=>$request->netccial);
                $journaltva = array('compte'=>'4452', 'libellé'=>'TVA '.$libjournal, 'Mdebit'=>$request->mtva);
                $journalfrach = array('compte'=>'6015', 'libellé'=>'Frais sur achat Fact N° '.$request->numfact, 'Mdebit'=>$request->fr_ach);
                $journalfourn = array('compte'=>$request->cptef, 'libellé'=>$request->siglefourn.' Fact N° '.$request->numfact, 'Mcredit'=>$request->netpay);
                achats::create($input);
                journal::create($journal);
                journal::create($journaltva);
                journal::create($journalfrach);
                journal::create($journalfourn);
            }
        }
        else {

            //escompte different de zéro
            if ($fr_ach = 0) {
                $inp =array('refprod'=>$request->refprod, 'prod'=>$request->prod, 'qtite'=>$request->qtite, 'pu'=>$request->pu, 'mont'=>$request->netccial);
                $libjournal = 'Achat '.$request->prod.' Fact N° '.$request->numfact;
                $journal = array('compte'=>$request->cpteach, 'libellé'=>$libjournal, 'Mdebit'=>$request->netccial);
                $journaltva = array('compte'=>'4452', 'libellé'=>'TVA '.$libjournal, 'Mdebit'=>$request->mtva);
                $journalfourn = array('compte'=>$request->cptef, 'libellé'=>$request->siglefourn.' Fact N° '.$request->numfact, 'Mcredit'=>$request->mttc);
                $journalescpt = array('compte'=>'773', 'libellé'=>'Escompte obtenu Fact N° '.$request->numfact, 'Mcredit'=>$request->escpte);
                achats::create($input);
                journal::create($journal);
                journal::create($journaltva);
                journal::create($journalfourn);
                journal::create($journalescpt);
            } else {
                $inp =array('refprod'=>$request->refprod, 'prod'=>$request->prod, 'qtite'=>$request->qtite, 'pu'=>$request->pu, 'mont'=>$request->netccial);
                $libjournal = 'Achat '.$request->prod.' Fact N° '.$request->numfact;
                $journal = array('compte'=>$request->cpteach, 'libellé'=>$libjournal, 'Mdebit'=>$request->netccial);
                $journaltva = array('compte'=>'4452', 'libellé'=>'TVA '.$libjournal, 'Mdebit'=>$request->mtva);
                $journalfrach = array('compte'=>'6015', 'libellé'=>'Frais sur achat Fact N° '.$request->numfact, 'Mdebit'=>$request->fr_ach);
                $journalfourn = array('compte'=>$request->cptef, 'libellé'=>$request->siglefourn.' Fact N° '.$request->numfact, 'Mcredit'=>$request->netpay);
                $journalescpt = array('compte'=>'773', 'libellé'=>'Escompte obtenu Fact N° '.$request->numfact, 'Mcredit'=>$request->escpte);
                achats::create($input);
                journal::create($journal);
                journal::create($journaltva);
                journal::create($journalfrach);
                journal::create($journalfourn);
                journal::create($journalescpt);
            }
        }
        // mettre à jour le stock actuel
        if (DB::table('stockactu')->where('prod', $request->prod)->exists()) {
            // ...
            $actu = DB::table('stockactu')->where('prod', $request->prod)->first();
            $actu->qtite = intval($actu->qtite) + intval($request->qtite);
            $actu->pu = (intval($actu->mont)+intval($request->netccial))/(intval($actu->qtite)+intval($request->qtite));
            $actu->mont = intval($actu->qtite) * intval($actu->pu);

            $affected = DB::table('stockactu')
                ->where('prod', $request->prod)
                ->update(['qtite' => $actu->qtite, 'pu' => $actu->pu, 'mont' => $actu->mont]);
        }
        else {

            stockactu::create($inp);
            
        }
        
        $achat = DB::table('achats')
        ->where('numfact', $request->numfact)
        ->get();

        $acha= DB::table('achats')->where('numfact', $request->numfact)->first();

        $achats = DB::table('achats')
        ->whereYear('created_at', date("Y", time()))
        ->whereMonth ('created_at', date("m", time()))
        ->get();

        $ach = DB::table('achats')
            ->select(DB::raw('SUM(mttc) as Tachmttc') )
            ->whereYear('created_at', date("Y", time()))
            ->whereMonth ('created_at', date("m", time()))
            ->get();

        //
        $from_date = " ";
        $to_date = " ";
        //retourne le nombre de caractères d'une chaîne de caractère
        $fach = strlen($request->numfact);
       
        if ($fach > 16 ) {
            // ...
            return view('achats.achatscan1', ['achat' => $achat, 'acha' => $acha])->with('flash_message','Enregistrement effectué!');
        }
        else {
            return view('achats.index1', ['achat' => $achat, 'acha' => $acha, 'achats' => $achats, 'ach' => $ach, 'from_date' => $from_date, 'to_date' => $to_date])->with('flash_message','Enregistrement effectué!');        
        }
        //dd($achat);
       
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
        $achats = achats::find($id);
        return view('achats.edit')->with('achats', $achats);
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
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        //
        $ent = DB::table('achats')->where('id', $id)->first();
        //dd($ent);
        $actu = DB::table('stockactu')->where('prod', $ent->prod)->first();
        $jr1 = DB::table('journal')->where('libellé', 'like', '%'.$ent->numfact)->delete();
        
        $actu->qtite = intval($actu->qtite) - intval($ent->qtite);
        $actu->pu = (intval($actu->mont)-intval($ent->netccial))/(intval($actu->qtite)-intval($ent->qtite));
        $actu->mont = intval($actu->qtite) * intval($actu->pu);

        $affected = DB::table('stockactu')
              ->where('prod', $ent->prod)
              ->update(['qtite' => $actu->qtite, 'pu' => $actu->pu, 'mont' => $actu->mont]);

        
        $deleted = DB::table('stockactu')->where('qtite', '<=', 0)->delete();
                
        achats::destroy($id);
        //données à afficher
        $achat = DB::table('achats')
        ->where('numfact', $ent->numfact)
        ->get();

        $acha= DB::table('achats')->where('numfact', $ent->numfact)->first();

        $achats = DB::table('achats')
        ->whereYear('created_at', date("Y", time()))
        ->whereMonth ('created_at', date("m", time()))
        ->get();

        $ach = DB::table('achats')
            ->select(DB::raw('SUM(mttc) as Tachmttc') )
            ->whereYear('created_at', date("Y", time()))
            ->whereMonth ('created_at', date("m", time()))
            ->get();

        //
        $from_date = " ";
        $to_date = " ";

        $fach = strlen($ent->numfact);
        //page retournée
       
        if ($fach > 16 ) {
            // ...
            return view('achats.achatscan1', ['achat' => $achat, 'acha' => $acha])->with('flash_message','Enregistrement supprimé!');
        }
        else {
            return view('achats.index1', ['achat' => $achat, 'acha' => $acha, 'achats' => $achats, 'ach' => $ach, 'from_date' => $from_date, 'to_date' => $to_date])->with('flash_message','Enregistrement supprimé!');        
        }
       // return redirect('achats')->with('flash_message', 'Enregistrement supprimé!');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function achatscan()
    {
        $fa = 'FASC'.date("dmYHis", time());
        return view('achats.achatscan')->with('fa', $fa);;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // filtre et affiche la liste des fournisseurs
    public function searchach1(Request $request)
    {
        
        //
        if($request->ajax()) {
            $data = fournisseurs::where('siglefourn', 'LIKE', $request->siglefourn.'%')->get();
            
            $output = ' ';
            if (count($data) > 0) {
                $output = '<ul class="list-group" style="display:block;position:relative;z-index:1">';
                    foreach($data as $row) {
                        //$output .= '<li class="list-group-item">' .$row->refprod.'</li>';
                        $output .= '<li class="list-group-item">' .$row->siglefourn.' - '.$row->cptef.'</li>';
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
    // filtre et affiche la liste des produits
    public function searchach2(Request $request)
    {
        //
        if($request->ajax()) {
            $data = produit::where('refprod', 'LIKE', $request->refprod.'%')->get();
            $output = ' ';
            if (count($data) > 0) {
                $output = '<ul class="list-group" style="display:block;position:relative;z-index:1">';
                    foreach($data as $row) {
                        //$output .= '<li class="list-group-item">' .$row->refprod.'</li>';
                        $output .= '<li class="list-group-item">' .$row->refprod.' - '.$row->prod.' - '.$row->puach.' - '.$row->cpteach.'</li>';
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
    //recherche scan-retourne le produit scanné
    public function searchach3(Request $request)
    {
        //
        if($request->ajax()) {
            //$data = $request->id;
            $dat = produit::where('id', 'LIKE', $request->id.'%')->get();
            $data = $dat[0]->refprod.'-'.$dat[0]->prod.'-'.$dat[0]->puach.'-'.$dat[0]->cpteach;
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
    public function searchfactach(Request $request)
    {
        //recherche de la dernière facture enregistrée
        if($request->ajax()) {
            $data = achats::where('numfact', 'LIKE', $request->numfact.'%')->orderByDesc('achats.created_at')->distinct()->limit(1)->get();
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
    public function searchfactach1(Request $request)
    {
        //Recherche de la facture à imprimer
        
        if($request->ajax()) {
            //$data = achats::where('numfact', 'LIKE', $request->numfact1.'%')->orderByDesc('achats.created_at')->distinct()->limit(5)->get();
            $data = DB::table('achats')->select('numfact')->where('numfact', 'LIKE', $request->numfact1.'%')->orderByDesc('achats.created_at')->distinct()->get();
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
    /*
    public function searchach(Request $request)
    {
        //
        
        //$produit = DB::table('produit')->where('refprod', $request->refprod)->first();
        $produit = DB::table('produit')
            ->where('refprod', 'like', $request->refprod)
            ->first();
            //->get();
        //dd($produit);
        $achats = DB::table('achats')
            ->whereYear('created_at', date("Y", time()))
            ->get();
        return view('achats.index1', ['produit' => $produit, 'achats' => $achats]);
    }
    */
    //Recherche des factures par date
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getachats(Request $request)
    {
        $from_date = $request->from_date;
        $to_date = $request->to_date;
        //
        $achats = DB::table('achats')
           ->whereBetween('created_at', [$request->from_date, $request->to_date])
           ->orderByDesc('achats.created_at')
           ->get();
        //dd($journal);

        $ach = DB::table('achats')
             ->select(DB::raw('SUM(mttc) as Tachmttc') )
             ->whereBetween('created_at', [$request->from_date, $request->to_date])
             ->get();

        $fa = 'FA'.date("dmYHis", time());
       
        return view('achats.index', ['ach' => $ach, 'achats' => $achats, 'from_date' => $from_date, 'to_date' => $to_date, 'fa' => $fa]);
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

     public function downloadach(Request $request)
     {
         
         $entreprise = DB::table('entreprise')->where('id', 1)->first();
 
         //$from_date1 = $request->from_date1;
         //dd($from_date1);
         //$to_date1 = $request->to_date1;
 
         $achats = DB::table('achats')
            ->whereBetween('created_at', [$request->from_date1, $request->to_date1])
            ->orderByDesc('achats.created_at')
            ->get();
         //dd($ventes);
        
        $totfact = DB::table('achats')
        ->select(DB::raw('SUM(qtite) as Tqtite'), DB::raw('SUM(mont) as Tmont'), DB::raw('SUM(remise) as Tremise'), DB::raw('SUM(netccial) as Tmontht'), DB::raw('SUM(escpte) as Tescpte'), DB::raw('SUM(netfcier) as Tnetfcier'), DB::raw('SUM(mtva) as Tmtva'), DB::raw('SUM(mttc) as Tmttc'), DB::raw('SUM(fr_ach) as Tfr_ach'), DB::raw('SUM(netpay) as Tnetpay') )
        ->whereBetween('created_at', [$request->from_date1, $request->to_date1])
        ->from('achats')
        ->get();
        //affiche la date du jour
        $dat = date("d/m/Y", time());

        //dd($totfact);
        $tescpt = $totfact[0]->Tescpte;
        dd($tescpt);
        $rem = $totfact[0]->Tremise;
        $tfr_ach = $totfact[0]->Tfr_ach;
        // dans le cas où l'escompte et les frais d'achats sont nulls
        if (($tescpt=="0" ) && ($tfr_ach=="0")) {
            if ($rem=="0") {
                $pdf = PDF::loadView('achats.indexachpdf', ['achats' => $achats, 'totfact' => $totfact, 'entreprise' => $entreprise, 'dat' => $dat]);
                return $pdf->download('achats.pdf');
            } else
            {
                $pdf = PDF::loadView('achats.indexachpdfrem', ['achats' => $achats, 'totfact' => $totfact, 'entreprise' => $entreprise, 'dat' => $dat])->setPaper('a4', 'landscape');
                return $pdf->download('achats.pdf');
            }
        } 
        // dans le cas où l'escompte et les frais d'achats sont differents de zéros
        elseif (($tescpt!="0" ) && ($tfr_ach!="0")){
            if ($rem=="0") {
                $pdf = PDF::loadView('achats.indexachpdfescpt_frach', ['achats' => $achats, 'totfact' => $totfact, 'entreprise' => $entreprise, 'dat' => $dat])->setPaper('a4', 'landscape');
                return $pdf->download('achats.pdf');
            } else
            {
                $pdf = PDF::loadView('achats.indexachpdfescpt_frach_rem', ['achats' => $achats, 'totfact' => $totfact, 'entreprise' => $entreprise, 'dat' => $dat])->setPaper('a4', 'landscape');
                return $pdf->download('achatsok.pdf');
            }
        }
        // dans le cas où l'escompte est different de zéro
        elseif ($tescpt!="0") {
            if ($rem=="0") {
                $pdf = PDF::loadView('achats.indexachpdfescpt', ['achats' => $achats, 'totfact' => $totfact, 'entreprise' => $entreprise, 'dat' => $dat])->setPaper('a4', 'landscape');
                return $pdf->download('achats.pdf');
            } else
            {
                $pdf = PDF::loadView('achats.indexachpdfescpt_rem', ['achats' => $achats, 'totfact' => $totfact, 'entreprise' => $entreprise, 'dat' => $dat])->setPaper('a4', 'landscape');
                return $pdf->download('achats.pdf');
            }
        }
        // dans le cas où les frais d'achats sont differents de zéros
        elseif ($tfr_ach!="0") {
            if ($rem=="0") {
                $pdf = PDF::loadView('achats.indexachpdf_frach', ['achats' => $achats, 'totfact' => $totfact, 'entreprise' => $entreprise, 'dat' => $dat])->setPaper('a4', 'landscape');
                return $pdf->download('achats.pdf');
            } else
            {
                $pdf = PDF::loadView('achats.indexachpdf_frach_rem', ['achats' => $achats, 'totfact' => $totfact, 'entreprise' => $entreprise, 'dat' => $dat])->setPaper('a4', 'landscape');
                return $pdf->download('achats.pdf');
            }
        }
               
     }
     
     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

     public function downloadfactach(Request $request)
     {
         
         //$fact = DB::table('ventes')->where('numfact', $request->numfact)->first();
         $fact = DB::table('achats')
            ->where('numfact', $request->numfact1)
            ->get();
        //dd($fact);
        
        $totfact = DB::table('achats')
        ->select(DB::raw('SUM(qtite) as Tqtite'), DB::raw('SUM(mont) as Tmont'), DB::raw('SUM(remise) as Tremise'), DB::raw('SUM(netccial) as Tmontht'), DB::raw('SUM(escpte) as Tescpte'), DB::raw('SUM(netfcier) as Tnetfcier'), DB::raw('SUM(mtva) as Tmtva'), DB::raw('SUM(mttc) as Tmttc'), DB::raw('SUM(fr_ach) as Tfr_ach'), DB::raw('SUM(netpay) as Tnetpay') )
            ->where('numfact', $request->numfact1)
            ->from('achats')
            ->get();

        //dd($totfact);
        $tescpt = $totfact[0]->Tescpte;
        $rem = $totfact[0]->Tremise;
        $tfr_ach = $totfact[0]->Tfr_ach;
        //dd($rem);
        $nfact = $request->numfact1;
        //affiche la date du jour
        $dat = date("d/m/Y", time());

        $entreprise = DB::table('entreprise')->where('id', 1)->first();
         //dd($entreprise);
         //$pdf = PDF::loadView('ventes.indexpdf', ['entreprise' => $entreprise, 'ventes' => $ventes, 'vte' => $vte, 'totach' => $totach, 'marg' => $marg, 'from_date' => $from_date, 'to_date' => $to_date]);
         // dans le cas où l'escompte et les frais d'achats sont nulls
        if (($tescpt=="0" ) && ($tfr_ach=="0")) {
            if ($rem=="0") {
                $pdf = PDF::loadView('achats.facturepdf', ['fact' => $fact, 'totfact' => $totfact, 'entreprise' => $entreprise, 'nfact' => $nfact, 'dat' => $dat]);
                return $pdf->download('Factureachatok.pdf');
            } else
            {
                $pdf = PDF::loadView('achats.facturepdf_rem', ['fact' => $fact, 'totfact' => $totfact, 'entreprise' => $entreprise, 'nfact' => $nfact, 'dat' => $dat]);
                return $pdf->download('Factureachat1.pdf');
            }
        }
        
        // dans le cas où l'escompte et les frais d'achats sont differents de zéros
        elseif (($tescpt!="0" ) && ($tfr_ach!="0")){
            if ($rem=="0") {
                $pdf = PDF::loadView('achats.facturepdf_escpte_frach', ['fact' => $fact, 'totfact' => $totfact, 'entreprise' => $entreprise, 'nfact' => $nfact, 'dat' => $dat]);
                return $pdf->download('Factureachat2.pdf');
            } else
            {
                $pdf = PDF::loadView('achats.facturepdf_escpte_frach_rem', ['fact' => $fact, 'totfact' => $totfact, 'entreprise' => $entreprise, 'nfact' => $nfact, 'dat' => $dat]);
                return $pdf->download('Factureachat3.pdf');
            }
        }

        // dans le cas où l'escompte est different de zéro
        elseif ($tescpt!="0") {
            if ($rem=="0") {
                $pdf = PDF::loadView('achats.facturepdf_escpte', ['fact' => $fact, 'totfact' => $totfact, 'entreprise' => $entreprise, 'nfact' => $nfact, 'dat' => $dat]);
                return $pdf->download('Factureachat4.pdf');
            } else
            {
                $pdf = PDF::loadView('achats.facturepdf_escpte_rem', ['fact' => $fact, 'totfact' => $totfact, 'entreprise' => $entreprise, 'nfact' => $nfact, 'dat' => $dat]);
                return $pdf->download('Factureachat5.pdf');
            }
        }
        // dans le cas où les frais d'achats sont differents de zéros
        elseif ($tfr_ach!="0") {
            if ($rem=="0") {
                $pdf = PDF::loadView('achats.facturepdf_frach', ['fact' => $fact, 'totfact' => $totfact, 'entreprise' => $entreprise, 'nfact' => $nfact, 'dat' => $dat]);
                return $pdf->download('Factureachat6.pdf');
            } else
            {
                $pdf = PDF::loadView('achats.facturepdf_frach_rem', ['fact' => $fact, 'totfact' => $totfact, 'entreprise' => $entreprise, 'nfact' => $nfact, 'dat' => $dat]);
                return $pdf->download('Factureachat7.pdf');
            }
        }
     }

}
