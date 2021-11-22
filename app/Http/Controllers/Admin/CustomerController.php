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
        $customers = Customer::get();
        $select=[];
        $i = 0;
        foreach($customers as $customer){
            $str = $customer['name']."(".$customer['phone'].")";
            $select[$i]=[
                "value" => $customer['id'],
                "text" => $str,
            ];
            $i++;
        }

        return $select;
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
