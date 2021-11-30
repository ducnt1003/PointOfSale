<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\CustomerGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::get();
        $select = [];
        $i = 0;
        foreach ($customers as $customer) {
            $str = $customer['name'] . "(" . $customer['phone'] . ")";
            $select[$i] = [
                "value" => $customer['id'],
                "text" => $str,
            ];
            $i++;
        }

        return $select;
    }

    public function create(Request $request)
    {
       $customer = Customer::create($request->all());
       if ($customer){
       return response()->json('successfully added');
       } else return response()->json('fail');
    }

    public function addMoney($id, $money)
    {
        $customer = Customer::where('id', $id)->first();
        $gid = 1;
        if ($customer) {
            $customer->total_money += $money;
            $customer_groups = CustomerGroup::get();
            foreach ($customer_groups as $customer_group) {
                if ($customer->total_money < $customer_group->condition) {
                    $customer->group_id = $gid;
                    break;
                }
                $gid = $customer_group->id;
            }
            $customer->save();
        }
    }

    public function getList()
    {
    }
}
