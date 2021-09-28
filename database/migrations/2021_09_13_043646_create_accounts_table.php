<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounts', function (Blueprint $table) {
            $table->id();
            $table->string('account_name')->nullable();
            $table->string('account_site')->nullable();
            $table->integer('account_number');
            $table->integer('account_type_id');
            $table->string('industry');
            $table->float('revenue');
            $table->integer('rating_id');
            $table->string('mobile');
            $table->integer('employees');
            $table->integer('ownership_id');
            $table->string('street');
            $table->string('state');
            $table->string('country');
            $table->string('city');
            $table->integer('zip_code');
            $table->string('description');
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
        Schema::dropIfExists('accounts');
    }
}
