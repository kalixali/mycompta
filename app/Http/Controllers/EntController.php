<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\entreprise;

class EntController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        
        if (DB::table('entreprise')->where('id', 1)->exists()) {
            // ...
            $entreprise = DB::table('entreprise')->where('id', 1)->first();
            return view('entreprise.index1')->with('entreprise', $entreprise);
        }
        else {

            return view('entreprise.index');
            
        }

        
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
        $filename = time().$request->file('logo')->getClientOriginalName();
        $path = $request->file('logo')->storeAs('images', $filename, 'public');
        $input["logo"] = '/storage/'.$path;
        //$input = $request->all();;
        //employe::create($input);
        if (DB::table('entreprise')->where('id', 1)->exists()) {
            // ...
            $entreprise = entreprise::find(1);
            $entreprise->update($input);

            $entreprise = DB::table('entreprise')->where('id', 1)->first();

            return view('entreprise.index1')->with('entreprise', $entreprise);
        } else {
            //$input = $request->all();
            entreprise::create($input);
            $entreprise = DB::table('entreprise')->where('id', 1)->first();
            return view('entreprise.index1')->with('entreprise', $entreprise);
            
        }


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
}
