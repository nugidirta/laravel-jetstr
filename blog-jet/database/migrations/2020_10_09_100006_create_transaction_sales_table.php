<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction_sales', function (Blueprint $table) {
            $table->id();
            $table->string('no_transaction', 45)->unique();
            $table->string('warehouse_code', 45);
            $table->string('warehouse_from_code', 45);
            $table->datetime('date_transaction');
            $table->string('customer_code', 45);
            $table->string('currency_code', 45)->nullable();
            $table->text('description_transaction')->nullable();
            $table->decimal('total_item');
            $table->decimal('sub_total');
            $table->decimal('disc_pr');
            $table->decimal('disc_nom');
            $table->decimal('tax_pr');
            $table->decimal('tax_nom');
            $table->decimal('other_cost');
            $table->decimal('grand_total');
            $table->string('pay_type', 45)->nullable();
            $table->decimal('cash');
            $table->decimal('credit');
            $table->decimal('debit');
            $table->string('user_created', 45)->nullable();
            $table->string('user_updated', 45)->nullable();
            $table->timestamps();

            // Foreign Key Constraints //
            $table->foreign('warehouse_code')->references('code_wh')->on('warehouses')->onDelete('no action')->onUpdate('cascade');
            $table->foreign('warehouse_from_code')->references('code_wh')->on('warehouses')->onDelete('no action')->onUpdate('cascade');
            $table->foreign('customer_code')->references('code_cust')->on('customers')->onDelete('no action')->onUpdate('cascade');

            // Drop FK //
            // $table->dropForeign('items_unit_code_foreign');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('transaction_sales');
    }
}
