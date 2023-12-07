<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\produit;
use PDF;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class ProduitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $produit = DB::table('produit')
        ->orderByDesc('produit.created_at')
        ->get();
       
        return view('produit.index')->with('produit', $produit);
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
        //pour ajouter les fournisseurs dans le plan comptable
        //$inp = array("compte"=>$request->cptefourn, "Libelle"=>$request->fourn);
        //dd($inp);
        //dd($input);
        produit::create($input);
        return redirect('produit')->with('flash_message','Enregistrement effectué!');
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
        // //
        $produits = DB::table('produit')
        ->orderByDesc('produit.created_at')
        ->get();
        //
        $produit = produit::find($id);
        return view('produit.edit')->with('produit', $produit);
        //return view('produit.edit', ['produits' => $produits, 'produit' => $produit]);

    }

    
    /* public function editionprod($id)
    {
        // code pour modifier un produit sans changer de page
        
       // $data = produit::find($request->id);
        //dd($data);
        $data = produit::where('refprod', 'LIKE', $request->id.'%')->get();
        if($request->ajax()) {
            //$data = produit::find($request->id);
            //$data = produit::where('refprod', 'LIKE', $request->id.'%')->get();
            //$data = $request->id;
            //dd($data);
            $output = ' ';
            if (count($data) > 0) {
               // $output = '<ul class="list-group" style="display:block;position:relative;z-index:1">';
                    //foreach($data as $row) {
                        //$output .= '<li class="list-group-item">' .$row->refprod.'</li>';
                $output .= 'Modification reussie';
                    //}
                //$output .= '</ul>';
            } 
            else{
                //$output .= '<li class="list-group-item"></li>';
            }
            return $output;
            //return $data;
        }
    }
 */

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
        $produit = produit::find($id);
        $input = $request->all();
        $produit->update($input);
        return redirect('produit')->with('flash_message', 'produit modifié!');
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
        produit::destroy($id);
        return redirect('produit')->with('flash_message', 'Enregistrement supprimé!');
    }

    
    public function scan()
    {
        //
        $entreprise = DB::table('entreprise')->where('id', 1)->first();
        $produit = DB::table('produit')->get();
        $dat = date("d/m/Y", time());
        //dd($produit);
        $pdf = PDF::loadView('produit.prodscanpdf', ['entreprise' => $entreprise, 'produit' => $produit, 'dat' => $dat]);
        return $pdf->download('prodscan.pdf');
    }
}
