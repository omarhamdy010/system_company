<?php


namespace App\Orders;


use App\Billing\BankPaymentGateway;
use App\Billing\PaymentGatewayContract;

class OrderDetails
{
    private $paymentGateway;

    public function __construct(PaymentGatewayContract $paymentGateway)
    {
        $this->paymentGateway = $paymentGateway;
    }

    public function all(){
        $this->paymentGateway->GetDiscount(500);
        return [
            'name'=>'omar',
            'address'=>'123 coder\'s street',
        ];
    }
}
