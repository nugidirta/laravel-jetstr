<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\Console\Descriptor\Descriptor;

class TransactionSaleDetail extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'line_no', 'transaction_no', 'item_code', 'quantity', 'unit_code', 'price',
        'disc_pr', 'disc_nom', 'total', 'tax',
    ];
}
