<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;

class usersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       return  response()->json(User::all(), 200);
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
            $user = new \App\User([
                "name"=>$post_data["name"],
                "number"=>$post_data["number"],
                "balance"=>$post_data["balance"],
                "username"=>$post_data["username"],
                ]);
           $user->save();
            return dd($post_data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$id)
    {
        $user = User::where('number', '=', $id)->first();
        return response()->json($user, 200);
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
        $user = User::find($id);
        $user->name =
                        !$request->has("name")?
                            $user->name:
                            $post_data["name"];
        $user->number =
                        !$request->has("number")?
                            $user->number:
                            $post_data["number"];
        $user->balance =
                        !$request->has("balance")?
                            $user->balance:
                            $post_data["balance"];
        $user->username =
                        !$request->has("username")?
                            $user->username:
                            $post_data["username"];
        $user->save();
        return response()->json($post_data, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->logs()->delete();
        $user->delete();
    }
      public function destroyAll(){
        User::turncate();
        return response()->json(["status"=>true], 200);
    }
}
