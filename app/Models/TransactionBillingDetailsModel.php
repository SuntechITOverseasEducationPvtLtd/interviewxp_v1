<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransactionBillingDetailsModel extends Model
{
    protected $table = "transaction_billing_details";

    protected $fillable = [
                            'order_id',
                            'billing_name',
                            'billing_address',
                            'billing_city',
                            'billing_state',
							'billing_zip',
                            'billing_country',
                            'billing_tel',
                            'billing_email',
                            'delivery_name',
                            'delivery_address',
                            'delivery_city',
                            'delivery_state',
                            'delivery_zip',
                            'delivery_country',
                            'delivery_tel',
                           ];

                          
}
