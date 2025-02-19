<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class TransactionController extends Controller
{

    public function showTransactions($id)
    {
        $customer = Customer::findOrFail($id);
        // $transactions = $customer->transactions;
        $transactions = Transaction::where('customer_id', $id)->get();

        return view('transactions', ['customer' => $customer, 'transactions' => $transactions]);
    }
    public function credit(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'amount' => 'required|numeric|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $customer = $request->user();

        Transaction::create([
            'customer_id' => $customer->customer_id,
            'type' => 'credited', 
            'amount' => $request->amount,
            'ip' => $request->ip(),
        ]);

        $customer->amount += $request->amount;
        $customer->save();

        return response()->json(['message' => 'Amount credited successfully', 'new_balance' => $customer->amount], 200);
    }


    public function debit(Request $request)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'amount' => 'required|numeric|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $customer = $request->user();

        $todayTransactions = Transaction::where('customer_id', $customer->customer_id)
            ->where('type', 'debited') 
            ->whereDate('created_at', now()->format('Y-m-d'))
            ->count();

        if ($todayTransactions >= 5) {
            return response()->json(['message' => 'Transaction limit reached for today (5 transactions)'], 403);
        }

        if ($customer->amount < $request->amount) {
            return response()->json(['message' => 'Insufficient balance'], 400);
        }

        $customer->amount -= $request->amount;
        $customer->save();

        Transaction::create([
            'customer_id' => $customer->customer_id,
            'type' => 'debited', 
            'amount' => $request->amount,
            'ip' => $request->ip(),
        ]);

        return response()->json(['message' => 'Amount debited successfully', 'new_balance' => $customer->amount], 200);
    }
}
