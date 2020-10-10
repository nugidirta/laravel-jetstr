<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionSaleDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction_sale_details', function (Blueprint $table) {
            $table->id();
            $table->integer('line_no');
            $table->string('transaction_no', 45);
            $table->string('item_code', 45);
            $table->decimal('quantity');
            $table->string('unit_code', 45);
            $table->decimal('price');
            $table->decimal('disc_pr');
            $table->decimal('disc_nom');
            $table->decimal('total');
            $table->decimal('tax');
            $table->timestamps();

            // Foreign Key Constraints //
            $table->foreign('item_code')->references('code_item')->on('items')->onDelete('no action')->onUpdate('cascade');
            $table->foreign('transaction_no')->references('no_transaction')->on('transaction_sales')->onDelete('no action')->onUpdate('cascade');
            $table->foreign('unit_code')->references('code_unit')->on('units')->onDelete('no action')->onUpdate('cascade');

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
        Schema::drop('transaction_sale_details');
    }
}
