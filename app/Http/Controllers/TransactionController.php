<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transformers\TransactionTransformer;
use App\Http\Requests\TransactionRequest;

class TransactionController extends Controller
{

    public function index()
    {
        return ['message' => 'berhasil'];
    }



    public function store(TransactionRequest $request)
    {
        $transaction = $transaction->create([
            'type'      => $request->type,
            'category'  => $request->category,
            'amount'    => htmlspecialchars($request->amount),
            'note'      => htmlspecialchars($request->note),
            'date'      => $request->date,
            'user'      => htmlspecialchars($request->user)
        ]);

        $response = fractal()
            ->item($transaction)
            ->transformWith(new TransactionTransformer)
            ->toArray();

        if(!$transaction) {
            return response()->json(['message' => 'Internal serve Error'],500);
        } else {
            return response()->json($response, 201);
        }
    }


    public function show($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}
