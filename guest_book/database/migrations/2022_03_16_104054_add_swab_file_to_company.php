<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSwabFileToCompany extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('company_guests', function (Blueprint $table) {
          $table->string('swab_file')->nullable()->after('photo_file');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('company_guests', function (Blueprint $table) {
          $table->dropColumn('swab_file');
        });
    }
}
