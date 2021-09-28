<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leads', function (Blueprint $table) {
            $table->id();
            $table->string('lead_name')->nullable();
            $table->string('title')->nullable();
            $table->string('mobile');
            $table->string('industry');
            $table->integer('lead_source_id');
            $table->float('revenue');
            $table->string('company');
            $table->string('company_email')->unique();
            $table->integer('lead_status_id');
            $table->integer('number_of_employees');
            $table->integer('skype_id');
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
        Schema::dropIfExists('leads');
    }
}
