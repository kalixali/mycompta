<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\plancpte;
use App\Models\Journal;
use PDF;

use Illuminate\Http\Request;

class BalanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        /**
        $balance = DB::table('Journal')
        ->select('debit', 'credit', DB::raw('SUM(Mdebit) as Tdebit'), DB::raw('SUM(Mcredit) as Tcredit'))
        ->groupByRaw('debit, credit')
        ->get();
        */

        // données à afficher pour les impressions
        $from_date = " ";
        $to_date = " ";
        $from_compte = " ";
        $to_compte = " ";

        //pour afficher un tablo vide on demande les données de l'année suivante
        $balance = DB::table('Journal')
            ->select('compte', 'libellé', DB::raw('SUM(Mdebit) as Tdebit'), DB::raw('SUM(Mcredit) as Tcredit'), DB::raw('SUM(Mcredit) - SUM(Mdebit) as solde'))
            ->groupByRaw('compte, libellé')
            ->whereYear('created_at', date("Y", strtotime("+1 year")))
            ->get();
        //la ligne des totaux de la balance
        $bal = DB::table('Journal')
            ->select(DB::raw('SUM(Mdebit) as Sdebit'), DB::raw('SUM(Mcredit) as Scredit'), DB::raw('SUM(Mcredit) - SUM(Mdebit) as Tsolde') )
            ->from('Journal')
            ->whereYear('created_at', date("Y", strtotime("+1 year")))
            ->get();
        //dd($bal);

        return view('balance.index', ['balance' => $balance, 'bal' => $bal, 'from_date' => $from_date, 'to_date' => $to_date,  'from_compte' => $from_compte, 'to_compte' => $to_compte]);
        //return view('balance.index')->with('balance', $balance);
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
    public function getBalance(Request $request)
    {
        // données à afficher pour les impressions
        $from_date = $request->from_date;
        $to_date = $request->to_date;
        $from_compte = $request->from_compte;
        $to_compte = $request->to_compte;
        //
        $balance = DB::table('Journal')
            ->select('compte', 'libellé', DB::raw('SUM(Mdebit) as Tdebit'), DB::raw('SUM(Mcredit) as Tcredit'), DB::raw('SUM(Mdebit) - SUM(Mcredit) as solde'))
            ->whereBetween('created_at', [$request->from_date, $request->to_date])
            ->whereBetween('compte', [$request->from_compte, $request->to_compte]) 
            ->groupByRaw('compte, libellé')
            ->get();
        //dd($balance);
        //la ligne des totaux de la balance
        $bal = DB::table('Journal')
            ->select(DB::raw('SUM(Mdebit) as Sdebit'), DB::raw('SUM(Mcredit) as Scredit'), DB::raw('SUM(Mdebit) - SUM(Mcredit) as Tsolde') )
            ->whereBetween('created_at', [$request->from_date, $request->to_date])
            ->whereBetween('compte', [$request->from_compte, $request->to_compte]) 
            ->from('Journal')
            ->get();

        return view('balance.index', ['balance' => $balance, 'bal' => $bal, 'from_date' => $from_date, 'to_date' => $to_date,  'from_compte' => $from_compte, 'to_compte' => $to_compte]);
        //return view('balance.index')->with('balance', $balance);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function downloadbalance(Request $request)
    {
        // données à afficher pour les impressions
        // $from_date = $request->from_date;
        // $to_date = $request->to_date;
        // $from_compte = $request->from_compte;
        // $to_compte = $request->to_compte;
        if ((is_null($request->from_date1)) && (is_null($request->to_date1)) && (is_null($request->from_compte1)) && (is_null($request->to_compte1)) ) {
             // données à afficher pour les impressions
        $from_date = " ";
        $to_date = " ";
        $from_compte = " ";
        $to_compte = " ";

        //pour afficher un tablo vide on demande les données de l'année suivante
        $balance = DB::table('Journal')
            ->select('compte', 'libellé', DB::raw('SUM(Mdebit) as Tdebit'), DB::raw('SUM(Mcredit) as Tcredit'), DB::raw('SUM(Mcredit) - SUM(Mdebit) as solde'))
            ->groupByRaw('compte, libellé')
            ->whereYear('created_at', date("Y", strtotime("+1 year")))
            ->get();
        //la ligne des totaux de la balance
        $bal = DB::table('Journal')
            ->select(DB::raw('SUM(Mdebit) as Sdebit'), DB::raw('SUM(Mcredit) as Scredit'), DB::raw('SUM(Mcredit) - SUM(Mdebit) as Tsolde') )
            ->from('Journal')
            ->whereYear('created_at', date("Y", strtotime("+1 year")))
            ->get();
        
            return view('balance.index', ['balance' => $balance, 'bal' => $bal, 'from_date' => $from_date, 'to_date' => $to_date,  'from_compte' => $from_compte, 'to_compte' => $to_compte]);
        } else
        {
        //affiche la date du jour
        $dat = date("d/m/Y", time());
        //dd($request->from_compte1);
         $entreprise = DB::table('entreprise')->where('id', 1)->first();
        //
        $balance = DB::table('Journal')
            ->select('compte', 'libellé', DB::raw('SUM(Mdebit) as Tdebit'), DB::raw('SUM(Mcredit) as Tcredit'), DB::raw('SUM(Mdebit) - SUM(Mcredit) as solde'))
            ->whereBetween('created_at', [$request->from_date1, $request->to_date1])
            ->whereBetween('compte', [$request->from_compte1, $request->to_compte1]) 
            ->groupByRaw('compte, libellé')
            ->get();
        //dd($balance);
        //la ligne des totaux de la balance
        $bal = DB::table('Journal')
            ->select(DB::raw('SUM(Mdebit) as Sdebit'), DB::raw('SUM(Mcredit) as Scredit'), DB::raw('SUM(Mdebit) - SUM(Mcredit) as Tsolde') )
            ->whereBetween('created_at', [$request->from_date1, $request->to_date1])
            ->whereBetween('compte', [$request->from_compte1, $request->to_compte1]) 
            ->from('Journal')
            ->get();

        //periode
        $period = " du  ".date('d/m/Y', strtotime($request->from_date1))."  au  ".date('d/m/Y', strtotime($request->to_date1));

        //return view('balance.index', ['balance' => $balance, 'bal' => $bal, 'from_date' => $from_date, 'to_date' => $to_date,  'from_compte' => $from_compte, 'to_compte' => $to_compte]);
        $pdf = PDF::loadView('balance.balancepdf', ['balance' => $balance, 'bal' => $bal, 'entreprise' => $entreprise, 'dat' => $dat, 'period' => $period]);
        return $pdf->download('balance.pdf');
     }
    }

     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    //filtre par compte
    public function searchcpte1(Request $request)
    {
        //
        if($request->ajax()) {
            $data = plancpte::where('compte', 'LIKE', $request->compte.'%')->get();
            $output = ' ';
            if (count($data) > 0) {
                $output = '<ul class="list-group" style="display:block;position:relative;z-index:1">';
                    foreach($data as $row) {
                        $output .= '<li class="list-group-item">' .$row->compte.' - '.$row->Libelle.'</li>';
                    }
                $output .= '</ul>';
            } 
            else{
                //$output .= '<li class="list-group-item">Compte Non Defini</li>';
            }
            return $output;
        }
        
       
    }

}
