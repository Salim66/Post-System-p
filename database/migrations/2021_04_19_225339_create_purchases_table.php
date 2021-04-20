<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('supplier_id');
            $table->unsignedInteger('category_id');
            $table->unsignedInteger('product_id');
            $table->unsignedInteger('purchase_no');
            $table->date('date');
            $table->text('description');
            $table->double('buying_qty');
            $table->double('unit_price');
            $table->double('buying_price');
            $table->boolean('status')->default(false)->comment('0=pending, 1=approved');
            $table->unsignedInteger('created_by')->nullable();
            $table->unsignedInteger('updated_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('purchases');
    }
}
