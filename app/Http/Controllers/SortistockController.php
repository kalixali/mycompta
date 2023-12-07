<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use App\Models\sortistock;
use App\Models\stockactu;
use App\Models\produit;
class SortistockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        //$sortistock = sortistock::all();
        $sortistock = DB::table('sortistock')
        ->whereYear('created_at', date("Y", time()))
        ->get();
        return view('sortistock.index')->with('sortistock', $sortistock);
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
        $inp = $request->all();
        $actu = DB::table('stockactu')->where('prod', $request->prod)->first();

        if (DB::table('stockactu')->where('prod', $request->prod)->exists()) {
            // ...
            //$affected = DB::table('stockactu')
            //  ->where('prod', $request->prod)
            //  ->decrement('qtite', $request->qtite);

            //sorti du stock
            sortistock::create($input);
            //mise à jour du stock
            $actu->qtite = intval($actu->qtite) - intval($request->qtite);
            $actu->mont = intval($actu->qtite) * intval($actu->pu);
            $affected = DB::table('stockactu')
              ->where('prod', $request->prod)
              ->update(['qtite' => $actu->qtite, 'pu' => $actu->pu, 'mont' => $actu->mont]);
        }
        else {

            //error
            
        }
        
        //effacer les lignes vides du tableau
        $deleted = DB::table('stockactu')->where('qtite', '<=', 0)->delete();
        return redirect('sortistock')->with('flash_message','Enregistrement effectué!');
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
        $sortistock = sortistock::find($id);
        return view('sortistock.edit')->with('sortistock', $sortistock);
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
        
        $input = $request->all();
        $sortistock = sortistock::find($request->id);
        $actu = DB::table('stockactu')->where('prod', $request->prod)->first();
        $sort = DB::table('sortistock')->where('id', $request->id)->first();
        $sortistock->update($input);

        //$act = DB::table('stockactu')->where('prod', $request->prod)->value('qtite');
        $actu->qtite = intval($actu->qtite) + intval($sort->qtite) - intval($request->qtite);
        //$actu->pu = (intval($actu->mont)+intval($request->mont))/(intval($actu->qtite)+intval($request->qtite));
        $actu->mont = intval($actu->qtite) * intval($actu->pu);

        $affected = DB::table('stockactu')
              ->where('prod', $request->prod)
              ->update(['qtite' => $actu->qtite, 'pu' => $actu->pu, 'mont' => $actu->mont]);
        //effacer les lignes vides du tableau
        $deleted = DB::table('stockactu')->where('qtite', '<=', 0)->delete();

        return redirect('sortistock')->with('flash_message', 'Stock modifié!');
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

        $sort = DB::table('sortistock')->where('id', $id)->first();
        $actu = DB::table('stockactu')->where('prod', $sort->prod)->first();

        $actu->qtite = intval($actu->qtite) + intval($sort->qtite);
        //$actu->pu = (intval($actu->mont)-intval($sort->mont))/(intval($actu->qtite)-intval($sort->qtite));
        $actu->mont = intval($actu->qtite) * intval($actu->pu);

        $affected = DB::table('stockactu')
              ->where('prod', $sort->prod)
              ->update(['qtite' => $actu->qtite, 'pu' => $actu->pu, 'mont' => $actu->mont]);
        //effacer les lignes vides du tableau
        $deleted = DB::table('stockactu')->where('qtite', '<=', 0)->delete();

        sortistock::destroy($id);
        return redirect('sortistock')->with('flash_message', 'Enregistrement supprimé!');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getsortistock(Request $request)
    {
        //
        $sortistock = DB::table('sortistock')
           ->whereBetween('created_at', [$request->from_date, $request->to_date])
           ->orderByDesc('sortistock.created_at')
           ->get();
        //dd($journal);

        return view('sortistock.index')->with('sortistock', $sortistock);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function searchsortistock(Request $request)
    {
        //
        
        //$produit = DB::table('produit')->where('refprod', $request->refprod)->first();
        $produit = DB::table('produit')
            ->where('refprod', 'like', $request->refprod)
            ->first();
            //->get();
        //dd($produit);
        $sortistock = DB::table('sortistock')
        ->whereYear('created_at', date("Y", time()))
        ->get();
        return view('sortistock.index1', ['produit' => $produit, 'sortistock' => $sortistock]);
    }
     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function searchsort1(Request $request)
    {
        //
        if($request->ajax()) {
            $data = produit::where('refprod', 'LIKE', $request->refprod.'%')->get();
            $output = ' ';
            if (count($data) > 0) {
                $output = '<ul class="list-group" style="display:block;position:relative;z-index:1">';
                    foreach($data as $row) {
                        $output .= '<li class="list-group-item">' .$row->refprod.' - '.$row->prod.'</li>';
                    }
                $output .= '</ul>';
            } 
            else{
                //$output .= '<li class="list-group-item"></li>';
            }
            return $output;
        }
        
    }

}
