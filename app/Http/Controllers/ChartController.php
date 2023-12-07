<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\achats;
use Illuminate\Support\Facades\DB;

class ChartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $ach1 = DB::table('achats')
            ->select(DB::raw('SUM(mttc) as Tachmttc') )
            ->whereYear('created_at', date("Y", time()))
            ->whereMonth ('created_at', 1)
            ->get();

        $ach2 = DB::table('achats')
            ->select(DB::raw('SUM(mttc) as Tachmttc') )
            ->whereYear('created_at', date("Y", time()))
            ->whereMonth ('created_at', 2)
            ->get();

        $ach3 = DB::table('achats')
            ->select(DB::raw('SUM(mttc) as Tachmttc') )
            ->whereYear('created_at', date("Y", time()))
            ->whereMonth ('created_at', 3)
            ->get();

        $ach4 = DB::table('achats')
            ->select(DB::raw('SUM(mttc) as Tachmttc') )
            ->whereYear('created_at', date("Y", time()))
            ->whereMonth ('created_at', 4)
            ->get();
        
        $ach5 = DB::table('achats')
            ->select(DB::raw('SUM(mttc) as Tachmttc') )
            ->whereYear('created_at', date("Y", time()))
            ->whereMonth ('created_at', 5)
            ->get();
        $ach6 = DB::table('achats')
            ->select(DB::raw('SUM(mttc) as Tachmttc') )
            ->whereYear('created_at', date("Y", time()))
            ->whereMonth ('created_at', 6)
            ->get();
        $ach7 = DB::table('achats')
            ->select(DB::raw('SUM(mttc) as Tachmttc') )
            ->whereYear('created_at', date("Y", time()))
            ->whereMonth ('created_at', 7)
            ->get();
        $ach8 = DB::table('achats')
            ->select(DB::raw('SUM(mttc) as Tachmttc') )
            ->whereYear('created_at', date("Y", time()))
            ->whereMonth ('created_at', 8)
            ->get();
        $ach9 = DB::table('achats')
            ->select(DB::raw('SUM(mttc) as Tachmttc') )
            ->whereYear('created_at', date("Y", time()))
            ->whereMonth ('created_at', 9)
            ->get();
        $ach10 = DB::table('achats')
            ->select(DB::raw('SUM(mttc) as Tachmttc') )
            ->whereYear('created_at', date("Y", time()))
            ->whereMonth ('created_at', 10)
            ->get();
        $ach11 = DB::table('achats')
            ->select(DB::raw('SUM(mttc) as Tachmttc') )
            ->whereYear('created_at', date("Y", time()))
            ->whereMonth ('created_at', 11)
            ->get();
        $ach12 = DB::table('achats')
            ->select(DB::raw('SUM(mttc) as Tachmttc') )
            ->whereYear('created_at', date("Y", time()))
            ->whereMonth ('created_at', 12)
            ->get();
        $ach = array(intval($ach1[0]->Tachmttc), intval($ach2[0]->Tachmttc), intval($ach3[0]->Tachmttc), intval($ach4[0]->Tachmttc), intval($ach5[0]->Tachmttc), intval($ach6[0]->Tachmttc), intval($ach7[0]->Tachmttc), intval($ach8[0]->Tachmttc), intval($ach9[0]->Tachmttc), intval($ach10[0]->Tachmttc), intval($ach11[0]->Tachmttc), intval($ach12[0]->Tachmttc));
        //dd($ach[3]);
        //print_r(json_encode($ach));
        return view('charts.index', ['ach' => $ach]);
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

    public function loadchart1()
    {
        //LES ACHATS
        $ach1 = DB::table('achats')
        ->select(DB::raw('SUM(mttc) as Tachmttc') )
        ->whereYear('created_at', date("Y", time()))
        ->whereMonth ('created_at', 1)
        ->get();

    $ach2 = DB::table('achats')
        ->select(DB::raw('SUM(mttc) as Tachmttc') )
        ->whereYear('created_at', date("Y", time()))
        ->whereMonth ('created_at', 2)
        ->get();

    $ach3 = DB::table('achats')
        ->select(DB::raw('SUM(mttc) as Tachmttc') )
        ->whereYear('created_at', date("Y", time()))
        ->whereMonth ('created_at', 3)
        ->get();

    $ach4 = DB::table('achats')
        ->select(DB::raw('SUM(mttc) as Tachmttc') )
        ->whereYear('created_at', date("Y", time()))
        ->whereMonth ('created_at', 4)
        ->get();
    
    $ach5 = DB::table('achats')
        ->select(DB::raw('SUM(mttc) as Tachmttc') )
        ->whereYear('created_at', date("Y", time()))
        ->whereMonth ('created_at', 5)
        ->get();
    $ach6 = DB::table('achats')
        ->select(DB::raw('SUM(mttc) as Tachmttc') )
        ->whereYear('created_at', date("Y", time()))
        ->whereMonth ('created_at', 6)
        ->get();
    $ach7 = DB::table('achats')
        ->select(DB::raw('SUM(mttc) as Tachmttc') )
        ->whereYear('created_at', date("Y", time()))
        ->whereMonth ('created_at', 7)
        ->get();
    $ach8 = DB::table('achats')
        ->select(DB::raw('SUM(mttc) as Tachmttc') )
        ->whereYear('created_at', date("Y", time()))
        ->whereMonth ('created_at', 8)
        ->get();
    $ach9 = DB::table('achats')
        ->select(DB::raw('SUM(mttc) as Tachmttc') )
        ->whereYear('created_at', date("Y", time()))
        ->whereMonth ('created_at', 9)
        ->get();
    $ach10 = DB::table('achats')
        ->select(DB::raw('SUM(mttc) as Tachmttc') )
        ->whereYear('created_at', date("Y", time()))
        ->whereMonth ('created_at', 10)
        ->get();
    $ach11 = DB::table('achats')
        ->select(DB::raw('SUM(mttc) as Tachmttc') )
        ->whereYear('created_at', date("Y", time()))
        ->whereMonth ('created_at', 11)
        ->get();
    $ach12 = DB::table('achats')
        ->select(DB::raw('SUM(mttc) as Tachmttc') )
        ->whereYear('created_at', date("Y", time()))
        ->whereMonth ('created_at', 12)
        ->get();
    $ach = array(intval($ach1[0]->Tachmttc), intval($ach2[0]->Tachmttc), intval($ach3[0]->Tachmttc), intval($ach4[0]->Tachmttc), intval($ach5[0]->Tachmttc), intval($ach6[0]->Tachmttc), intval($ach7[0]->Tachmttc), intval($ach8[0]->Tachmttc), intval($ach9[0]->Tachmttc), intval($ach10[0]->Tachmttc), intval($ach11[0]->Tachmttc), intval($ach12[0]->Tachmttc));
    //dd($ach);
    //print_r(json_encode($ach));
    // LES VENTES
    $vte1 = DB::table('ventes')
        ->select(DB::raw('SUM(mttc) as Tvtemttc') )
        ->whereYear('created_at', date("Y", time()))
        ->whereMonth ('created_at', 1)
        ->get();

    $vte2 = DB::table('ventes')
        ->select(DB::raw('SUM(mttc) as Tvtemttc') )
        ->whereYear('created_at', date("Y", time()))
        ->whereMonth ('created_at', 2)
        ->get();

    $vte3 = DB::table('ventes')
        ->select(DB::raw('SUM(mttc) as Tvtemttc') )
        ->whereYear('created_at', date("Y", time()))
        ->whereMonth ('created_at', 3)
        ->get();

    $vte4 = DB::table('ventes')
        ->select(DB::raw('SUM(mttc) as Tvtemttc') )
        ->whereYear('created_at', date("Y", time()))
        ->whereMonth ('created_at', 4)
        ->get();
    
    $vte5 = DB::table('ventes')
        ->select(DB::raw('SUM(mttc) as Tvtemttc') )
        ->whereYear('created_at', date("Y", time()))
        ->whereMonth ('created_at', 5)
        ->get();
    $vte6 = DB::table('ventes')
        ->select(DB::raw('SUM(mttc) as Tvtemttc') )
        ->whereYear('created_at', date("Y", time()))
        ->whereMonth ('created_at', 6)
        ->get();
    $vte7 = DB::table('ventes')
        ->select(DB::raw('SUM(mttc) as Tvtemttc') )
        ->whereYear('created_at', date("Y", time()))
        ->whereMonth ('created_at', 7)
        ->get();
    $vte8 = DB::table('ventes')
        ->select(DB::raw('SUM(mttc) as Tvtemttc') )
        ->whereYear('created_at', date("Y", time()))
        ->whereMonth ('created_at', 8)
        ->get();
    $vte9 = DB::table('ventes')
        ->select(DB::raw('SUM(mttc) as Tvtemttc') )
        ->whereYear('created_at', date("Y", time()))
        ->whereMonth ('created_at', 9)
        ->get();
    $vte10 = DB::table('ventes')
        ->select(DB::raw('SUM(mttc) as Tvtemttc') )
        ->whereYear('created_at', date("Y", time()))
        ->whereMonth ('created_at', 10)
        ->get();
    $vte11 = DB::table('ventes')
        ->select(DB::raw('SUM(mttc) as Tvtemttc') )
        ->whereYear('created_at', date("Y", time()))
        ->whereMonth ('created_at', 11)
        ->get();
    $vte12 = DB::table('ventes')
        ->select(DB::raw('SUM(mttc) as Tvtemttc') )
        ->whereYear('created_at', date("Y", time()))
        ->whereMonth ('created_at', 12)
        ->get();
    
    $actu = DB::table('stockactu')->get();
    //dd($actu[0]);
    //if ((is_empty($request->from_date1))
    $i = 0;
    foreach($actu as $row) {
        $actupro[$i] = $row->prod;
        $actumont[$i] = $row->mont;     
        $i = $i+1;   
    }
    // dd($i);
    if ($i==0) {
        $actupro[0] = 0;
        $actumont[0] = 0; 
    }
    //dd($actupro);
   // print_r(json_encode($actupro));
    //$stockactu = stockactu::all();
    $vte = array(intval($vte1[0]->Tvtemttc), intval($vte2[0]->Tvtemttc), intval($vte3[0]->Tvtemttc), intval($vte4[0]->Tvtemttc), intval($vte5[0]->Tvtemttc), intval($vte6[0]->Tvtemttc), intval($vte7[0]->Tvtemttc), intval($vte8[0]->Tvtemttc), intval($vte9[0]->Tvtemttc), intval($vte10[0]->Tvtemttc), intval($vte11[0]->Tvtemttc), intval($vte12[0]->Tvtemttc));
    //dd($vte);
    return view('charts.index', ['ach' => $ach, 'vte' => $vte, 'actu' => $actu, 'actupro' => $actupro, 'actumont' => $actumont]);
    }

    public function loadchart2()
    {
        return view('charts.essai');
    }
   
}
