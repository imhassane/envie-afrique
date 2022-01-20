<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index(Request $request) {
        $mode = $request->query('mode');
        if(!$mode) $mode = 'all';

        $PAGINATE = 30;

        $customers = null;
        switch($mode) {
            case 'all':
                $customers = Customer::paginate($PAGINATE);
                break;
            case 'most_orders':
                $customers = Customer::orderByDesc('cus_nb_orders')->paginate($PAGINATE);
                break;
            case 'most_expenses':
                $customers = Customer::orderByDesc('cus_total_spendings')->paginate($PAGINATE);
        }

        return view('admin.customer.index', [
            'customers' => $customers,
        ]);
    }
}
