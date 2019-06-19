<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name',255);
            $table->string('surname',255);
            $table->string('phone',20)->nullable();
            $table->string('gsm',20)->nullable();
            $table->text('address')->nullable();
            $table->string('identity_number')->nullable();
            $table->integer('type');
            $table->string('company_name')->nullable();
            $table->string('tax_number')->nullable();
            $table->string('tax_authority')->nullable();
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
        Schema::dropIfExists('customers');
    }
}
