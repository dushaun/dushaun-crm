<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('client_id');
            $table->integer('contact_id')->nullable();
            $table->integer('product_id');
            $table->integer('status');
            $table->date('start');
            $table->integer('duration');
            $table->integer('additional_days')->nullable();
            $table->date('completed')->nullable();
            $table->float('net_value', 8, 2);
            $table->integer('invoice_id')->nullable();
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
        Schema::dropIfExists('jobs');
    }
}
