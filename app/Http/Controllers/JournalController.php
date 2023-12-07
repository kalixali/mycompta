<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use App\Models\Journal;
use App\Models\plancpte;
use App\Models\entreprise;
use App\Models\codesjournaux;
use Carbon\Carbon;
use PDF;


class JournalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        
        //$journal = Journal::all();
       //
       
       
       //
    //    $from_compte = " ";
    //    $to_compte = " ";

        //$journal = DB::table('Journal')
        $journal = DB::table('Journal')
        ->select('id', 'codejournal', 'numpiece', 'created_at as Date', 'compte', 'libellé', 'Mdebit', 'Mcredit')
         //->orderByDesc('Journal.compte')
        ->whereYear('created_at', date("Y", time()))
        ->whereMonth ('created_at', date("m", time()))
        ->orderByDesc('Journal.created_at')
        ->get();
        //date('d/m/Y', strtotime($item->Date))
        
        /* $d = date('t');
        $m = date('m');
        $y = date('Y');
        $tz = 'Europe/London';
        $from_date =  Carbon::today(); */
        //$from_date = strtotime(date('01/m/Y'));
        //$from_date = strftime(date('01/m/Y'));
        // $from_datea = date('01/m/Y');
        // $from_date = Carbon::createFromDate($year, $month, $day, $tz);
        //$from_date = new \DateTime(date('01/m/Y'));
        //$to_date = strftime(date('t/m/Y'));
        //$from_date = date('d/m/Y', strtotime(date('01/m/Y')));
        //$from_date = Carbon::today();
        // $to_date = date('t/m/Y');
        $from_date = " ";
        $to_date = " ";
        
        $codejournal1 = " ";
        //dd($from_datea);

        //la ligne des totaux du journal
        $totjournal = DB::table('Journal')
        ->select(DB::raw('SUM(Mdebit) as Sdebit'), DB::raw('SUM(Mcredit) as Scredit'), DB::raw('SUM(Mdebit) - SUM(Mcredit) as Tsolde') )
        ->whereYear('created_at', date("Y", time()))
        ->whereMonth ('created_at', date("m", time()))
        ->from('Journal')
        ->get();
       
        return view('journal.index', ['journal' => $journal, 'totjournal' => $totjournal, 'from_date' => $from_date, 'to_date' => $to_date, 'codejournal1' => $codejournal1]);
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
        Journal::create($input);
        return redirect('journal')->with('flash_message','Enregistrement effectué!');
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
        $journal = Journal::find($id);
        return view('journal.edit')->with('journal', $journal);
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
        $journal = Journal::find($id);
        $input = $request->all();
        $journal->update($input);
        return redirect('journal')->with('flash_message', 'Journal modifié!');
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
        Journal::destroy($id);
        return redirect('journal')->with('flash_message', 'Enregistrement supprimé!');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getjournal(Request $request)
    {
        // données à afficher pour les impressions
        $from_date = $request->from_date;
        $to_date = $request->to_date;
        $codejournal1 = $request->codejournal1;
        // $from_compte = $request->from_compte;
        // $to_compte = $request->to_compte;
        //
        $journal = DB::table('Journal')
           ->select('id', 'codejournal', 'numpiece', 'created_at as Date', 'compte', 'libellé', 'Mdebit', 'Mcredit')
           ->whereBetween('created_at', [$request->from_date, $request->to_date])
           //->whereBetween('compte', [$request->from_compte, $request->to_compte])
           ->where('codejournal', $request->codejournal1)
           ->orderByDesc('Journal.created_at')
           ->get();
        
        //la ligne des totaux journal
        $totjournal = DB::table('Journal')
        ->select(DB::raw('SUM(Mdebit) as Sdebit'), DB::raw('SUM(Mcredit) as Scredit'), DB::raw('SUM(Mdebit) - SUM(Mcredit) as Tsolde') )
        ->whereBetween('created_at', [$request->from_date, $request->to_date])
        ->where('codejournal', $request->codejournal1)
        ->from('Journal')
        ->get();
        
        //dd($journal);
        // return view('journal.index', ['journal' => $journal, 'from_date' => $from_date, 'to_date' => $to_date,  'from_compte' => $from_compte, 'to_compte' => $to_compte]);
        return view('journal.index', ['journal' => $journal, 'totjournal' => $totjournal, 'from_date' => $from_date, 'to_date' => $to_date,  'codejournal1' => $codejournal1]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function searchcodejournal(Request $request)
    {
        //
        if($request->ajax()) {
            $data = codesjournaux::where('Code', 'LIKE', $request->codejournal.'%')->get();
            $output = ' ';
            if (count($data) > 0) {
                $output = '<ul class="list-group" style="display:block;position:relative;z-index:1">';
                    foreach($data as $row) {
                        $output .= '<li class="list-group-item">' .$row->Code.' - '.$row->Designation.'</li>';
                    }
                $output .= '</ul>';
            } 
            else{
                //$output .= '<li class="list-group-item">Compte Non Defini</li>';
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

     public function downloadjournal(Request $request)
     {
       
        //dd($request->from_date1);
         $entreprise = DB::table('entreprise')->where('id', 1)->first();
        //filtre le journal à imprimer
        if ((is_null($request->from_date1)) && (is_null($request->to_date1)) && (is_null($request->codejournal2))) {

        $journal = DB::table('Journal')
        ->select('id', 'codejournal', 'numpiece', 'created_at as Date', 'compte', 'libellé', 'Mdebit', 'Mcredit')
         //->orderByDesc('Journal.compte')
        ->whereYear('created_at', date("Y", time()))
        ->whereMonth ('created_at', date("m", time()))
        ->orderByDesc('Journal.created_at')
        ->get();
        
        // $from_date = " ";
        // $to_date = " ";
        
        // $codejournal1 = " ";
        //dd($from_datea);

        //la ligne des totaux du journal
        $totjournal = DB::table('Journal')
        ->select(DB::raw('SUM(Mdebit) as Sdebit'), DB::raw('SUM(Mcredit) as Scredit'), DB::raw('SUM(Mdebit) - SUM(Mcredit) as Tsolde') )
        ->whereYear('created_at', date("Y", time()))
        ->whereMonth ('created_at', date("m", time()))
        ->from('Journal')
        ->get();
        //periode
        $period = "Ecritures comptables du mois encour - Du ". date('01/m/Y')." Au ".date('t/m/Y');
        
        } else
        {
          $journal = DB::table('Journal')
           ->select('id', 'codejournal', 'numpiece', 'created_at as Date', 'compte', 'libellé', 'Mdebit', 'Mcredit')
           ->whereBetween('created_at', [$request->from_date1, $request->to_date1])
          // ->whereBetween('compte', [$request->from_compte1, $request->to_compte1])
           ->where('codejournal', $request->codejournal2)
           ->orderByDesc('Journal.created_at')
           ->get();
         //dd($journal);
        //
         //la ligne des totaux du journal
         $totjournal = DB::table('Journal')
         ->select(DB::raw('SUM(Mdebit) as Sdebit'), DB::raw('SUM(Mcredit) as Scredit'), DB::raw('SUM(Mdebit) - SUM(Mcredit) as Tsolde') )
         ->whereBetween('created_at', [$request->from_date1, $request->to_date1])
         ->where('codejournal', $request->codejournal2)
         ->from('Journal')
         ->get();
         //periode
         $period = " du  ".date('d/m/Y', strtotime($request->from_date1))."  au  ".date('d/m/Y', strtotime($request->to_date1));
        }
        //affiche la date du jour
        $dat = date("d/m/Y", time());

        // dans le cas où l'escompte et les frais d'achats sont nulls
        //$pdf = PDF::loadView('achats.indexachpdf', ['journal' => $journal, 'totfact' => $totfact, 'entreprise' => $entreprise, 'dat' => $dat]);
        $pdf = PDF::loadView('journal.journalpdf', ['journal' => $journal, 'totjournal' => $totjournal, 'entreprise' => $entreprise, 'period' => $period, 'dat' => $dat]);
        return $pdf->download('journal.pdf');
                      
     }

    
}
