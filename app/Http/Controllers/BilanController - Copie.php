<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\Journal;

use Illuminate\Http\Request;

class BilanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        //compte de resultat

        $charges = DB::table('Journal')
            ->select(DB::raw('SUM(Mdebit) - SUM(Mcredit) as charge'))
            ->whereYear('created_at', date("Y", time()))
            ->where('compte', 'like', '6%')
            ->get();

        $charges81 = DB::table('Journal')
            ->select(DB::raw('SUM(Mdebit) - SUM(Mcredit) as charge'))
            ->whereYear('created_at', date("Y", time()))
            ->where('compte', 'like', '81%')
            ->get();

        $charges83 = DB::table('Journal')
            ->select(DB::raw('SUM(Mdebit) - SUM(Mcredit) as charge'))
            ->whereYear('created_at', date("Y", time()))
            ->where('compte', 'like', '83%')
            ->get();

        $charges85 = DB::table('Journal')
            ->select(DB::raw('SUM(Mdebit) - SUM(Mcredit) as charge'))
            ->whereYear('created_at', date("Y", time()))
            ->where('compte', 'like', '85%')
            ->get();

        $charges87 = DB::table('Journal')
            ->select(DB::raw('SUM(Mdebit) - SUM(Mcredit) as charge'))
            ->whereYear('created_at', date("Y", time()))
            ->where('compte', 'like', '87%')
            ->get();

        $charges89 = DB::table('Journal')
            ->select(DB::raw('SUM(Mdebit) - SUM(Mcredit) as charge'))
            ->whereYear('created_at', date("Y", time()))
            ->where('compte', 'like', '89%')
            ->get();
        

        $produits = DB::table('Journal')
            ->select(DB::raw('SUM(Mcredit) - SUM(Mdebit) as produit'))
            ->whereYear('created_at', date("Y", time()))
            ->where('compte', 'like', '7%')
            ->get();

        $produits80 = DB::table('Journal')
            ->select(DB::raw('SUM(Mdebit) - SUM(Mcredit) as produit'))
            ->whereYear('created_at', date("Y", time()))
            ->where('compte', 'like', '80%')
            ->get();

        $produits82 = DB::table('Journal')
            ->select(DB::raw('SUM(Mdebit) - SUM(Mcredit) as produit'))
            ->whereYear('created_at', date("Y", time()))
            ->where('compte', 'like', '82%')
            ->get();

        $produits84 = DB::table('Journal')
            ->select(DB::raw('SUM(Mdebit) - SUM(Mcredit) as produit'))
            ->whereYear('created_at', date("Y", time()))
            ->where('compte', 'like', '84%')
            ->get();

        $produits86 = DB::table('Journal')
            ->select(DB::raw('SUM(Mdebit) - SUM(Mcredit) as produit'))
            ->whereYear('created_at', date("Y", time()))
            ->where('compte', 'like', '86%')
            ->get();

        $produits88 = DB::table('Journal')
            ->select(DB::raw('SUM(Mdebit) - SUM(Mcredit) as produit'))
            ->whereYear('created_at', date("Y", time()))
            ->where('compte', 'like', '88%')
            ->get();

        $resultat1 =($charges[0]->charge+$charges81[0]->charge+$charges83[0]->charge+$charges85[0]->charge+$charges87[0]->charge+$charges89[0]->charge);

        $resultat2 = ($produits[0]->produit+$produits80[0]->produit+$produits82[0]->produit+$produits84[0]->produit+$produits86[0]->produit+$produits88[0]->produit);
        $resultat = $resultat2 - $resultat1;
        //Bilan
        $immo = DB::table('Journal')
            ->select(DB::raw('SUM(Mdebit) - SUM(Mcredit) as immo'))
            ->whereYear('created_at', date("Y", time()))
            ->where('compte', 'like', '2%')
            ->get();
        $stock = DB::table('Journal')
            ->select(DB::raw('SUM(Mdebit) - SUM(Mcredit) as stock'))
            ->whereYear('created_at', date("Y", time()))
            ->where('compte', 'like', '3%')
            ->get();
        $clt = DB::table('Journal')
            ->select(DB::raw('SUM(Mdebit) - SUM(Mcredit) as clt'))
            ->whereYear('created_at', date("Y", time()))
            ->where('compte', 'like', '411%')
            ->get();
        $tresor = DB::table('Journal')
            ->select(DB::raw('SUM(Mdebit) - SUM(Mcredit) as tresor'))
            ->whereYear('created_at', date("Y", time()))
            ->where('compte', 'like', '5%')
            ->get();


        $cap = DB::table('Journal')
            ->select(DB::raw('SUM(Mcredit) - SUM(Mdebit) as cap'))
            ->whereYear('created_at', date("Y", time()))
            ->where('compte', 'like', '1%')
            ->get();
        $fourn = DB::table('Journal')
            ->select(DB::raw('SUM(Mcredit) - SUM(Mdebit) as fourn'))
            ->whereYear('created_at', date("Y", time()))
            ->where('compte', 'like', '401%')
            ->get();

        $actif = $immo[0]->immo+$stock[0]->stock+$clt[0]->clt+$tresor[0]->tresor;
        $passif = $cap[0]->cap+$fourn[0]->fourn+$resultat;
        $bilan = $actif - $passif;

        return view('bilan.index', ['immo' => $immo, 'stock' => $stock, 'clt' => $clt, 'tresor' => $tresor, 'cap' => $cap, 'fourn' => $fourn, 'resultat' => $resultat, 'actif' => $actif, 'passif' => $passif, 'bilan' => $bilan]);
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
        //Compte de resultat
       $charges = DB::table('Journal')
            ->select(DB::raw('SUM(Mdebit) - SUM(Mcredit) as charge'))
            ->whereBetween('created_at', [$request->from_date, $request->to_date])
            ->where('compte', 'like', '6%')
            ->get();

        $charges81 = DB::table('Journal')
            ->select(DB::raw('SUM(Mdebit) - SUM(Mcredit) as charge'))
            ->whereBetween('created_at', [$request->from_date, $request->to_date])
            ->where('compte', 'like', '81%')
            ->get();

        $charges83 = DB::table('Journal')
            ->select(DB::raw('SUM(Mdebit) - SUM(Mcredit) as charge'))
            ->whereBetween('created_at', [$request->from_date, $request->to_date])
            ->where('compte', 'like', '83%')
            ->get();

        $charges85 = DB::table('Journal')
            ->select(DB::raw('SUM(Mdebit) - SUM(Mcredit) as charge'))
            ->whereBetween('created_at', [$request->from_date, $request->to_date])
            ->where('compte', 'like', '85%')
            ->get();

        $charges87 = DB::table('Journal')
            ->select(DB::raw('SUM(Mdebit) - SUM(Mcredit) as charge'))
            ->whereBetween('created_at', [$request->from_date, $request->to_date])
            ->where('compte', 'like', '87%')
            ->get();

        $charges89 = DB::table('Journal')
            ->select(DB::raw('SUM(Mdebit) - SUM(Mcredit) as charge'))
            ->whereBetween('created_at', [$request->from_date, $request->to_date])
            ->where('compte', 'like', '89%')
            ->get();
        

        $produits = DB::table('Journal')
            ->select(DB::raw('SUM(Mcredit) - SUM(Mdebit) as produit'))
            ->whereBetween('created_at', [$request->from_date, $request->to_date])
            ->where('compte', 'like', '7%')
            ->get();

        $produits80 = DB::table('Journal')
            ->select(DB::raw('SUM(Mdebit) - SUM(Mcredit) as produit'))
            ->whereBetween('created_at', [$request->from_date, $request->to_date])
            ->where('compte', 'like', '80%')
            ->get();

        $produits82 = DB::table('Journal')
            ->select(DB::raw('SUM(Mdebit) - SUM(Mcredit) as produit'))
            ->whereBetween('created_at', [$request->from_date, $request->to_date])
            ->where('compte', 'like', '82%')
            ->get();

        $produits84 = DB::table('Journal')
            ->select(DB::raw('SUM(Mdebit) - SUM(Mcredit) as produit'))
            ->whereBetween('created_at', [$request->from_date, $request->to_date])
            ->where('compte', 'like', '84%')
            ->get();

        $produits86 = DB::table('Journal')
            ->select(DB::raw('SUM(Mdebit) - SUM(Mcredit) as produit'))
            ->whereBetween('created_at', [$request->from_date, $request->to_date])
            ->where('compte', 'like', '86%')
            ->get();

        $produits88 = DB::table('Journal')
            ->select(DB::raw('SUM(Mdebit) - SUM(Mcredit) as produit'))
            ->whereBetween('created_at', [$request->from_date, $request->to_date])
            ->where('compte', 'like', '88%')
            ->get();

        $resultat1 =($charges[0]->charge+$charges81[0]->charge+$charges83[0]->charge+$charges85[0]->charge+$charges87[0]->charge+$charges89[0]->charge);

        $resultat2 = ($produits[0]->produit+$produits80[0]->produit+$produits82[0]->produit+$produits84[0]->produit+$produits86[0]->produit+$produits88[0]->produit);
        $resultat = $resultat2 - $resultat1;
        
        //Bilan

        $exec = "EXERCICE AU " . $request->to_date;
        dd($exec);

        //actif
        // immobilisations
        $immoa = DB::table('Journal')
            ->select(DB::raw('SUM(Mdebit) - SUM(Mcredit) as immoa'))
            ->whereYear('created_at', (date("Y", time()) - 1))
            ->where('compte', 'like', '2%')
            ->get();
        
        $immo = DB::table('Journal')
            ->select(DB::raw('SUM(Mdebit) - SUM(Mcredit) as immo'))
            ->whereBetween('created_at', [$request->from_date, $request->to_date])
            ->where('compte', 'like', '2%')
            ->get();
        // immo incorporelles

        $immo21a = DB::table('Journal')
            ->select(DB::raw('SUM(Mdebit) - SUM(Mcredit) as immo21a'))
            ->whereYear('created_at', (date("Y", time()) - 1))
            ->where('compte', 'like', '21%')
            ->get();
        
        $immo21 = DB::table('Journal')
            ->select(DB::raw('SUM(Mdebit) - SUM(Mcredit) as immo21'))
            ->whereBetween('created_at', [$request->from_date, $request->to_date])
            ->where('compte', 'like', '21%')
            ->get();

        // immo terrains

        $immo22a = DB::table('Journal')
            ->select(DB::raw('SUM(Mdebit) - SUM(Mcredit) as immo22a'))
            ->whereYear('created_at', (date("Y", time()) - 1))
            ->where('compte', 'like', '22%')
            ->get();
        
        $immo22 = DB::table('Journal')
            ->select(DB::raw('SUM(Mdebit) - SUM(Mcredit) as immo22'))
            ->whereBetween('created_at', [$request->from_date, $request->to_date])
            ->where('compte', 'like', '22%')
            ->get();

        // immo batiments, installations techniques et agencement

        $immo23a = DB::table('Journal')
            ->select(DB::raw('SUM(Mdebit) - SUM(Mcredit) as immo23a'))
            ->whereYear('created_at', (date("Y", time()) - 1))
            ->where('compte', 'like', '23%')
            ->get();
        
        $immo23 = DB::table('Journal')
            ->select(DB::raw('SUM(Mdebit) - SUM(Mcredit) as immo23'))
            ->whereBetween('created_at', [$request->from_date, $request->to_date])
            ->where('compte', 'like', '23%')
            ->get();

        // immo materiels, mobiliers et actifs biologiques
        $immo24a = DB::table('Journal')
            ->select(DB::raw('SUM(Mdebit) - SUM(Mcredit) as immo24a'))
            ->whereYear('created_at', (date("Y", time()) - 1))
            ->where('compte', 'like', '24%')
            ->get();
        
        $immo24 = DB::table('Journal')
            ->select(DB::raw('SUM(Mdebit) - SUM(Mcredit) as immo24'))
            ->whereBetween('created_at', [$request->from_date, $request->to_date])
            ->where('compte', 'like', '24%')
            ->get();

        // immo avances et accomptes versées sur immobilisation
        $immo25a = DB::table('Journal')
            ->select(DB::raw('SUM(Mdebit) - SUM(Mcredit) as immo25a'))
            ->whereYear('created_at', (date("Y", time()) - 1))
            ->where('compte', 'like', '25%')
            ->get();
        
        $immo25 = DB::table('Journal')
            ->select(DB::raw('SUM(Mdebit) - SUM(Mcredit) as immo25'))
            ->whereBetween('created_at', [$request->from_date, $request->to_date])
            ->where('compte', 'like', '25%')
            ->get();
        // immo titres de participation
        $immo26a = DB::table('Journal')
            ->select(DB::raw('SUM(Mdebit) - SUM(Mcredit) as immo26a'))
            ->whereYear('created_at', (date("Y", time()) - 1))
            ->where('compte', 'like', '26%')
            ->get();
        
        $immo26 = DB::table('Journal')
            ->select(DB::raw('SUM(Mdebit) - SUM(Mcredit) as immo26'))
            ->whereBetween('created_at', [$request->from_date, $request->to_date])
            ->where('compte', 'like', '26%')
            ->get();
        // immo autres immo financières
        $immo27a = DB::table('Journal')
            ->select(DB::raw('SUM(Mdebit) - SUM(Mcredit) as immo27a'))
            ->whereYear('created_at', (date("Y", time()) - 1))
            ->where('compte', 'like', '27%')
            ->get();
        
        $immo27 = DB::table('Journal')
            ->select(DB::raw('SUM(Mdebit) - SUM(Mcredit) as immo27'))
            ->whereBetween('created_at', [$request->from_date, $request->to_date])
            ->where('compte', 'like', '27%')
            ->get();
        // immo amortissements
        $immo28a = DB::table('Journal')
            ->select(DB::raw('SUM(Mdebit) - SUM(Mcredit) as immo28a'))
            ->whereYear('created_at', (date("Y", time()) - 1))
            ->where('compte', 'like', '28%')
            ->get();
        
        $immo28 = DB::table('Journal')
            ->select(DB::raw('SUM(Mdebit) - SUM(Mcredit) as immo28'))
            ->whereBetween('created_at', [$request->from_date, $request->to_date])
            ->where('compte', 'like', '28%')
            ->get();

        // immo depreciation des immo
        $immo29a = DB::table('Journal')
            ->select(DB::raw('SUM(Mdebit) - SUM(Mcredit) as immo29a'))
            ->whereYear('created_at', (date("Y", time()) - 1))
            ->where('compte', 'like', '29%')
            ->get();
        
        $immo29 = DB::table('Journal')
            ->select(DB::raw('SUM(Mdebit) - SUM(Mcredit) as immo29'))
            ->whereBetween('created_at', [$request->from_date, $request->to_date])
            ->where('compte', 'like', '29%')
            ->get();

        // stocks
        $stocka = DB::table('Journal')
            ->select(DB::raw('SUM(Mdebit) - SUM(Mcredit) as stocka'))
            ->whereYear('created_at', (date("Y", time()) - 1))
            ->where('compte', 'like', '3%')
            ->get();
        $stock = DB::table('Journal')
            ->select(DB::raw('SUM(Mdebit) - SUM(Mcredit) as stock'))
            ->whereBetween('created_at', [$request->from_date, $request->to_date])
            ->where('compte', 'like', '3%')
            ->get();
        
        // clients (creances)
        $clta = DB::table('Journal')
            ->select(DB::raw('SUM(Mdebit) - SUM(Mcredit) as clta'))
            ->whereYear('created_at', (date("Y", time()) - 1))
            ->where('compte', 'like', '411%')
            ->get();
        $clt = DB::table('Journal')
            ->select(DB::raw('SUM(Mdebit) - SUM(Mcredit) as clt'))
            ->whereBetween('created_at', [$request->from_date, $request->to_date])
            ->where('compte', 'like', '411%')
            ->get();
        // founisseurs avances et accomptes versées
        $fournaava = DB::table('Journal')
            ->select(DB::raw('SUM(Mdebit) - SUM(Mcredit) as fournaava'))
            ->whereYear('created_at', (date("Y", time()) - 1))
            ->where('compte', 'like', '4091%')
            ->get();
        $fournaav = DB::table('Journal')
            ->select(DB::raw('SUM(Mdebit) - SUM(Mcredit) as fournaav'))
            ->whereBetween('created_at', [$request->from_date, $request->to_date])
            ->where('compte', 'like', '4091%')
            ->get();
        
        //titre de placement
        $titrepla_a = DB::table('Journal')
            ->select(DB::raw('SUM(Mdebit) - SUM(Mcredit) as titrepla_a'))
            ->whereYear('created_at', (date("Y", time()) - 1))
            ->where('compte', 'like', '50%')
            ->get();
        $titrepla = DB::table('Journal')
            ->select(DB::raw('SUM(Mdebit) - SUM(Mcredit) as titrepla'))
            ->whereBetween('created_at', [$request->from_date, $request->to_date])
            ->where('compte', 'like', '50%')
            ->get();

        //Valeurs à encaisser (effets de cce et autres)
        $vencaisa = DB::table('Journal')
            ->select(DB::raw('SUM(Mdebit) - SUM(Mcredit) as vencaisa'))
            ->whereYear('created_at', (date("Y", time()) - 1))
            ->where('compte', 'like', '51%')
            ->get();
        $vencais = DB::table('Journal')
            ->select(DB::raw('SUM(Mdebit) - SUM(Mcredit) as vencais'))
            ->whereBetween('created_at', [$request->from_date, $request->to_date])
            ->where('compte', 'like', '51%')
            ->get();
        //Banques
        $banqa = DB::table('Journal')
            ->select(DB::raw('SUM(Mdebit) - SUM(Mcredit) as banqa'))
            ->whereYear('created_at', (date("Y", time()) - 1))
            ->where('compte', 'like', '52%')
            ->get();
        $banq = DB::table('Journal')
            ->select(DB::raw('SUM(Mdebit) - SUM(Mcredit) as banq'))
            ->whereBetween('created_at', [$request->from_date, $request->to_date])
            ->where('compte', 'like', '52%')
            ->get();
        //etablissements fciers et assimilés
        $etfciera = DB::table('Journal')
            ->select(DB::raw('SUM(Mdebit) - SUM(Mcredit) as etfciera'))
            ->whereYear('created_at', (date("Y", time()) - 1))
            ->where('compte', 'like', '53%')
            ->get();
        $etfcier = DB::table('Journal')
            ->select(DB::raw('SUM(Mdebit) - SUM(Mcredit) as etfcier'))
            ->whereBetween('created_at', [$request->from_date, $request->to_date])
            ->where('compte', 'like', '53%')
            ->get();
        //caisse
        $caisa = DB::table('Journal')
            ->select(DB::raw('SUM(Mdebit) - SUM(Mcredit) as caisa'))
            ->whereYear('created_at', (date("Y", time()) - 1))
            ->where('compte', 'like', '57%')
            ->get();
        $cais = DB::table('Journal')
            ->select(DB::raw('SUM(Mdebit) - SUM(Mcredit) as cais'))
            ->whereBetween('created_at', [$request->from_date, $request->to_date])
            ->where('compte', 'like', '57%')
            ->get();


        //passif
        //compte des ressources durables
        $crda = DB::table('Journal')
            ->select(DB::raw('SUM(Mdebit) - SUM(Mcredit) as crda'))
            ->whereYear('created_at', (date("Y", time()) - 1))
            ->where('compte', 'like', '1%')
            ->get();
        $crd = DB::table('Journal')
            ->select(DB::raw('SUM(Mcredit) - SUM(Mdebit) as crd'))
            ->whereBetween('created_at', [$request->from_date, $request->to_date])
            ->where('compte', 'like', '1%')
            ->get();
        //capital
        $capa = DB::table('Journal')
            ->select(DB::raw('SUM(Mdebit) - SUM(Mcredit) as capa'))
            ->whereYear('created_at', (date("Y", time()) - 1))
            ->where('compte', 'like', '10%')
            ->get();
        $cap = DB::table('Journal')
            ->select(DB::raw('SUM(Mcredit) - SUM(Mdebit) as cap'))
            ->whereBetween('created_at', [$request->from_date, $request->to_date])
            ->where('compte', 'like', '10%')
            ->get();
        //reserves
        $resva = DB::table('Journal')
            ->select(DB::raw('SUM(Mdebit) - SUM(Mcredit) as resva'))
            ->whereYear('created_at', (date("Y", time()) - 1))
            ->where('compte', 'like', '11%')
            ->get();
        $resv = DB::table('Journal')
            ->select(DB::raw('SUM(Mcredit) - SUM(Mdebit) as resv'))
            ->whereBetween('created_at', [$request->from_date, $request->to_date])
            ->where('compte', 'like', '11%')
            ->get();
        //report a nouveau
        $repna = DB::table('Journal')
            ->select(DB::raw('SUM(Mdebit) - SUM(Mcredit) as repna'))
            ->whereYear('created_at', (date("Y", time()) - 1))
            ->where('compte', 'like', '12%')
            ->get();
        $repn = DB::table('Journal')
            ->select(DB::raw('SUM(Mcredit) - SUM(Mdebit) as repn'))
            ->whereBetween('created_at', [$request->from_date, $request->to_date])
            ->where('compte', 'like', '12%')
            ->get();
        //resultat net
        $resneta = DB::table('Journal')
            ->select(DB::raw('SUM(Mdebit) - SUM(Mcredit) as resneta'))
            ->whereYear('created_at', (date("Y", time()) - 1))
            ->where('compte', 'like', '13%')
            ->get();
        $resnet = DB::table('Journal')
            ->select(DB::raw('SUM(Mcredit) - SUM(Mdebit) as resnet'))
            ->whereBetween('created_at', [$request->from_date, $request->to_date])
            ->where('compte', 'like', '13%')
            ->get();
        //subventions d'investissement
        $subinva = DB::table('Journal')
            ->select(DB::raw('SUM(Mdebit) - SUM(Mcredit) as subinva'))
            ->whereYear('created_at', (date("Y", time()) - 1))
            ->where('compte', 'like', '14%')
            ->get();
        $subinv = DB::table('Journal')
            ->select(DB::raw('SUM(Mcredit) - SUM(Mdebit) as subinv'))
            ->whereBetween('created_at', [$request->from_date, $request->to_date])
            ->where('compte', 'like', '14%')
            ->get();
        //provisions reglementées
        $provrega = DB::table('Journal')
            ->select(DB::raw('SUM(Mdebit) - SUM(Mcredit) as provrega'))
            ->whereYear('created_at', (date("Y", time()) - 1))
            ->where('compte', 'like', '15%')
            ->get();
        $provreg = DB::table('Journal')
            ->select(DB::raw('SUM(Mcredit) - SUM(Mdebit) as provreg'))
            ->whereBetween('created_at', [$request->from_date, $request->to_date])
            ->where('compte', 'like', '15%')
            ->get();
        //emprunts et dettes 
        $empdeta = DB::table('Journal')
            ->select(DB::raw('SUM(Mdebit) - SUM(Mcredit) as empdeta'))
            ->whereYear('created_at', (date("Y", time()) - 1))
            ->where('compte', 'like', '16%')
            ->get();
        $empdeta = DB::table('Journal')
            ->select(DB::raw('SUM(Mdebit) - SUM(Mcredit) as empdeta'))
            ->whereYear('created_at', (date("Y", time()) - 1))
            ->where('compte', 'like', '16%')
            ->get();
        //dettes de location
        $detloca = DB::table('Journal')
            ->select(DB::raw('SUM(Mdebit) - SUM(Mcredit) as detloca'))
            ->whereYear('created_at', (date("Y", time()) - 1))
            ->where('compte', 'like', '17%')
            ->get();
        $detloc = DB::table('Journal')
            ->select(DB::raw('SUM(Mdebit) - SUM(Mcredit) as detloc'))
            ->whereYear('created_at', (date("Y", time()) - 1))
            ->where('compte', 'like', '17%')
            ->get();
        //dettes liés à des participations et comptes de liaison des etabliss. et société en participation
        $detparclespa = DB::table('Journal')
            ->select(DB::raw('SUM(Mdebit) - SUM(Mcredit) as detparclespa'))
            ->whereYear('created_at', (date("Y", time()) - 1))
            ->where('compte', 'like', '18%')
            ->get();
        $detparclesp = DB::table('Journal')
            ->select(DB::raw('SUM(Mcredit) - SUM(Mdebit) as detparclesp'))
            ->whereBetween('created_at', [$request->from_date, $request->to_date])
            ->where('compte', 'like', '18%')
            ->get();
        //provision pour risques et charges
        $provrca = DB::table('Journal')
            ->select(DB::raw('SUM(Mdebit) - SUM(Mcredit) as provrca'))
            ->whereYear('created_at', (date("Y", time()) - 1))
            ->where('compte', 'like', '19%')
            ->get();
        $provrc = DB::table('Journal')
            ->select(DB::raw('SUM(Mcredit) - SUM(Mdebit) as provrc'))
            ->whereBetween('created_at', [$request->from_date, $request->to_date])
            ->where('compte', 'like', '19%')
            ->get();
        //clt avances et accomptes recues
        $cltacra = DB::table('Journal')
            ->select(DB::raw('SUM(Mdebit) - SUM(Mcredit) as cltacra'))
            ->whereYear('created_at', (date("Y", time()) - 1))
            ->where('compte', 'like', '4191%')
            ->get();
        $cltacr = DB::table('Journal')
            ->select(DB::raw('SUM(Mcredit) - SUM(Mdebit) as cltacr'))
            ->whereBetween('created_at', [$request->from_date, $request->to_date])
            ->where('compte', 'like', '4191%')
            ->get();
        //dettes fournisseurs
        $fourna = DB::table('Journal')
            ->select(DB::raw('SUM(Mdebit) - SUM(Mcredit) as fourna'))
            ->whereYear('created_at', (date("Y", time()) - 1))
            ->where('compte', 'like', '401%')
            ->get();
        $fourn = DB::table('Journal')
            ->select(DB::raw('SUM(Mcredit) - SUM(Mdebit) as fourn'))
            ->whereBetween('created_at', [$request->from_date, $request->to_date])
            ->where('compte', 'like', '401%')
            ->get();
        //dettes sociales
        $detsociala = DB::table('Journal')
            ->select(DB::raw('SUM(Mdebit) - SUM(Mcredit) as detsociala'))
            ->whereYear('created_at', (date("Y", time()) - 1))
            ->where('compte', 'like', '43%')
            ->get();
        $detsocial = DB::table('Journal')
            ->select(DB::raw('SUM(Mcredit) - SUM(Mdebit) as detsocial'))
            ->whereBetween('created_at', [$request->from_date, $request->to_date])
            ->where('compte', 'like', '43%')
            ->get();
        //dettes fiscales
        $detfiscala = DB::table('Journal')
            ->select(DB::raw('SUM(Mdebit) - SUM(Mcredit) as detfiscala'))
            ->whereYear('created_at', (date("Y", time()) - 1))
            ->where('compte', 'like', '44%')
            ->get();
        $detfiscal = DB::table('Journal')
            ->select(DB::raw('SUM(Mcredit) - SUM(Mdebit) as detfiscal'))
            ->whereBetween('created_at', [$request->from_date, $request->to_date])
            ->where('compte', 'like', '44%')
            ->get();


        $actifa = $immoa[0]->immoa+$stocka[0]->stocka+$clta[0]->clta+$fournaava[0]->fournaava+$titreplaa[0]->titreplaa+$vencaisa[0]->vencaisa+$banqa[0]->banqa+$etfciera[0]->etfciera+$caisa[0]->caisa;
        $actif = $immo[0]->immo+$stock[0]->stock+$clt[0]->clt+$fournaav[0]->fournaav+$titrepla[0]->titrepla+$vencais[0]->vencais+$banq[0]->banq+$etfcier[0]->etfcier+$cais[0]->cais;
        $passifa = $crda[0]->crda+$cltacra[0]->cltacra+$fourna[0]->fourna+$detsociala[0]->detsociala+$detfiscala[0]->detfiscala;
        $passif = $crd[0]->crd+$cltacr[0]->cltacr+$fourn[0]->fourn+$detsocial[0]->detsocial+$detfiscal[0]->detfiscal;
        $bilana = $actifa - $passifa;
        $bilan = $actif - $passif;

        return view('bilan.index', ['immoa' => $immoa, 'immo' => $immo, 'immoa21' => $immoa21, 'immo21' => $immo21, 'immoa22' => $immoa22, 'immo22' => $immo22, 'immoa23' => $immoa23, 'immo23' => $immo23, 'immoa24' => $immoa24, 'immo24' => $immo24, 'immoa25' => $immoa25, 'immo25' => $immo25, 'immoa26' => $immoa26, 'immo26' => $immo26, 'immoa27' => $immoa27, 'immo27' => $immo27, 'immoa28' => $immoa28, 'immo28' => $immo28, 'immoa29' => $immoa29, 'immo29' => $immo29, 
            'stocka' => $stocka, 'stock' => $stock, 'clta' => $clta, 'fournaava' => $fournaava, 'fournaav' => $fournaav, 'titrepla_a' => $titrepla_a, 'titrepla' => $titrepla, 'vencaisa' => $vencaisa, 'vencais' => $vencais,  'banqa' => $banqa, 'banq' => $banq, 'etfciera' => $etfciera, 'etfcier' => $etfcier, 
                'caisa' => $caisa, 'cais' => $cais, 'crda' => $crda, 'crd' => $crd, 'capa' => $capa, 'cap' => $cap, 'resva' => $resva, 'resv' => $resv,  'repna' => $repna, 'repn' => $repn, 'resneta' => $resneta, 'resnet' => $resnet, 'subinva' => $subinva, 'subinv' => $subinv, 'provrega' => $provrega, 'provreg' => $provreg,
                'empdeta' => $empdeta, 'empdet' => $empdet, 'detloca' => $detloca, 'detloc' => $detloc,  'detparclespa' => $detparclespa, 'detparclesp' => $detparclesp, 'provrca' => $provrca, 'provrc' => $provrc, 'cltacra' => $cltacra, 'cltacr' => $cltacr,
                'fourna' => $fourna, 'fourn' => $fourn, 'detsociala' => $detsociala, 'detsocial' => $detsocial,  'detfiscala' => $detfiscala, 'detfiscal' => $detfiscal, 'actif' => $actif, 'passif' => $passif, 'bilan' => $bilan, 'exec' => $exec]);

        
    }
}
