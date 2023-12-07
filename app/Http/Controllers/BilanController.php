<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\Journal;

use Illuminate\Http\Request;
use PDF;


class BilanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('bilan.index');
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
    public function getbilan(Request $request)
    {
        if ((is_null($request->from_date)) && (is_null($request->to_date)) ) {
            return view('bilan.index');
        } else
        {
        //COMPTE DE RESULTAT****************************************************************************
        //************************************************************************************************
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
        $resultat = $resultavpre-$partitravr[0]->partitravr-$imporesult[0]->imporesult;
        
        //Bilan********************************************************************

        $exec0 = " DU " . $request->from_date . " AU " . $request->to_date;
        $exec = "EXERCICE AU " . $request->to_date;
        $exec1 = $request->from_date;
        $exec2 = $request->to_date;
        //dd($exec);

        //ACTIF
        // immobilisations
        /*
        $immo = DB::table('Journal')
            ->select(DB::raw('SUM(Mdebit) - SUM(Mcredit) as immo'))
            ->whereBetween('created_at', [$request->from_date, $request->to_date])
            ->where('compte', 'like', '2%')
            ->get();
        */
        // immo incorporelles
        $immo21 = DB::table('Journal')
            ->select(DB::raw('SUM(Mdebit) - SUM(Mcredit) as immo21'))
            ->whereBetween('created_at', [$request->from_date, $request->to_date])
            ->where('compte', 'like', '21%')
            ->get();

        // immo terrains
        $immo22 = DB::table('Journal')
            ->select(DB::raw('SUM(Mdebit) - SUM(Mcredit) as immo22'))
            ->whereBetween('created_at', [$request->from_date, $request->to_date])
            ->where('compte', 'like', '22%')
            ->get();

        // immo batiments, installations techniques et agencement

        $immo23 = DB::table('Journal')
            ->select(DB::raw('SUM(Mdebit) - SUM(Mcredit) as immo23'))
            ->whereBetween('created_at', [$request->from_date, $request->to_date])
            ->where('compte', 'like', '23%')
            ->get();

        // immo materiels, mobiliers et actifs biologiques
        $immo24 = DB::table('Journal')
            ->select(DB::raw('SUM(Mdebit) - SUM(Mcredit) as immo24'))
            ->whereBetween('created_at', [$request->from_date, $request->to_date])
            ->where('compte', 'like', '24%')
            ->get();

        // immo avances et accomptes versées sur immobilisation
        $immo25 = DB::table('Journal')
            ->select(DB::raw('SUM(Mdebit) - SUM(Mcredit) as immo25'))
            ->whereBetween('created_at', [$request->from_date, $request->to_date])
            ->where('compte', 'like', '25%')
            ->get();
        // immo titres de participation
        $immo26 = DB::table('Journal')
            ->select(DB::raw('SUM(Mdebit) - SUM(Mcredit) as immo26'))
            ->whereBetween('created_at', [$request->from_date, $request->to_date])
            ->where('compte', 'like', '26%')
            ->get();
        // immo autres immo financières
        $immo27 = DB::table('Journal')
            ->select(DB::raw('SUM(Mdebit) - SUM(Mcredit) as immo27'))
            ->whereBetween('created_at', [$request->from_date, $request->to_date])
            ->where('compte', 'like', '27%')
            ->get();
        // immo amortissements
        $immo28 = DB::table('Journal')
            ->select(DB::raw('SUM(Mdebit) - SUM(Mcredit) as immo28'))
            ->whereBetween('created_at', [$request->from_date, $request->to_date])
            ->where('compte', 'like', '28%')
            ->get();

        // immo depreciation des immo
        $immo29 = DB::table('Journal')
            ->select(DB::raw('SUM(Mdebit) - SUM(Mcredit) as immo29'))
            ->whereBetween('created_at', [$request->from_date, $request->to_date])
            ->where('compte', 'like', '29%')
            ->get();
        //TOTAL IMMO.
        $immo = $immo21[0]->immo21+$immo22[0]->immo22+$immo23[0]->immo23+$immo24[0]->immo24+$immo25[0]->immo25+$immo26[0]->immo26+$immo27[0]->immo27-$immo28[0]->immo28-$immo29[0]->immo29;

        // stocks
        $stock = DB::table('Journal')
            ->select(DB::raw('SUM(Mdebit) - SUM(Mcredit) as stock'))
            ->whereBetween('created_at', [$request->from_date, $request->to_date])
            ->where('compte', 'like', '3%')
            ->get();
        //depreciation des stocks
        $stockd = DB::table('Journal')
            ->select(DB::raw('SUM(Mdebit) - SUM(Mcredit) as stockd'))
            ->whereBetween('created_at', [$request->from_date, $request->to_date])
            ->where('compte', 'like', '39%')
            ->get();
        //Total stocks
        $Tstock = $stock[0]->stock-$stockd[0]->stockd;
        
        // clients (creances)
        $clt = DB::table('Journal')
            ->select(DB::raw('SUM(Mdebit) - SUM(Mcredit) as clt'))
            ->whereBetween('created_at', [$request->from_date, $request->to_date])
            ->where('compte', 'like', '411%')
            ->get();
        //depreciation des comptes clients
         $cltd = DB::table('Journal')
            ->select(DB::raw('SUM(Mdebit) - SUM(Mcredit) as cltd'))
            ->whereBetween('created_at', [$request->from_date, $request->to_date])
            ->where('compte', 'like', '491%')
            ->get();
        // founisseurs avances et accomptes versées
        $fournaav = DB::table('Journal')
            ->select(DB::raw('SUM(Mdebit) - SUM(Mcredit) as fournaav'))
            ->whereBetween('created_at', [$request->from_date, $request->to_date])
            ->where('compte', 'like', '4091%')
            ->get();

        $Totactcir = $stock[0]->stock-$stockd[0]->stockd+$clt[0]->clt-$cltd[0]->cltd+$fournaav[0]->fournaav;
        
        //titre de placement
        $titrepla = DB::table('Journal')
            ->select(DB::raw('SUM(Mdebit) - SUM(Mcredit) as titrepla'))
            ->whereBetween('created_at', [$request->from_date, $request->to_date])
            ->where('compte', 'like', '50%')
            ->get();

        //Valeurs à encaisser (effets de cce et autres)
        $vencais = DB::table('Journal')
            ->select(DB::raw('SUM(Mdebit) - SUM(Mcredit) as vencais'))
            ->whereBetween('created_at', [$request->from_date, $request->to_date])
            ->where('compte', 'like', '51%')
            ->get();
        //Banques
        $banq = DB::table('Journal')
            ->select(DB::raw('SUM(Mdebit) - SUM(Mcredit) as banq'))
            ->whereBetween('created_at', [$request->from_date, $request->to_date])
            ->where('compte', 'like', '52%')
            ->get();
        //etablissements fciers et assimilés
        
        $etfcier = DB::table('Journal')
            ->select(DB::raw('SUM(Mdebit) - SUM(Mcredit) as etfcier'))
            ->whereBetween('created_at', [$request->from_date, $request->to_date])
            ->where('compte', 'like', '53%')
            ->get();
        //caisse
        $cais = DB::table('Journal')
            ->select(DB::raw('SUM(Mdebit) - SUM(Mcredit) as cais'))
            ->whereBetween('created_at', [$request->from_date, $request->to_date])
            ->where('compte', 'like', '57%')
            ->get();
        //depreciation banque
        $banqd = DB::table('Journal')
            ->select(DB::raw('SUM(Mdebit) - SUM(Mcredit) as banqd'))
            ->whereBetween('created_at', [$request->from_date, $request->to_date])
            ->where('compte', 'like', '59%')
            ->get();

        $TOTtresor = $titrepla[0]->titrepla+$vencais[0]->vencais+$banq[0]->banq+$etfcier[0]->etfcier+$cais[0]->cais-$banqd[0]->banqd;
        //PASSIF
        //TOTAL COMPTES DES RESSOURCES DURABLES
        $crd = DB::table('Journal')
            ->select(DB::raw('SUM(Mcredit) - SUM(Mdebit) as crd'))
            ->whereBetween('created_at', [$request->from_date, $request->to_date])
            ->where('compte', 'like', '1%')
            ->get();
        
        //capital
        $cap = DB::table('Journal')
            ->select(DB::raw('SUM(Mcredit) - SUM(Mdebit) as cap'))
            ->whereBetween('created_at', [$request->from_date, $request->to_date])
            ->where('compte', 'like', '10%')
            ->get();
        //reserves
        $resv = DB::table('Journal')
            ->select(DB::raw('SUM(Mcredit) - SUM(Mdebit) as resv'))
            ->whereBetween('created_at', [$request->from_date, $request->to_date])
            ->where('compte', 'like', '11%')
            ->get();
        //report a nouveau
        $repn = DB::table('Journal')
            ->select(DB::raw('SUM(Mcredit) - SUM(Mdebit) as repn'))
            ->whereBetween('created_at', [$request->from_date, $request->to_date])
            ->where('compte', 'like', '12%')
            ->get();
        /*
        //resultat net
        $resnet = DB::table('Journal')
            ->select(DB::raw('SUM(Mcredit) - SUM(Mdebit) as resnet'))
            ->whereBetween('created_at', [$request->from_date, $request->to_date])
            ->where('compte', 'like', '13%')
            ->get();
        */
        //subventions d'investissement
        $subinv = DB::table('Journal')
            ->select(DB::raw('SUM(Mcredit) - SUM(Mdebit) as subinv'))
            ->whereBetween('created_at', [$request->from_date, $request->to_date])
            ->where('compte', 'like', '14%')
            ->get();
        //provisions reglementées
        $provreg = DB::table('Journal')
            ->select(DB::raw('SUM(Mcredit) - SUM(Mdebit) as provreg'))
            ->whereBetween('created_at', [$request->from_date, $request->to_date])
            ->where('compte', 'like', '15%')
            ->get();
        //dd($provreg);
        //emprunts et dettes 
        $empdet = DB::table('Journal')
            ->select(DB::raw('SUM(Mdebit) - SUM(Mcredit) as empdet'))
            ->whereYear('created_at', (date("Y", time()) - 1))
            ->where('compte', 'like', '16%')
            ->get();

        //dettes de location
        $detloc = DB::table('Journal')
            ->select(DB::raw('SUM(Mdebit) - SUM(Mcredit) as detloc'))
            ->whereYear('created_at', (date("Y", time()) - 1))
            ->where('compte', 'like', '17%')
            ->get();
        //dettes liés à des participations et comptes de liaison des etabliss. et société en participation
        
        $detparclesp = DB::table('Journal')
            ->select(DB::raw('SUM(Mcredit) - SUM(Mdebit) as detparclesp'))
            ->whereBetween('created_at', [$request->from_date, $request->to_date])
            ->where('compte', 'like', '18%')
            ->get();
        //provision pour risques et charges
        $provrc = DB::table('Journal')
            ->select(DB::raw('SUM(Mcredit) - SUM(Mdebit) as provrc'))
            ->whereBetween('created_at', [$request->from_date, $request->to_date])
            ->where('compte', 'like', '19%')
            ->get();
                
        //clt avances et accomptes recues
        $cltacr = DB::table('Journal')
            ->select(DB::raw('SUM(Mcredit) - SUM(Mdebit) as cltacr'))
            ->whereBetween('created_at', [$request->from_date, $request->to_date])
            ->where('compte', 'like', '4191%')
            ->get();
        //dettes fournisseurs
        $fourn = DB::table('Journal')
            ->select(DB::raw('SUM(Mcredit) - SUM(Mdebit) as fourn'))
            ->whereBetween('created_at', [$request->from_date, $request->to_date])
            ->where('compte', 'like', '401%')
            ->get();
        /*
        //depreciation des comptes fournisseurs
        $fournd = DB::table('Journal')
            ->select(DB::raw('SUM(Mcredit) - SUM(Mdebit) as fournd'))
            ->whereBetween('created_at', [$request->from_date, $request->to_date])
            ->where('compte', 'like', '490%')
            ->get();
        */
        //dettes sociales
        $detsocial = DB::table('Journal')
            ->select(DB::raw('SUM(Mcredit) - SUM(Mdebit) as detsocial'))
            ->whereBetween('created_at', [$request->from_date, $request->to_date])
            ->where('compte', 'like', '43%')
            ->get();
        /*
        //depreciation des comptes sociaux
        $detsociald = DB::table('Journal')
            ->select(DB::raw('SUM(Mcredit) - SUM(Mdebit) as detsociald'))
            ->whereBetween('created_at', [$request->from_date, $request->to_date])
            ->where('compte', 'like', '493%')
            ->get();
        */
        //dettes fiscales
        $detfiscal = DB::table('Journal')
            ->select(DB::raw('SUM(Mcredit) - SUM(Mdebit) as detfiscal'))
            ->whereBetween('created_at', [$request->from_date, $request->to_date])
            ->where('compte', 'like', '44%')
            ->get();

        $Totcap = $crd[0]->crd+$resultat;
        $Totpascir = $cltacr[0]->cltacr+$fourn[0]->fourn+$detsocial[0]->detsocial+$detfiscal[0]->detfiscal;
        /*
        //depreciation des comptes fiscaux
        $detfiscald = DB::table('Journal')
            ->select(DB::raw('SUM(Mcredit) - SUM(Mdebit) as detfiscald'))
            ->whereBetween('created_at', [$request->from_date, $request->to_date])
            ->where('compte', 'like', '494%')
            ->get();

       
        $actif = $immo+$stock[0]->stock-$stockd[0]->stockd+$clt[0]->clt-$cltd[0]->cltd+$fournaav[0]->fournaav+$titrepla[0]->titrepla+$vencais[0]->vencais+$banq[0]->banq+$etfcier[0]->etfcier+$cais[0]->cais-$banqd[0]->banqd;
        
        $passif = $crd[0]->crd+$cltacr[0]->cltacr+$fourn[0]->fourn+$detsocial[0]->detsocial+$detfiscal[0]->detfiscal;
         */
        $actif = intval($immo)+intval($Tstock)+intval($Totactcir)+intval($TOTtresor);
        $passif = intval($Totcap)+intval($Totpascir);
        $bilan = intval($actif) - intval($passif);

        return view('bilan.index1', ['immo' => $immo, 'immo21' => $immo21, 'immo22' => $immo22, 'immo23' => $immo23, 'immo24' => $immo24, 'immo25' => $immo25, 'immo26' => $immo26, 'immo27' => $immo27, 'immo28' => $immo28, 'immo29' => $immo29, 'stock' => $stock, 'stockd' => $stockd, 'Tstock' => $Tstock, 'clt' => $clt, 'cltd' => $cltd, 'fournaav' => $fournaav, 'titrepla' => $titrepla, 'vencais' => $vencais, 'banq' => $banq, 'banqd' => $banqd, 'etfcier' => $etfcier, 'cais' => $cais, 'crd' => $crd, 'cap' => $cap, 'resv' => $resv,  'repn' => $repn, 'resultat' => $resultat, 'subinv' => $subinv, 'provreg' => $provreg, 'empdet' => $empdet, 'detloc' => $detloc, 'detparclesp' => $detparclesp, 'provrc' => $provrc, 'cltacr' => $cltacr, 'fourn' => $fourn, 'detsocial' => $detsocial, 'detfiscal' => $detfiscal, 'actif' => $actif, 'passif' => $passif, 'bilan' => $bilan, 'exec' => $exec, 'exec0' => $exec0, 'exec1' => $exec1, 'exec2' => $exec2, 'Totactcir' => $Totactcir, 'Totpascir' => $Totpascir, 'TOTtresor' => $TOTtresor, 'Totcap' => $Totcap]);
    } 
    }

    public function downloadPDFbilan(Request $request)
    {
        
    
     //Compte de resultat***********************************************************************
     //*************************************************************************************** */
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
    $resultat = $resultavpre-$partitravr[0]->partitravr-$imporesult[0]->imporesult;
        
    //BILAN********************************************************************
    //*********************************************************************** */

        $exec0 = " DU " . $request->from_date . " AU " . $request->to_date;
        $exec = "EXERCICE AU " . $request->to_date;
        $exec1 = $request->from_date;
        $exec2 = $request->to_date;
        //dd($exec);

        //actif
        // immobilisations
        /*
        $immo = DB::table('Journal')
            ->select(DB::raw('SUM(Mdebit) - SUM(Mcredit) as immo'))
            ->whereBetween('created_at', [$request->from_date, $request->to_date])
            ->where('compte', 'like', '2%')
            ->get();
        */
        // immo incorporelles
        $immo21 = DB::table('Journal')
            ->select(DB::raw('SUM(Mdebit) - SUM(Mcredit) as immo21'))
            ->whereBetween('created_at', [$request->from_date, $request->to_date])
            ->where('compte', 'like', '21%')
            ->get();

        // immo terrains
        $immo22 = DB::table('Journal')
            ->select(DB::raw('SUM(Mdebit) - SUM(Mcredit) as immo22'))
            ->whereBetween('created_at', [$request->from_date, $request->to_date])
            ->where('compte', 'like', '22%')
            ->get();

        // immo batiments, installations techniques et agencement

        $immo23 = DB::table('Journal')
            ->select(DB::raw('SUM(Mdebit) - SUM(Mcredit) as immo23'))
            ->whereBetween('created_at', [$request->from_date, $request->to_date])
            ->where('compte', 'like', '23%')
            ->get();

        // immo materiels, mobiliers et actifs biologiques
        $immo24 = DB::table('Journal')
            ->select(DB::raw('SUM(Mdebit) - SUM(Mcredit) as immo24'))
            ->whereBetween('created_at', [$request->from_date, $request->to_date])
            ->where('compte', 'like', '24%')
            ->get();

        // immo avances et accomptes versées sur immobilisation
        $immo25 = DB::table('Journal')
            ->select(DB::raw('SUM(Mdebit) - SUM(Mcredit) as immo25'))
            ->whereBetween('created_at', [$request->from_date, $request->to_date])
            ->where('compte', 'like', '25%')
            ->get();
        // immo titres de participation
        $immo26 = DB::table('Journal')
            ->select(DB::raw('SUM(Mdebit) - SUM(Mcredit) as immo26'))
            ->whereBetween('created_at', [$request->from_date, $request->to_date])
            ->where('compte', 'like', '26%')
            ->get();
        // immo autres immo financières
        $immo27 = DB::table('Journal')
            ->select(DB::raw('SUM(Mdebit) - SUM(Mcredit) as immo27'))
            ->whereBetween('created_at', [$request->from_date, $request->to_date])
            ->where('compte', 'like', '27%')
            ->get();
        // immo amortissements
        $immo28 = DB::table('Journal')
            ->select(DB::raw('SUM(Mdebit) - SUM(Mcredit) as immo28'))
            ->whereBetween('created_at', [$request->from_date, $request->to_date])
            ->where('compte', 'like', '28%')
            ->get();

        // immo depreciation des immo
        $immo29 = DB::table('Journal')
            ->select(DB::raw('SUM(Mdebit) - SUM(Mcredit) as immo29'))
            ->whereBetween('created_at', [$request->from_date, $request->to_date])
            ->where('compte', 'like', '29%')
            ->get();
        //TOTAL IMMO.
        $immo = $immo21[0]->immo21+$immo22[0]->immo22+$immo23[0]->immo23+$immo24[0]->immo24+$immo25[0]->immo25+$immo26[0]->immo26+$immo27[0]->immo27-$immo28[0]->immo28-$immo29[0]->immo29;

        // stocks
        $stock = DB::table('Journal')
            ->select(DB::raw('SUM(Mdebit) - SUM(Mcredit) as stock'))
            ->whereBetween('created_at', [$request->from_date, $request->to_date])
            ->where('compte', 'like', '3%')
            ->get();
        //depreciation des stocks
        $stockd = DB::table('Journal')
            ->select(DB::raw('SUM(Mdebit) - SUM(Mcredit) as stockd'))
            ->whereBetween('created_at', [$request->from_date, $request->to_date])
            ->where('compte', 'like', '39%')
            ->get();
        //Total stocks
        $Tstock = $stock[0]->stock-$stockd[0]->stockd;
        
        // clients (creances)
        $clt = DB::table('Journal')
            ->select(DB::raw('SUM(Mdebit) - SUM(Mcredit) as clt'))
            ->whereBetween('created_at', [$request->from_date, $request->to_date])
            ->where('compte', 'like', '411%')
            ->get();
        //depreciation des comptes clients
         $cltd = DB::table('Journal')
            ->select(DB::raw('SUM(Mdebit) - SUM(Mcredit) as cltd'))
            ->whereBetween('created_at', [$request->from_date, $request->to_date])
            ->where('compte', 'like', '491%')
            ->get();
        // founisseurs avances et accomptes versées
        $fournaav = DB::table('Journal')
            ->select(DB::raw('SUM(Mdebit) - SUM(Mcredit) as fournaav'))
            ->whereBetween('created_at', [$request->from_date, $request->to_date])
            ->where('compte', 'like', '4091%')
            ->get();

        $Totactcir = $stock[0]->stock-$stockd[0]->stockd+$clt[0]->clt-$cltd[0]->cltd+$fournaav[0]->fournaav;
        
        //titre de placement
        $titrepla = DB::table('Journal')
            ->select(DB::raw('SUM(Mdebit) - SUM(Mcredit) as titrepla'))
            ->whereBetween('created_at', [$request->from_date, $request->to_date])
            ->where('compte', 'like', '50%')
            ->get();

        //Valeurs à encaisser (effets de cce et autres)
        $vencais = DB::table('Journal')
            ->select(DB::raw('SUM(Mdebit) - SUM(Mcredit) as vencais'))
            ->whereBetween('created_at', [$request->from_date, $request->to_date])
            ->where('compte', 'like', '51%')
            ->get();
        //Banques
        $banq = DB::table('Journal')
            ->select(DB::raw('SUM(Mdebit) - SUM(Mcredit) as banq'))
            ->whereBetween('created_at', [$request->from_date, $request->to_date])
            ->where('compte', 'like', '52%')
            ->get();
        //etablissements fciers et assimilés
        
        $etfcier = DB::table('Journal')
            ->select(DB::raw('SUM(Mdebit) - SUM(Mcredit) as etfcier'))
            ->whereBetween('created_at', [$request->from_date, $request->to_date])
            ->where('compte', 'like', '53%')
            ->get();
        //caisse
        $cais = DB::table('Journal')
            ->select(DB::raw('SUM(Mdebit) - SUM(Mcredit) as cais'))
            ->whereBetween('created_at', [$request->from_date, $request->to_date])
            ->where('compte', 'like', '57%')
            ->get();
        //depreciation banque
        $banqd = DB::table('Journal')
            ->select(DB::raw('SUM(Mdebit) - SUM(Mcredit) as banqd'))
            ->whereBetween('created_at', [$request->from_date, $request->to_date])
            ->where('compte', 'like', '59%')
            ->get();

        $TOTtresor = $titrepla[0]->titrepla+$vencais[0]->vencais+$banq[0]->banq+$etfcier[0]->etfcier+$cais[0]->cais-$banqd[0]->banqd;
        //passif
        
        //TOTAL COMPTES DES RESSOURCES DURABLES
        $crd = DB::table('Journal')
            ->select(DB::raw('SUM(Mcredit) - SUM(Mdebit) as crd'))
            ->whereBetween('created_at', [$request->from_date, $request->to_date])
            ->where('compte', 'like', '1%')
            ->get();
        
        //capital
        $cap = DB::table('Journal')
            ->select(DB::raw('SUM(Mcredit) - SUM(Mdebit) as cap'))
            ->whereBetween('created_at', [$request->from_date, $request->to_date])
            ->where('compte', 'like', '10%')
            ->get();
        //reserves
        $resv = DB::table('Journal')
            ->select(DB::raw('SUM(Mcredit) - SUM(Mdebit) as resv'))
            ->whereBetween('created_at', [$request->from_date, $request->to_date])
            ->where('compte', 'like', '11%')
            ->get();
        //report a nouveau
        $repn = DB::table('Journal')
            ->select(DB::raw('SUM(Mcredit) - SUM(Mdebit) as repn'))
            ->whereBetween('created_at', [$request->from_date, $request->to_date])
            ->where('compte', 'like', '12%')
            ->get();
        /*
        //resultat net
        $resnet = DB::table('Journal')
            ->select(DB::raw('SUM(Mcredit) - SUM(Mdebit) as resnet'))
            ->whereBetween('created_at', [$request->from_date, $request->to_date])
            ->where('compte', 'like', '13%')
            ->get();
        */
        //subventions d'investissement
        $subinv = DB::table('Journal')
            ->select(DB::raw('SUM(Mcredit) - SUM(Mdebit) as subinv'))
            ->whereBetween('created_at', [$request->from_date, $request->to_date])
            ->where('compte', 'like', '14%')
            ->get();
        //provisions reglementées
        $provreg = DB::table('Journal')
            ->select(DB::raw('SUM(Mcredit) - SUM(Mdebit) as provreg'))
            ->whereBetween('created_at', [$request->from_date, $request->to_date])
            ->where('compte', 'like', '15%')
            ->get();
        //dd($provreg);
        //emprunts et dettes 
        $empdet = DB::table('Journal')
            ->select(DB::raw('SUM(Mdebit) - SUM(Mcredit) as empdet'))
            ->whereYear('created_at', (date("Y", time()) - 1))
            ->where('compte', 'like', '16%')
            ->get();

        //dettes de location
        $detloc = DB::table('Journal')
            ->select(DB::raw('SUM(Mdebit) - SUM(Mcredit) as detloc'))
            ->whereYear('created_at', (date("Y", time()) - 1))
            ->where('compte', 'like', '17%')
            ->get();
        //dettes liés à des participations et comptes de liaison des etabliss. et société en participation
        
        $detparclesp = DB::table('Journal')
            ->select(DB::raw('SUM(Mcredit) - SUM(Mdebit) as detparclesp'))
            ->whereBetween('created_at', [$request->from_date, $request->to_date])
            ->where('compte', 'like', '18%')
            ->get();
        //provision pour risques et charges
        $provrc = DB::table('Journal')
            ->select(DB::raw('SUM(Mcredit) - SUM(Mdebit) as provrc'))
            ->whereBetween('created_at', [$request->from_date, $request->to_date])
            ->where('compte', 'like', '19%')
            ->get();
                
        //clt avances et accomptes recues
        $cltacr = DB::table('Journal')
            ->select(DB::raw('SUM(Mcredit) - SUM(Mdebit) as cltacr'))
            ->whereBetween('created_at', [$request->from_date, $request->to_date])
            ->where('compte', 'like', '4191%')
            ->get();
        //dettes fournisseurs
        $fourn = DB::table('Journal')
            ->select(DB::raw('SUM(Mcredit) - SUM(Mdebit) as fourn'))
            ->whereBetween('created_at', [$request->from_date, $request->to_date])
            ->where('compte', 'like', '401%')
            ->get();
        /*
        //depreciation des comptes fournisseurs
        $fournd = DB::table('Journal')
            ->select(DB::raw('SUM(Mcredit) - SUM(Mdebit) as fournd'))
            ->whereBetween('created_at', [$request->from_date, $request->to_date])
            ->where('compte', 'like', '490%')
            ->get();
        */
        //dettes sociales
        $detsocial = DB::table('Journal')
            ->select(DB::raw('SUM(Mcredit) - SUM(Mdebit) as detsocial'))
            ->whereBetween('created_at', [$request->from_date, $request->to_date])
            ->where('compte', 'like', '43%')
            ->get();
        /*
        //depreciation des comptes sociaux
        $detsociald = DB::table('Journal')
            ->select(DB::raw('SUM(Mcredit) - SUM(Mdebit) as detsociald'))
            ->whereBetween('created_at', [$request->from_date, $request->to_date])
            ->where('compte', 'like', '493%')
            ->get();
        */
        //dettes fiscales
        $detfiscal = DB::table('Journal')
            ->select(DB::raw('SUM(Mcredit) - SUM(Mdebit) as detfiscal'))
            ->whereBetween('created_at', [$request->from_date, $request->to_date])
            ->where('compte', 'like', '44%')
            ->get();

        $Totcap = $crd[0]->crd+$resultat;
        $Totpascir = $cltacr[0]->cltacr+$fourn[0]->fourn+$detsocial[0]->detsocial+$detfiscal[0]->detfiscal;
        /*
        //depreciation des comptes fiscaux
        $detfiscald = DB::table('Journal')
            ->select(DB::raw('SUM(Mcredit) - SUM(Mdebit) as detfiscald'))
            ->whereBetween('created_at', [$request->from_date, $request->to_date])
            ->where('compte', 'like', '494%')
            ->get();

       
        $actif = $immo+$stock[0]->stock-$stockd[0]->stockd+$clt[0]->clt-$cltd[0]->cltd+$fournaav[0]->fournaav+$titrepla[0]->titrepla+$vencais[0]->vencais+$banq[0]->banq+$etfcier[0]->etfcier+$cais[0]->cais-$banqd[0]->banqd;
        
        $passif = $crd[0]->crd+$cltacr[0]->cltacr+$fourn[0]->fourn+$detsocial[0]->detsocial+$detfiscal[0]->detfiscal;
         */
        $actif = intval($immo)+intval($Tstock)+intval($Totactcir)+intval($TOTtresor);
        $passif = intval($Totcap)+intval($Totpascir);
        $bilan = intval($actif) - intval($passif);
        
        $pdf = PDF::loadView('bilan.pdfbilan', ['immo' => $immo, 'immo21' => $immo21, 'immo22' => $immo22, 'immo23' => $immo23, 'immo24' => $immo24, 'immo25' => $immo25, 'immo26' => $immo26, 'immo27' => $immo27, 'immo28' => $immo28, 'immo29' => $immo29, 'stock' => $stock, 'stockd' => $stockd, 'Tstock' => $Tstock, 'clt' => $clt, 'cltd' => $cltd, 'fournaav' => $fournaav, 'titrepla' => $titrepla, 'vencais' => $vencais, 'banq' => $banq, 'banqd' => $banqd, 'etfcier' => $etfcier, 'cais' => $cais, 'crd' => $crd, 'cap' => $cap, 'resv' => $resv,  'repn' => $repn, 'resultat' => $resultat, 'subinv' => $subinv, 'provreg' => $provreg, 'empdet' => $empdet, 'detloc' => $detloc, 'detparclesp' => $detparclesp, 'provrc' => $provrc, 'cltacr' => $cltacr, 'fourn' => $fourn, 'detsocial' => $detsocial, 'detfiscal' => $detfiscal, 'actif' => $actif, 'passif' => $passif, 'bilan' => $bilan, 'exec' => $exec, 'exec0' => $exec0, 'exec1' => $exec1, 'exec2' => $exec2, 'Totactcir' => $Totactcir, 'Totpascir' => $Totpascir, 'TOTtresor' => $TOTtresor, 'Totcap' => $Totcap]);

    return $pdf->download('bilan.pdf');
    }
}
