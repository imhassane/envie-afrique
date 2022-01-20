<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderProducts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpMqtt\Client\Exceptions\ConfigurationInvalidException;
use PhpMqtt\Client\Exceptions\ConnectingToBrokerFailedException;
use PhpMqtt\Client\Exceptions\DataTransferException;
use PhpMqtt\Client\Exceptions\ProtocolNotSupportedException;
use PhpMqtt\Client\Exceptions\RepositoryException;
use PhpMqtt\Client\MqttClient;

class OrderController extends Controller
{
    public function index() {
        $total_price = session()->get('total_price');
        $delivery_fees = session()->get('delivery_fees');

        if(is_null($total_price) || is_null($delivery_fees)) {
            return redirect(route('home'));
        }

        return view('order', [
            'total_price' => $total_price,
            'delivery_fees' => $delivery_fees,
        ]);
    }

    public function store(Request $request) {

        $request->validate([
            'fullname' => 'required|min:4',
            'date' => 'required',
            'time' => 'required',
            'type' => 'required',
            'confirm_city' => 'required',
            'confirm_info' => 'required',
            'phone' => 'required|min:10',
            'address' => 'nullable|min:5',
        ]);

        $total_price = session()->get('total_price');
        $delivery_fees = session()->get('delivery_fees');
        $cart = session()->get('cart');

        DB::beginTransaction();
        try {
            $customer = Customer::where('cus_phone', $request->phone)->first();

            // Si le client n'existe pas, on le créé
            if(!$customer) {
                $customer = new Customer();
                $customer->cus_fullname = $request->fullname;
                $customer->cus_phone = $request->phone;
                $customer->cus_address = is_null($request->address) ? 'Non définie' : $request->address;
                $customer->cus_nb_orders = 1;
                $customer->cus_total_spendings = $total_price + $delivery_fees;

                $customer->save();
            }

            $order = new Order;

            $order->ord_price = $delivery_fees + $total_price;
            $order->ord_date = $request->date;
            $order->ord_type = $request->type;
            $order->ord_time = $request->time;
            $order->cus_id = $customer->cus_id;

            $order->save();

            // Ajout des produits de la commande
            foreach ($cart as $id => $it) {
                $op = new OrderProducts;
                $op->ord_id = $order->ord_id;
                $op->pro_id = $it["id"];
                $op->opr_quantity = $it["quantity"];
                $op->opr_price = $it["price"];

                $op->save();
            }

            DB::commit();
        } catch (\Exception $e) {

            DB::rollBack();
            return redirect(route('order-error'));
        }

        return redirect(route('order-success'));
    }

    public function track(Request $request, $orderId) {
        $order = Order::where('ord_id', $orderId)->first();

        if(!$order)
            abort(404);

        return view('track', ['order' => $order]);
    }
}
