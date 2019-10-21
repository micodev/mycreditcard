<?php

namespace App\Http\Controllers;
use App\Type;
use App\Company;
use Illuminate\Http\Request;

class typesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return  response()->json(Type::all(), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // "brandPrice","price","company_id"
    public function store(Request $request)
    {
        $post_data = $request->all();
   
        $type = new \App\Type(["brandPrice"=>$post_data["brandPrice"],"price"=>$post_data["price"]]);
        $company=Company::find($post_data["company_id"]);
        if($company==null){
            return response()->json(["status"=>false], 200);
        }
        $company->types();
        $company->types()->save($type);
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
        $post_data = $request->all();
        $type = Type::find($id);
        if($type==null)
        return response()->json(["status"=>false], 200);
        $type->brandPrice = 
                            !$request->has("brandPrice")?
                                            $type->brandPrice:
                                            $post_data["brandPrice"];
        $type->price =!$request->has("price")?$type->price:$post_data["price"];
        $type->company_id =!$request->has("company_id")?$type->price:$post_data["company_id"];
        $type->save();
        return response()->json(["status"=>true], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $types = Type::find($id);
        if($types != null){
            $card = $types->card();
            if($card != null)
                $card->delete();
            $types->delete();
            
            return response()->json(["status"=>true], 200);
        } 
        else {
            return response()->json(["status"=>false], 200);
        }
    }
    public function destoryAll()
    {
        Type::turncate();
        return response()->json(["status"=>true], 200);
    }
    public function destroyAllCardTypesByCompany(Request $request, $id)
    {
        Company::find($id)->types()->delete();
        return true;
    }
    public function getTypesFromCompany(Request $request,$id)
    {
        $types = Company::find($id)->types()->get();
        $types = $types==null?[]:$types;
        return response()->json($types, 200);
    }
    public function getTypeAndCompany(Type $var = null)
    {
        // var cmpa = new CompanyAccess();
        // List<List<dynamic>> _final = new List();
        // List<CardType> types = await getCardTypes();
        // for (int i = 0; i < types.length; i++) {
        // Company c = await cmpa.getCompany(types[i].companyId);
        // _final.add([types[i], c]);
        // }

        // return _final;
        $result =[];
        $types =Type::all();
        foreach ($types as $type) {
            $res=[clone $type,$type->company];
            $result[] = $res;
        }
        
        return response()->json($result,200);
        
    }
}
