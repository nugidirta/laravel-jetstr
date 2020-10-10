<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('code_item', 45)->unique();
            $table->string('name_item', 200);
            $table->string('brand_code', 45);
            $table->string('type_item', 10);
            $table->string('unit_code', 45);
            $table->string('warehouse_code', 45);
            $table->timestamps();

            // Foreign Key Constraints //
            $table->foreign('unit_code')->references('code_unit')->on('units')->onDelete('no action')->onUpdate('cascade');
            $table->foreign('warehouse_code')->references('code_wh')->on('warehouses')->onDelete('no action')->onUpdate('cascade');
            $table->foreign('brand_code')->references('code_brand')->on('brands')->onDelete('no action')->onUpdate('cascade');

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
        Schema::drop('items');
    }
}
