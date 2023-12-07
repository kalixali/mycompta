<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\Journal;

use Illuminate\Http\Request;
use PDF;


class CpteResultController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
       return view('cpteresultat.index');
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
    public function getcpteresultat(Request $request)
    {
    if ((is_null($request->from_date)) && (is_null($request->to_date)) ) {
        return view('cpteresultat.index');
    } else
    {
       $exec0 = "COMPTE DE RESULTAT SYSTEME NORMAL DE L'EXERCICE ". $request->from_date . " AU " . $request->to_date;
       $exec = "EXERCICE AU " . $request->to_date;
       $exec2 = "EXERCICE AU 31/12/N-1";
       $exec3 = $request->from_date;
       $exec4 = $request->to_date;

       $produits = DB::table('Journal')
            ->select(DB::raw('SUM(Mcredit) - SUM(Mdebit) as produit'))
            ->whereBetween('created_at', [$request->from_date, $request->to_date])
            ->where('compte', 'like', '701%')
            ->get();

       $charges = DB::table('Journal')
            ->select(DB::raw('SUM(Mdebit) - SUM(Mcredit) as charge'))
            ->whereBetween('created_at', [$request->from_date, $request->to_date])
            ->where('compte', 'like', '601%')
            ->get();
        $varstock = DB::table('Journal')
            ->select(DB::raw('SUM(Mdebit) - SUM(Mcredit) as varstock'))
            ->whereBetween('created_at', [$request->from_date, $request->to_date])
            ->where('compte', 'like', '6031%')
            ->get();

        $MC = $produits[0]->produit-$charges[0]->charge-$varstock[0]->varstock;
        //PRODUITS FINIS
        $produitsf = DB::table('Journal')
            ->select(DB::raw('SUM(Mcredit) - SUM(Mdebit) as produitsf'))
            ->whereBetween('created_at', [$request->from_date, $request->to_date])
            ->where('compte', 'like', '702%')
            ->get();

        //SERVICES VENDUS
        $produitsv = DB::table('Journal')
            ->select(DB::raw('SUM(Mcredit) - SUM(Mdebit) as produitsv'))
            ->whereBetween('created_at', [$request->from_date, $request->to_date])
            ->where('compte', 'like', '706%')
            ->get();
        //PRODUCTION IMMOBILISEES
        $produitimo = DB::table('Journal')
            ->select(DB::raw('SUM(Mcredit) - SUM(Mdebit) as produitimo'))
            ->whereBetween('created_at', [$request->from_date, $request->to_date])
            ->where('compte', 'like', '72%')
            ->get();
        //PRODUCTION ACCESSOIRES
        $produitacc = DB::table('Journal')
            ->select(DB::raw('SUM(Mcredit) - SUM(Mdebit) as produitacc'))
            ->whereBetween('created_at', [$request->from_date, $request->to_date])
            ->where('compte', 'like', '707%')
            ->get();
        //SUBVENTION D'EXPLOITATION
        $subvexpl = DB::table('Journal')
            ->select(DB::raw('SUM(Mcredit) - SUM(Mdebit) as subvexpl'))
            ->whereBetween('created_at', [$request->from_date, $request->to_date])
            ->where('compte', 'like', '71%')
            ->get();
        //AUTRES PRODUITS
        $autrprod = DB::table('Journal')
            ->select(DB::raw('SUM(Mcredit) - SUM(Mdebit) as autrprod'))
            ->whereBetween('created_at', [$request->from_date, $request->to_date])
            ->where('compte', 'like', '75%')
            ->get();
        //CHIFFRE D'AFFAIRE
        $ca = $produits[0]->produit+$produitsf[0]->produitsf+$produitsv[0]->produitsv+$produitacc[0]->produitacc;
        //ACHATS MAT. PREMIERES ET FOURNITURES
        $achmat = DB::table('Journal')
            ->select(DB::raw('SUM(Mdebit) - SUM(Mcredit) as achmat'))
            ->whereBetween('created_at', [$request->from_date, $request->to_date])
            ->where('compte', 'like', '604%')
            ->get();

        $varstockm = DB::table('Journal')
            ->select(DB::raw('SUM(Mdebit) - SUM(Mcredit) as varstockm'))
            ->whereBetween('created_at', [$request->from_date, $request->to_date])
            ->where('compte', 'like', '6032%')
            ->get();
        //AUTRES ACHATS
        $autrch = DB::table('Journal')
            ->select(DB::raw('SUM(Mdebit) - SUM(Mcredit) as autrch'))
            ->whereBetween('created_at', [$request->from_date, $request->to_date])
            ->where('compte', 'like', '605%')
            ->get();

        $varstocka = DB::table('Journal')
            ->select(DB::raw('SUM(Mdebit) - SUM(Mcredit) as varstocka'))
            ->whereBetween('created_at', [$request->from_date, $request->to_date])
            ->where('compte', 'like', '6033%')
            ->get();
        //TRANSPORT
        $trsport = DB::table('Journal')
            ->select(DB::raw('SUM(Mdebit) - SUM(Mcredit) as trsport'))
            ->whereBetween('created_at', [$request->from_date, $request->to_date])
            ->where('compte', 'like', '61%')
            ->get();
        //SERVICES EXTERIEURS
        $scext = DB::table('Journal')
            ->select(DB::raw('SUM(Mdebit) - SUM(Mcredit) as scext'))
            ->whereBetween('created_at', [$request->from_date, $request->to_date])
            ->where('compte', 'like', '62%')
            ->get();

        //IMPOTS ET TAXES
        $imptax = DB::table('Journal')
            ->select(DB::raw('SUM(Mdebit) - SUM(Mcredit) as imptax'))
            ->whereBetween('created_at', [$request->from_date, $request->to_date])
            ->where('compte', 'like', '64%')
            ->get();

        //AUTRES CHARGES
        $autrchg = DB::table('Journal')
            ->select(DB::raw('SUM(Mdebit) - SUM(Mcredit) as autrchg'))
            ->whereBetween('created_at', [$request->from_date, $request->to_date])
            ->where('compte', 'like', '65%')
            ->get();
        //VALEUR AJOUTEE
        $valajoute = ($produits[0]->produit+$produitsf[0]->produitsf+$produitsv[0]->produitsv+$produitimo[0]->produitimo+$produitacc[0]->produitacc+$autrprod[0]->autrprod+$subvexpl[0]->subvexpl)-($charges[0]->charge+$varstock[0]->varstock+$achmat[0]->achmat+$varstockm[0]->varstockm+$autrch[0]->autrch+$varstocka[0]->varstocka+$trsport[0]->trsport+$scext[0]->scext+$imptax[0]->imptax+$autrchg[0]->autrchg);
        //CHARGES DE PERSONNEL
        $chargpers = DB::table('Journal')
            ->select(DB::raw('SUM(Mdebit) - SUM(Mcredit) as chargpers'))
            ->whereBetween('created_at', [$request->from_date, $request->to_date])
            ->where('compte', 'like', '66%')
            ->get();
        //EXCEDENT BRUT D'EXPLOITATION
        $exbrutexpl = $valajoute-$chargpers[0]->chargpers;
        //dd($exbrutexpl);
        //REPRISES DE PROVISIONS - DE DEPRECIATIONS ET AUTRES
        $repprov = DB::table('Journal')
            ->select(DB::raw('SUM(Mcredit) - SUM(Mdebit) as repprov'))
            ->whereBetween('created_at', [$request->from_date, $request->to_date])
            ->where('compte', 'like', '79%')
            ->get();
        //TRANSFERT DE CHARGES
        $trsfcharg = DB::table('Journal')
            ->select(DB::raw('SUM(Mcredit) - SUM(Mdebit) as trsfcharg'))
            ->whereBetween('created_at', [$request->from_date, $request->to_date])
            ->where('compte', 'like', '78%')
            ->get();
        //DOTATIONS AUX AMORTISSEMENTS
        $dotamort = DB::table('Journal')
            ->select(DB::raw('SUM(Mdebit) - SUM(Mcredit) as dotamort'))
            ->whereBetween('created_at', [$request->from_date, $request->to_date])
            ->where('compte', 'like', '68%')
            ->get();
        //DOTATIONS AUX PROVISIONS ET AUX DEPRECIATIONS
        $dotprovdep = DB::table('Journal')
            ->select(DB::raw('SUM(Mdebit) - SUM(Mcredit) as dotprovdep'))
            ->whereBetween('created_at', [$request->from_date, $request->to_date])
            ->where('compte', 'like', '69%')
            ->get();
        //RESULTAT D'EXPLOITATION
        $resultexpl = $exbrutexpl+$repprov[0]->repprov+$trsfcharg[0]->trsfcharg-$dotamort[0]->dotamort-$dotprovdep[0]->dotprovdep;
        //REVENUS FINANCIERS ET PRODUITS ASSIMILES
        $revfcierpa = DB::table('Journal')
            ->select(DB::raw('SUM(Mcredit) - SUM(Mdebit) as revfcierpa'))
            ->whereBetween('created_at', [$request->from_date, $request->to_date])
            ->where('compte', 'like', '77%')
            ->get();
        //FRAIS FINANCIERS ET CHARGES ASSIMILES
        $frfciercha = DB::table('Journal')
            ->select(DB::raw('SUM(Mdebit) - SUM(Mcredit) as frfciercha'))
            ->whereBetween('created_at', [$request->from_date, $request->to_date])
            ->where('compte', 'like', '67%')
            ->get();
        //RESULTAT FINANCIER
        $resultfcier = $revfcierpa[0]->revfcierpa-$frfciercha[0]->frfciercha;
        //RESULTAT COURANT
        $resultcour = $resultexpl+$resultfcier;
        //PRODUIT DE CESSIONS DES IMMO.
        $prodcessimmo = DB::table('Journal')
            ->select(DB::raw('SUM(Mcredit) - SUM(Mdebit) as prodcessimmo'))
            ->whereBetween('created_at', [$request->from_date, $request->to_date])
            ->where('compte', 'like', '82%')
            ->get();
        //PRODUIT NON COURANTS CONSTATES
        $prodnoncourc = DB::table('Journal')
            ->select(DB::raw('SUM(Mcredit) - SUM(Mdebit) as prodnoncourc'))
            ->whereBetween('created_at', [$request->from_date, $request->to_date])
            ->where('compte', 'like', '84%')
            ->get();
        //REPRISES NON COURANTS
        $repnoncour = DB::table('Journal')
            ->select(DB::raw('SUM(Mcredit) - SUM(Mdebit) as repnoncour'))
            ->whereBetween('created_at', [$request->from_date, $request->to_date])
            ->where('compte', 'like', '86%')
            ->get();
        //TOTAL PRODUITS NON COURANT
        $totprodnoncour = $prodcessimmo[0]->prodcessimmo+$prodnoncourc[0]->prodnoncourc+$repnoncour[0]->repnoncour;
        //VALEURS COMPTABLE DES CESSIONS D'IMMOBILISATION
        $vcptcess = DB::table('Journal')
            ->select(DB::raw('SUM(Mdebit) - SUM(Mcredit) as vcptcess'))
            ->whereBetween('created_at', [$request->from_date, $request->to_date])
            ->where('compte', 'like', '81%')
            ->get();
        //CHARGES NON COURANTS CONSTATEES
        $chargnoncourc = DB::table('Journal')
            ->select(DB::raw('SUM(Mdebit) - SUM(Mcredit) as chargnoncourc'))
            ->whereBetween('created_at', [$request->from_date, $request->to_date])
            ->where('compte', 'like', '81%')
            ->get();
        //DOTATIONS NON COURANTS
        $dotnoncour = DB::table('Journal')
            ->select(DB::raw('SUM(Mdebit) - SUM(Mcredit) as dotnoncour'))
            ->whereBetween('created_at', [$request->from_date, $request->to_date])
            ->where('compte', 'like', '85%')
            ->get();
        //TOTAL CHARGES NON COURANT
        $totchargnoncour = $vcptcess[0]->vcptcess+$chargnoncourc[0]->chargnoncourc+$dotnoncour[0]->dotnoncour;
        //RESULTAT AVANT PRELEVEMENT
        $resultavpre = $resultcour+$totprodnoncour-$totchargnoncour;
        //PARTICIPATION DES TRAVAILLEURS
        $partitravr = DB::table('Journal')
            ->select(DB::raw('SUM(Mdebit) - SUM(Mcredit) as partitravr'))
            ->whereBetween('created_at', [$request->from_date, $request->to_date])
            ->where('compte', 'like', '87%')
            ->get();
        //IMPOT SUR LE RESULTAT
        $imporesult = DB::table('Journal')
            ->select(DB::raw('SUM(Mdebit) - SUM(Mcredit) as imporesult'))
            ->whereBetween('created_at', [$request->from_date, $request->to_date])
            ->where('compte', 'like', '89%')
            ->get();
        //RESULTAT NET
        $resultnet = $resultavpre-$partitravr[0]->partitravr-$imporesult[0]->imporesult;
        return view('cpteresultat.index1', ['exec0' => $exec0, 'exec' => $exec, 'exec2' => $exec2, 'exec3' => $exec3, 'exec4' => $exec4, 'produits' => $produits, 'charges' => $charges, 'varstock' => $varstock, 'MC' => $MC, 'produitsf' => $produitsf, 'produitsv' => $produitsv, 'produitimo' => $produitimo, 'produitacc' => $produitacc, 'subvexpl' => $subvexpl, 'autrprod' => $autrprod, 'ca' => $ca, 'achmat' => $achmat, 'varstockm' => $varstockm, 'autrch' => $autrch, 'varstocka' => $varstocka, 'trsport' => $trsport, 'scext' => $scext, 'imptax' => $imptax, 'autrchg' => $autrchg, 'valajoute' => $valajoute, 'chargpers' => $chargpers, 'exbrutexpl' => $exbrutexpl, 'repprov' => $repprov, 'trsfcharg' => $trsfcharg, 'repprov' => $repprov, 'dotamort' => $dotamort, 'dotprovdep' => $dotprovdep, 'resultexpl' => $resultexpl, 'revfcierpa' => $revfcierpa, 'frfciercha' => $frfciercha, 'resultfcier' => $resultfcier, 'resultcour' => $resultcour, 'prodcessimmo' => $prodcessimmo, 'prodnoncourc' => $prodnoncourc, 'repnoncour' => $repnoncour, 'totprodnoncour' => $totprodnoncour, 'vcptcess' => $vcptcess, 'chargnoncourc' => $chargnoncourc, 'dotnoncour' => $dotnoncour, 'totchargnoncour' => $totchargnoncour, 'resultavpre' => $resultavpre, 'partitravr' => $partitravr, 'imporesult' => $imporesult, 'resultnet' => $resultnet]);
    } 
    }

    public function downloadPDFcpteresultat(Request $request)
    {
    $exec0 = "COMPTE DE RESULTAT SYSTEME NORMAL DE L'EXERCICE ". $request->from_date . " AU " . $request->to_date;
       $exec = "EXERCICE AU " . $request->to_date;
       $exec2 = "EXERCICE AU 31/12/N-1";
       $exec3 = $request->from_date;
       $exec4 = $request->to_date;

       $produits = DB::table('Journal')
            ->select(DB::raw('SUM(Mcredit) - SUM(Mdebit) as produit'))
            ->whereBetween('created_at', [$request->from_date, $request->to_date])
            ->where('compte', 'like', '701%')
            ->get();

       $charges = DB::table('Journal')
            ->select(DB::raw('SUM(Mdebit) - SUM(Mcredit) as charge'))
            ->whereBetween('created_at', [$request->from_date, $request->to_date])
            ->where('compte', 'like', '601%')
            ->get();
        $varstock = DB::table('Journal')
            ->select(DB::raw('SUM(Mdebit) - SUM(Mcredit) as varstock'))
            ->whereBetween('created_at', [$request->from_date, $request->to_date])
            ->where('compte', 'like', '6031%')
            ->get();

        $MC = $produits[0]->produit-$charges[0]->charge-$varstock[0]->varstock;
        //PRODUITS FINIS
        $produitsf = DB::table('Journal')
            ->select(DB::raw('SUM(Mcredit) - SUM(Mdebit) as produitsf'))
            ->whereBetween('created_at', [$request->from_date, $request->to_date])
            ->where('compte', 'like', '702%')
            ->get();

        //SERVICES VENDUS
        $produitsv = DB::table('Journal')
            ->select(DB::raw('SUM(Mcredit) - SUM(Mdebit) as produitsv'))
            ->whereBetween('created_at', [$request->from_date, $request->to_date])
            ->where('compte', 'like', '706%')
            ->get();
        //PRODUCTION IMMOBILISEES
        $produitimo = DB::table('Journal')
            ->select(DB::raw('SUM(Mcredit) - SUM(Mdebit) as produitimo'))
            ->whereBetween('created_at', [$request->from_date, $request->to_date])
            ->where('compte', 'like', '72%')
            ->get();
        //PRODUCTION ACCESSOIRES
        $produitacc = DB::table('Journal')
            ->select(DB::raw('SUM(Mcredit) - SUM(Mdebit) as produitacc'))
            ->whereBetween('created_at', [$request->from_date, $request->to_date])
            ->where('compte', 'like', '707%')
            ->get();
        //SUBVENTION D'EXPLOITATION
        $subvexpl = DB::table('Journal')
            ->select(DB::raw('SUM(Mcredit) - SUM(Mdebit) as subvexpl'))
            ->whereBetween('created_at', [$request->from_date, $request->to_date])
            ->where('compte', 'like', '71%')
            ->get();
        //AUTRES PRODUITS
        $autrprod = DB::table('Journal')
            ->select(DB::raw('SUM(Mcredit) - SUM(Mdebit) as autrprod'))
            ->whereBetween('created_at', [$request->from_date, $request->to_date])
            ->where('compte', 'like', '75%')
            ->get();
        //CHIFFRE D'AFFAIRE
        $ca = $produits[0]->produit+$produitsf[0]->produitsf+$produitsv[0]->produitsv+$produitacc[0]->produitacc;
        //ACHATS MAT. PREMIERES ET FOURNITURES
        $achmat = DB::table('Journal')
            ->select(DB::raw('SUM(Mdebit) - SUM(Mcredit) as achmat'))
            ->whereBetween('created_at', [$request->from_date, $request->to_date])
            ->where('compte', 'like', '604%')
            ->get();

        $varstockm = DB::table('Journal')
            ->select(DB::raw('SUM(Mdebit) - SUM(Mcredit) as varstockm'))
            ->whereBetween('created_at', [$request->from_date, $request->to_date])
            ->where('compte', 'like', '6032%')
            ->get();
        //AUTRES ACHATS
        $autrch = DB::table('Journal')
            ->select(DB::raw('SUM(Mdebit) - SUM(Mcredit) as autrch'))
            ->whereBetween('created_at', [$request->from_date, $request->to_date])
            ->where('compte', 'like', '605%')
            ->get();

        $varstocka = DB::table('Journal')
            ->select(DB::raw('SUM(Mdebit) - SUM(Mcredit) as varstocka'))
            ->whereBetween('created_at', [$request->from_date, $request->to_date])
            ->where('compte', 'like', '6033%')
            ->get();
        //TRANSPORT
        $trsport = DB::table('Journal')
            ->select(DB::raw('SUM(Mdebit) - SUM(Mcredit) as trsport'))
            ->whereBetween('created_at', [$request->from_date, $request->to_date])
            ->where('compte', 'like', '61%')
            ->get();
        //SERVICES EXTERIEURS
        $scext = DB::table('Journal')
            ->select(DB::raw('SUM(Mdebit) - SUM(Mcredit) as scext'))
            ->whereBetween('created_at', [$request->from_date, $request->to_date])
            ->where('compte', 'like', '62%')
            ->get();

        //IMPOTS ET TAXES
        $imptax = DB::table('Journal')
            ->select(DB::raw('SUM(Mdebit) - SUM(Mcredit) as imptax'))
            ->whereBetween('created_at', [$request->from_date, $request->to_date])
            ->where('compte', 'like', '64%')
            ->get();

        //AUTRES CHARGES
        $autrchg = DB::table('Journal')
            ->select(DB::raw('SUM(Mdebit) - SUM(Mcredit) as autrchg'))
            ->whereBetween('created_at', [$request->from_date, $request->to_date])
            ->where('compte', 'like', '65%')
            ->get();
        //VALEUR AJOUTEE
        $valajoute = ($produits[0]->produit+$produitsf[0]->produitsf+$produitsv[0]->produitsv+$produitimo[0]->produitimo+$produitacc[0]->produitacc+$autrprod[0]->autrprod+$subvexpl[0]->subvexpl)-($charges[0]->charge+$varstock[0]->varstock+$achmat[0]->achmat+$varstockm[0]->varstockm+$autrch[0]->autrch+$varstocka[0]->varstocka+$trsport[0]->trsport+$scext[0]->scext+$imptax[0]->imptax+$autrchg[0]->autrchg);
        //CHARGES DE PERSONNEL
        $chargpers = DB::table('Journal')
            ->select(DB::raw('SUM(Mdebit) - SUM(Mcredit) as chargpers'))
            ->whereBetween('created_at', [$request->from_date, $request->to_date])
            ->where('compte', 'like', '66%')
            ->get();
        //EXCEDENT BRUT D'EXPLOITATION
        $exbrutexpl = $valajoute-$chargpers[0]->chargpers;
        //dd($exbrutexpl);
        //REPRISES DE PROVISIONS - DE DEPRECIATIONS ET AUTRES
        $repprov = DB::table('Journal')
            ->select(DB::raw('SUM(Mcredit) - SUM(Mdebit) as repprov'))
            ->whereBetween('created_at', [$request->from_date, $request->to_date])
            ->where('compte', 'like', '79%')
            ->get();
        //TRANSFERT DE CHARGES
        $trsfcharg = DB::table('Journal')
            ->select(DB::raw('SUM(Mcredit) - SUM(Mdebit) as trsfcharg'))
            ->whereBetween('created_at', [$request->from_date, $request->to_date])
            ->where('compte', 'like', '78%')
            ->get();
        //DOTATIONS AUX AMORTISSEMENTS
        $dotamort = DB::table('Journal')
            ->select(DB::raw('SUM(Mdebit) - SUM(Mcredit) as dotamort'))
            ->whereBetween('created_at', [$request->from_date, $request->to_date])
            ->where('compte', 'like', '68%')
            ->get();
        //DOTATIONS AUX PROVISIONS ET AUX DEPRECIATIONS
        $dotprovdep = DB::table('Journal')
            ->select(DB::raw('SUM(Mdebit) - SUM(Mcredit) as dotprovdep'))
            ->whereBetween('created_at', [$request->from_date, $request->to_date])
            ->where('compte', 'like', '69%')
            ->get();
        //RESULTAT D'EXPLOITATION
        $resultexpl = $exbrutexpl+$repprov[0]->repprov+$trsfcharg[0]->trsfcharg-$dotamort[0]->dotamort-$dotprovdep[0]->dotprovdep;
        //REVENUS FINANCIERS ET PRODUITS ASSIMILES
        $revfcierpa = DB::table('Journal')
            ->select(DB::raw('SUM(Mcredit) - SUM(Mdebit) as revfcierpa'))
            ->whereBetween('created_at', [$request->from_date, $request->to_date])
            ->where('compte', 'like', '77%')
            ->get();
        //FRAIS FINANCIERS ET CHARGES ASSIMILES
        $frfciercha = DB::table('Journal')
            ->select(DB::raw('SUM(Mdebit) - SUM(Mcredit) as frfciercha'))
            ->whereBetween('created_at', [$request->from_date, $request->to_date])
            ->where('compte', 'like', '67%')
            ->get();
        //RESULTAT FINANCIER
        $resultfcier = $revfcierpa[0]->revfcierpa-$frfciercha[0]->frfciercha;
        //RESULTAT COURANT
        $resultcour = $resultexpl+$resultfcier;
        //PRODUIT DE CESSIONS DES IMMO.
        $prodcessimmo = DB::table('Journal')
            ->select(DB::raw('SUM(Mcredit) - SUM(Mdebit) as prodcessimmo'))
            ->whereBetween('created_at', [$request->from_date, $request->to_date])
            ->where('compte', 'like', '82%')
            ->get();
        //PRODUIT NON COURANTS CONSTATES
        $prodnoncourc = DB::table('Journal')
            ->select(DB::raw('SUM(Mcredit) - SUM(Mdebit) as prodnoncourc'))
            ->whereBetween('created_at', [$request->from_date, $request->to_date])
            ->where('compte', 'like', '84%')
            ->get();
        //REPRISES NON COURANTS
        $repnoncour = DB::table('Journal')
            ->select(DB::raw('SUM(Mcredit) - SUM(Mdebit) as repnoncour'))
            ->whereBetween('created_at', [$request->from_date, $request->to_date])
            ->where('compte', 'like', '86%')
            ->get();
        //TOTAL PRODUITS NON COURANT
        $totprodnoncour = $prodcessimmo[0]->prodcessimmo+$prodnoncourc[0]->prodnoncourc+$repnoncour[0]->repnoncour;
        //VALEURS COMPTABLE DES CESSIONS D'IMMOBILISATION
        $vcptcess = DB::table('Journal')
            ->select(DB::raw('SUM(Mdebit) - SUM(Mcredit) as vcptcess'))
            ->whereBetween('created_at', [$request->from_date, $request->to_date])
            ->where('compte', 'like', '81%')
            ->get();
        //CHARGES NON COURANTS CONSTATEES
        $chargnoncourc = DB::table('Journal')
            ->select(DB::raw('SUM(Mdebit) - SUM(Mcredit) as chargnoncourc'))
            ->whereBetween('created_at', [$request->from_date, $request->to_date])
            ->where('compte', 'like', '81%')
            ->get();
        //DOTATIONS NON COURANTS
        $dotnoncour = DB::table('Journal')
            ->select(DB::raw('SUM(Mdebit) - SUM(Mcredit) as dotnoncour'))
            ->whereBetween('created_at', [$request->from_date, $request->to_date])
            ->where('compte', 'like', '85%')
            ->get();
        //TOTAL CHARGES NON COURANT
        $totchargnoncour = $vcptcess[0]->vcptcess+$chargnoncourc[0]->chargnoncourc+$dotnoncour[0]->dotnoncour;
        //RESULTAT AVANT PRELEVEMENT
        $resultavpre = $resultcour+$totprodnoncour-$totchargnoncour;
        //PARTICIPATION DES TRAVAILLEURS
        $partitravr = DB::table('Journal')
            ->select(DB::raw('SUM(Mdebit) - SUM(Mcredit) as partitravr'))
            ->whereBetween('created_at', [$request->from_date, $request->to_date])
            ->where('compte', 'like', '87%')
            ->get();
        //IMPOT SUR LE RESULTAT
        $imporesult = DB::table('Journal')
            ->select(DB::raw('SUM(Mdebit) - SUM(Mcredit) as imporesult'))
            ->whereBetween('created_at', [$request->from_date, $request->to_date])
            ->where('compte', 'like', '89%')
            ->get();
        //RESULTAT NET
        $resultnet = $resultavpre-$partitravr[0]->partitravr-$imporesult[0]->imporesult;

    $pdf = PDF::loadView('cpteresultat.pdfresultat', ['exec0' => $exec0, 'exec' => $exec, 'exec2' => $exec2, 'exec3' => $exec3, 'exec4' => $exec4, 'produits' => $produits, 'charges' => $charges, 'varstock' => $varstock, 'MC' => $MC, 'produitsf' => $produitsf, 'produitsv' => $produitsv, 'produitimo' => $produitimo, 'produitacc' => $produitacc, 'subvexpl' => $subvexpl, 'autrprod' => $autrprod, 'ca' => $ca, 'achmat' => $achmat, 'varstockm' => $varstockm, 'autrch' => $autrch, 'varstocka' => $varstocka, 'trsport' => $trsport, 'scext' => $scext, 'imptax' => $imptax, 'autrchg' => $autrchg, 'valajoute' => $valajoute, 'chargpers' => $chargpers, 'exbrutexpl' => $exbrutexpl, 'repprov' => $repprov, 'trsfcharg' => $trsfcharg, 'repprov' => $repprov, 'dotamort' => $dotamort, 'dotprovdep' => $dotprovdep, 'resultexpl' => $resultexpl, 'revfcierpa' => $revfcierpa, 'frfciercha' => $frfciercha, 'resultfcier' => $resultfcier, 'resultcour' => $resultcour, 'prodcessimmo' => $prodcessimmo, 'prodnoncourc' => $prodnoncourc, 'repnoncour' => $repnoncour, 'totprodnoncour' => $totprodnoncour, 'vcptcess' => $vcptcess, 'chargnoncourc' => $chargnoncourc, 'dotnoncour' => $dotnoncour, 'totchargnoncour' => $totchargnoncour, 'resultavpre' => $resultavpre, 'partitravr' => $partitravr, 'imporesult' => $imporesult, 'resultnet' => $resultnet]); 

    return $pdf->download('cpteresultat.pdf');
    }
}
