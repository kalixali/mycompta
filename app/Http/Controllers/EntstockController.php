<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\entstock;
use App\Models\stockactu;
use App\Models\produit;
use Illuminate\Support\Facades\DB;
//use DB;


class EntstockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        //$entstock = entstock::all();
        $entstock = DB::table('entstock')
        ->whereYear('created_at', date("Y", time()))
        ->get();
        return view('entstock.index')->with('entstock', $entstock);
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
        entstock::create($input);

        if (DB::table('stockactu')->where('prod', $request->prod)->exists()) {
            // ...
            //$affected = DB::table('stockactu')
             // ->where('prod', $request->prod)
             // ->increment('qtite', $request->qtite);
            $actu = DB::table('stockactu')->where('prod', $request->prod)->first();
            $actu->qtite = intval($actu->qtite) + intval($request->qtite);
            $actu->pu = (intval($actu->mont)+intval($request->mont))/(intval($actu->qtite)+intval($request->qtite));
            $actu->mont = intval($actu->qtite) * intval($actu->pu);

            $affected = DB::table('stockactu')
                ->where('prod', $request->prod)
                ->update(['qtite' => $actu->qtite, 'pu' => $actu->pu, 'mont' => $actu->mont]);
        }
        else {

            stockactu::create($inp);
            
        }
        

        return redirect('entstock')->with('flash_message','Enregistrement effectué!');
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
        $entstock = entstock::find($id);
        return view('entstock.edit')->with('entstock', $entstock);
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
        $entstock = entstock::find($request->id);
        $actu = DB::table('stockactu')->where('prod', $request->prod)->first();
        $ent = DB::table('entstock')->where('id', $request->id)->first();
        $entstock->update($input);

        //$act = DB::table('stockactu')->where('prod', $request->prod)->value('qtite');
        $actu->qtite = intval($actu->qtite) - intval($ent->qtite) + intval($request->qtite);
        $actu->pu = (intval($actu->mont)+intval($request->mont))/(intval($actu->qtite)+intval($request->qtite));
        $actu->mont = intval($actu->qtite) * intval($actu->pu);

        $affected = DB::table('stockactu')
              ->where('prod', $request->prod)
              ->update(['qtite' => $actu->qtite, 'pu' => $actu->pu, 'mont' => $actu->mont]);
        
        return redirect('entstock')->with('flash_message', 'Stock modifié!');
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
        $ent = DB::table('entstock')->where('id', $id)->first();
        $actu = DB::table('stockactu')->where('prod', $ent->prod)->first();

        $actu->qtite = intval($actu->qtite) - intval($ent->qtite);
        $actu->pu = (intval($actu->mont)-intval($ent->mont))/(intval($actu->qtite)-intval($ent->qtite));
        $actu->mont = intval($actu->qtite) * intval($actu->pu);

        $affected = DB::table('stockactu')
              ->where('prod', $ent->prod)
              ->update(['qtite' => $actu->qtite, 'pu' => $actu->pu, 'mont' => $actu->mont]);

        $deleted = DB::table('stockactu')->where('qtite', '<=', 0)->delete();
                
        entstock::destroy($id);
        return redirect('entstock')->with('flash_message', 'Enregistrement supprimé!');
    }

     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getentstock(Request $request)
    {
        //
        $entstock = DB::table('entstock')
           ->whereBetween('created_at', [$request->from_date, $request->to_date])
           ->orderByDesc('entstock.created_at')
           ->get();
        //dd($journal);

        return view('entstock.index')->with('entstock', $entstock);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function searchentstock(Request $request)
    {
        //
        
        //$produit = DB::table('produit')->where('refprod', $request->refprod)->first();
        $produit = DB::table('produit')
            ->where('refprod', 'like', $request->refprod)
            ->first();
            //->get();
        //dd($produit);
        $entstock = DB::table('entstock')
        ->whereYear('created_at', date("Y", time()))
        ->get();
        return view('entstock.index1', ['produit' => $produit, 'entstock' => $entstock]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function searchent1(Request $request)
    {
        //
        if($request->ajax()) {
            $data = produit::where('refprod', 'LIKE', $request->refprod.'%')->get();
            $output = ' ';
            if (count($data) > 0) {
                $output = '<ul class="list-group" style="display:block;position:relative;z-index:1">';
                    foreach($data as $row) {
                        //$output .= '<li class="list-group-item">' .$row->refprod.'</li>';
                        $output .= '<li class="list-group-item">' .$row->refprod.' - '.$row->prod.'</li>';
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
}
