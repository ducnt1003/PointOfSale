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
        $customers = Customer::select([
			'id AS value',
			DB::raw("CONCAT(name, '(',phone, ')') AS text")
			])
		->get();
		return $customers;
    }

    public function create(Request $request)
    {
        $customer = Customer::create($request->all());
        $str = $customer['name'] . "(" . $customer['phone'] . ")";
        $newCustomer = [
            "value" => $customer['id'],
            "text" => $str,
        ];

        return $newCustomer;
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
