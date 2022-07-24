<?php


namespace App\Billing;


use Illuminate\Support\Str;

class BankPaymentGateway implements PaymentGatewayContract
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
        $discount = $this->discount;
        return [
            'name' => $amount-$discount,
            'number_confirmation' => Str::random(),
            'currency' => $this->currency,
            'discount'=>$discount,
        ];
    }

}
