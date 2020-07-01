<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyGuestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_guests', function (Blueprint $table) {
            $table->id();
            $table->string('name', 30);
            $table->boolean('is_leader')->default(false);
            $table->string('email', 50);
            $table->string('identity', 8);
            $table->string('identity_id', 30);
            $table->string('identity_file')->nullable();
            $table->string('photo_file')->nullable();
            $table->string('phone_number');
            $table->string('company');
            $table->string('role');
            $table->string('intended_person');
            $table->string('relation', 20);
            $table->text('purpose');
            $table->integer('estimated_time');
            $table->dateTime('checkout')->nullable();
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
        Schema::dropIfExists('company_guests');
    }
}
