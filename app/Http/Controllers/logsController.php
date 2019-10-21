<?php

namespace App\Http\Controllers;
use App\Log;
use Illuminate\Http\Request;

class logsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
          return  response()->json(Log::all(), 200);
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
      
            $log = new \App\Log([
                "amount"=>$post_data["amount"],
                "label"=>$post_data["label"],
                "date"=>$post_data["date"],
                ]);
            $user = User::find($post_data["user_id"]);
            if($user==null){
                return response()->json(["status"=>false], 200);
            }
            $user->logs();
            $user->logs()->save($log);
            return dd($post_data);
          
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($now,$day)
    {
        if ($day - $now == -31536000000) {
        return  response()->json(Log::all(), 200);
    }
       return  response()->json(Log::whereBetween('date', [$day, $now])->get(), 200);
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
         $log = Log::find($id);
         $log->delete();
         return 1;
    }
    public function destroybyDate($now)
    {
        $log = Log::where("date","<=",$now)->delete();
        return 1;
    }
      public function destoryAll(){
        Log::query()->truncate();
        return response()->json(["status"=>true], 200);
    }
}
