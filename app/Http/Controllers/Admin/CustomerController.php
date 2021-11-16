<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = DB::table('customers')
        ->select('id','name','phone')
            ->get();

        return response()->json($customers);
    }

    public function search(Request $request)
    {
        $data = Customer::where('name', 'LIKE','%'.$request->keyword.'%')->get();
        return response()->json($data);
    }

    public function store(Request $request)
    {
        $customer = new Customer([
           'name' => $request->get('name'),
           'phone'=> $request->get('phone'),
           'email'=> $request->get('email'),
           'address'=> $request->get('address'),
          ]);

          $customer->save();

          return response()->json('successfully added');
    }
}
