<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\Console\Descriptor\Descriptor;

class TransactionSale extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'no_transaction', 'warehouse_code', 'warehouse_from_code', 'date_transaction', 'customer_code', 'currency_code',
        'description_transaction', 'total_item', 'sub_total', 'disc_pr', 'disc_nom', 'tax_pr', 'tax_nom', 'other_cost',
        'grand_total', 'pay_type', 'cash', 'credit', 'debit', 'user_created', 'user_updated',
    ];
}
