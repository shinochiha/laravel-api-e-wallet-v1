<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transformers\TransactionTransformer;
use App\Http\Requests\TransactionRequest;
use App\Http\Resources\TransactionResource;
use App\Transaction;
use JWTAuth;
use DB;


class TransactionController extends Controller
{
    public function __construct()
    {
        $this->middleware('jwt.auth', ['except' => 'index']);
    }

    public function index()
    {
        $transaction = DB::table('transactions')
            ->orderBy('transaction_id')->get()
            ->all();

        $response = [
            'data' => $transaction
        ];

        return response()->json($response, 200);
    }



    public function store(TransactionRequest $request)
    {   
        $transaction = Transaction::create([

            'type'      => $request->type,
            'category_id'  => $request->category_id,
            'amount'    => htmlspecialchars($request->amount),
            'note'      => htmlspecialchars($request->note),
            'date'      => $request->date,
            'user'      => htmlspecialchars(ucwords($request->user)),
            'user_id'   => JWTAuth::authenticate()->id,

        ]);

        $response = fractal()
            ->item($transaction)
            ->transformWith(new TransactionTransformer)
            ->toArray();

        if(!$transaction) {

            return response()->json(['message' => 'Internal server Error'],500);

        } else {

            return response()->json($response, 201);

        }
    }

    public function show($id)
    {
        return ['user' => Transaction::findOrFail($id)];
    }


    public function update(TransactionRequest $request, Transaction $transaction)
    {

        $transaction->update([

            'type'      => $request->type,
            'category'  => $request->category,
            'amount'    => htmlspecialchars($request->amount),
            'note'      => htmlspecialchars($request->note),
            'date'      => $request->date,
            'user'      => htmlspecialchars(ucwords($request->user)),

        ]);

        return response()->json($transaction, 200);
    }
}
