<?php

namespace App\Http\Controllers;
use App\Card;
use App\Type;
use Illuminate\Http\Request;

class cardsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAllAvailableCard()
    {
        $cards = Card::all();
        dd($cards);
    }
    public function index(Request $request)
    {
       return  response()->json(Card::all(), 200);
    }
    public function getCardByType($id)
    {
        $cards = Type::find($id)->card()->get();
        $cards = $cards==null?[]:$cards;
       return  response()->json($cards, 200);
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
        if($request->has("cardNumber") && $request->has("type_id")){
            $card = new \App\Card(["cardNumber"=>$post_data["cardNumber"]]);
            $type = Type::find($post_data["type_id"]);
            if($type==null){
                return response()->json(["status"=>false], 200);
            }
            $type->card();
            $type->card()->save($card);
            return response()->json($post_data, 200);
        }
        else {
            return response()->json(["status"=>false], 200);
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $post_data = $request->all();
        $card = Card::find($id);
        if($card==null)
        return response()->json(["status"=>false], 200);
        $card->cardNumber =!$request->has("cardNumber")?$type->price:$post_data["cardNumber"];
        $card->type_id =!$request->has("type_id")?$type->price:$post_data["type_id"];
        $card->save();
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
        $cards = Card::find($id);
        if($cards != null){

            $cards->delete();
            
            return response()->json(["status"=>true], 200);
        } 
        else {
            return response()->json(["status"=>false], 200);
        }
    }
    public function destoryAll()
    {
        Card::turncate();
        return response()->json(["status"=>true], 200);
    }
    public function getCardCount()
    {
        // CardTypeAccess ctacc = CardTypeAccess();
        // CompanyAccess ccacc = CompanyAccess();
        // var cards = await getCreditCards();
        // List<PrintWidget> tplist = new List<PrintWidget>();
        // for (CardType type in await ctacc.getCardTypes()) {
        //     Company cmp = await ccacc.getCompany(type.companyId);
        //     var typel = new PrintWidget(
        //     typeId: type.id,
        //     print: "${cmp.name} ${type.brandPrice}".replaceFirst(".0", ""),
        //     count: cards.where((i) => i.typeId == type.id).length);
        //     tplist.add(typel);
        // }

        // return tplist;
        $types =Type::all();
        $list=[];
        foreach ($types as $type) {
            $company_name = $type->company->name;
            $type_id = $type->id;
            $type_brandPrice = $type->brandPrice;
            $print = str_replace(".0","","${company_name} ${type_brandPrice}");
            $count = $type->card()->count();
            $list[]=new PrintWidget($type_id,$print,$count);
        }
        return response()->json($list, 200);
        
    }
}
class PrintWidget{
    public $type_id;
    public $print;
    public $count;

    public function __construct($type_id,$print,$count)
    {
        $this->type_id = $type_id;
        $this->print = $print;
        $this->count = $count;
    }
}