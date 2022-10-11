<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;
use PhpParser\Node\Stmt\TryCatch;

class TodoController extends Controller
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
        return response()->json(Todo::all());
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
            $todo = Todo::forceCreate($this->request->only(['user_id','reminder','status']));
            return response()->json($todo);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(['message'=>'server error, please try again later'],404);
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
        $todo = Todo::findOrFail($id);
        return response()->json($todo);
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
            $todo = Todo::find($id)->update($request->only(['reminder','status']));
            return response()->json(['message'=>'todo updated successfully', 'data'=>$todo]);
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
            $todo = Todo::findOrFail($id);
            $todo->delete();

            return response()->json(['message'=>'successfully deleted todo']);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(['message'=>'server error, please try again later'],404);
        }
        
    }
}
