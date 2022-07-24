<?php

namespace App\Http\Controllers;

use App\Billing\BankPaymentGateway;
use App\Billing\PaymentGatewayContract;
use App\Orders\OrderDetails;
use Illuminate\Http\Request;

class PayOrderController extends Controller
{

    public function store(OrderDetails $orderDetails, PaymentGatewayContract $paymentGateway){
        $orderDetails->all();
        $pay= $paymentGateway->charge('2500');
        dd($pay);

    }
}
