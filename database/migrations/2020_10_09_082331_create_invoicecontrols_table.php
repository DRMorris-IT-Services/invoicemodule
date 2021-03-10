<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoiceControlsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoicecontrols', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('invoice_admin')->nullable();
            $table->string('invoice_view')->nullable();
            $table->string('invoice_add')->nullable();
            $table->string('invoice_edit')->nullable();
            $table->string('invoice_download')->nullable();
            $table->string('invoice_del')->nullable();
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
        Schema::dropIfExists('invoicecontrols');
    }
}
