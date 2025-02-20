<?php

namespace App\Http\Controllers;

use App\Imports\CustomersImport;
use App\Models\Customer;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class CustomerController extends Controller
{
    public function dashboard()
    {
        $customerCount = Customer::count();
        $totalAmount = Customer::sum('amount');
        return view('index', compact('customerCount', 'totalAmount'));
    }
    public function create()
    {
        return view('add-customer');
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:customers',
            'password' => 'required|string|min:8',
            'mobile' => 'required|string|max:15',
        ]);

        $customer = new Customer();
        $customer->name = $validated['name'];
        $customer->email = $validated['email'];
        $customer->password = bcrypt($validated['password']);
        $customer->mobile = $validated['mobile'];
        $customer->save();

        return response()->json(['message' => 'Customer created successfully']);
    }

    public function index()
    {
        $customers = Customer::withCount('transactions')->get();
        return view('customers', ['customers' => $customers]);
    }

    public function show($id)
    {
        $customer = Customer::findOrFail($id);
        $transactions = $customer->transactions;
        return view('transactions', ['customer' => $customer, 'transactions' => $transactions]);
    }


    public function apicustomerview()
    {

        $customers = Customer::withCount('transactions')
            ->with(['transactions' => function ($query) {
                $query->latest()->take(5);
            }])
            ->get()
            ->makeHidden('password');

        return response()->json($customers);
    }

    public function excelcreate()
    {
        return view('add-customer-excel');
    }
    public function excelstore(Request $request)
    {
    
        $request->validate([
            'file' => 'required|mimes:xlsx,csv,ods|max:2048',
        ]);
        
        Excel::import(new CustomersImport, $request->file('file'));
    
        return redirect()->back()->with('success', 'Customers Imported Successfully');
    }
}
