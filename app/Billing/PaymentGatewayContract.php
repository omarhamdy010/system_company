<?php

namespace App\Billing;

interface PaymentGatewayContract
{
    public function GetDiscount($amount);

    public function charge($amount);
}
