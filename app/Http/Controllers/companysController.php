<?php

namespace App\Http\Controllers;
use App\Company;
use Illuminate\Http\Request;

class companysController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return  response()->json(Company::all(), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $post_data = $request->all();
        Company::create($post_data);
        
        return response()->json($post_data, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $company = Company::find($id);
        return response()->json($company, 200);
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
        $post_data = $request->all();
        $company = Company::find($id);
        if($request->has("name")){
            $company->name = $post_data["name"];
            $company->save();
            return response()->json($post_data, 200);
        }
        else {
            return response()->json($post_data, 200);
        }
        
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyAll(){
        Company::turncate();
        return response()->json(["status"=>true], 200);
    }
    public function destroy($id)
    {
        $company = Company::find($id);
        if($company==null)
            return response()->json(["status"=>false], 200);
        $types = $company->types();

        foreach ($types->get() as $type) {
            $card = $type->card();
            if($card!=null)
                $card->delete();
        }
        if($types !=null)
        $types->delete();
        $company->delete();
        return response()->json(["status"=>true], 200); 
    }
}
