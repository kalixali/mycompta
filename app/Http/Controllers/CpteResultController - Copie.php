<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\Journal;

use Illuminate\Http\Request;

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
            ->whereYear('created_at',  )
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
        
        return view('cpteresultat.index', ['charges' => $charges, 'charges81' => $charges81, 'charges83' => $charges83, 'charges85' => $charges85, 'charges87' => $charges87, 'charges89' => $charges89, 'produits' => $produits, 'produits80' => $produits80, 'produits82' => $produits82, 'produits84' => $produits84, 'produits86' => $produits86, 'produits88' => $produits88, 'resultat' => $resultat]);
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
        
        return view('cpteresultat.index', ['charges' => $charges, 'charges81' => $charges81, 'charges83' => $charges83, 'charges85' => $charges85, 'charges87' => $charges87, 'charges89' => $charges89, 'produits' => $produits, 'produits80' => $produits80, 'produits82' => $produits82, 'produits84' => $produits84, 'produits86' => $produits86, 'produits88' => $produits88, 'resultat' => $resultat]);

        
    }
}
