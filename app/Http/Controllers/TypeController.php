<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Type;
use DB;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $type = DB::table('types')
            ->orderBy('type_id')->get()
            ->all();

        $response = [
            'data' => $type
        ];

        return response()->json($response, 200);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $this->validate($request,[
            'type'  => 'required'
        ]);

        $type = Type::create([
            'type'  => ucwords($request->type),
        ]);

        if (!$type) {
            return response()->json(['message' => 'failed to create type'], 401);
        }

        $response = [
            'status'  => true,
            'data'    => $type,
        ];

        return response()->json($response, 201);
    }

}