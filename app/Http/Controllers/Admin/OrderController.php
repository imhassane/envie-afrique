<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Twilio\Rest\Client;

class OrderController extends Controller
{
    public function index(Request $request) {
        $state = $request->query('state');
        if(!$state) $state = 'all';

        $this->sendMessage();

        $PAGE_SIZE = 30;
        $orders = null;
        switch($state) {
            case "all":
                $orders =
                    Order::orderBy('ord_date')
                        ->orderBy('ord_time')
                        ->paginate($PAGE_SIZE);

                $nb_vae = Order::where('ord_type', 'VAE')->count();
                $nb_liv = Order::where('ord_type', 'LSP')->count();
                break;

            default:
                $orders =
                    Order::where('ord_status', strtoupper($state))
                        ->orderBy('ord_date')
                        ->orderBy('ord_time')
                        ->paginate($PAGE_SIZE);

                $nb_vae = Order::where('ord_status', strtoupper($state))->where('ord_type', 'VAE')->count();
                $nb_liv = Order::where('ord_status', strtoupper($state))->where('ord_type', 'LSP')->count();
                break;
        }
        return view('admin.order.index', [
            'orders' => $orders,
            'nb_vae' => $nb_vae,
            'nb_liv' => $nb_liv,
            'state' => $state,
        ]);
    }

    public function startPreparation(Request $request) {
        $this->updateOrderStatus($request->ord_id, 'PREPARATION');
        return back();
    }

    public function endPreparation(Request $request) {
        $this->updateOrderStatus($request->ord_id, 'READY');
        return back();
    }

    public function startDelivery(Request $request) {
        $this->updateOrderStatus($request->ord_id, 'DELIVERY');
        return back();
    }

    public function endDelivery(Request $request) {
        $this->updateOrderStatus($request->ord_id, 'DELIVERED');
        return back();
    }

    public function rollStatusBack(Request $request) {
        $order = Order::where('ord_id', $request->ord_id)->first();

        $status = null;
        switch ($order->ord_status) {
            case "PREPARATION":
                $status = "SAVED";
                $order->ord_preparation_date = null;
                break;
            case "READY":
                $status = "PREPARATION";
                $order->ord_ready_date = null;
                break;
            case "DELIVERY":
                $status = "READY";
                $order->ord_delivery_date = null;
                break;
            case "DELIVERED":
                $status = "DELIVERY";
                $order->ord_done_date = null;
                break;
        }

        $order->ord_status = $status;
        $order->save();

        return back();
    }

    private function updateOrderStatus($orderId, $status) {
        $order = Order::where('ord_id', $orderId)->first();
        $order->ord_status = $status;

        switch($status) {
            case 'PREPARATION':
                $order->ord_preparation_date = now();
                break;
            case 'READY':
                $order->ord_ready_date = now();
                break;
            case 'DELIVERY':
                $order->ord_delivery_date = now();
                break;
            case 'DELIVERED':
                $order->ord_done_date = now();
        }

        $order->save();
    }

    private function sendMessage() {
        $account_id = env('TWILIO_ACCOUNT_ID');
        $token = env('TWILIO_ACCESS_TOKEN');
        $phone = env('TWILIO_PHONE_NUMBER');

        try {
            $client = new Client($account_id, $token);

            $client->messages->create(
                '+33616552934',
                array(
                    'from' => $phone,
                    'message' => "Message envoyé depuis le test"
                )
            );
        } catch (\Exception $e) {
            dd($e);
        }

    }

}
