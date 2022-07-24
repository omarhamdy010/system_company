<?php


namespace App\Billing;


use Illuminate\Support\Str;

class CredictPaymentGateway implements PaymentGatewayContract
{

    private $currency;
    private $discount;

    public function __construct($currency)
    {
        $this->currency = $currency;
        $this->discount = 0;
    }

    public function GetDiscount($amount)
    {
        $this->discount = $amount;
    }

    public function charge($amount)
    {
        $fees = $amount * .03 ;
        $discount = $this->discount;
        return [
            'name' => ($amount-$discount)+$fees,
            'number_confirmation' => Str::random(),
            'currency' => $this->currency,
            'discount'=>$discount,
            'fees'=>$fees,
        ];
    }

}
