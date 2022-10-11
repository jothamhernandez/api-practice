<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    protected $request;
    public function __construct(Request $request)
    {
        $this->request = $request;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return response()->json(User::all());
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
        try {
            $user = User::add($this->request->only(['name','email','password']));
            return response()->json([
                'message'=>'user created successfully',
                'data'=>$user
            ]);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(['message'=>'server error, please try again later']);
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

        $user = User::findOrFail($id);
        return response()->json($user);
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
        try {
            //code...
            $user = User::find($id)->update($request->only(['name','password']));
            return response()->json(['message'=>'user updated successfully', 'data'=>$user]);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(['message'=>'server error, please try again later'],404);
        }
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
        try {
            //code...
            $todo = User::findOrFail($id);
            $todo->delete();
            return response()->json(['message'=>'successfully deleted user']);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(['message'=>'server error, please try again later'],404);
        }
    }
}
