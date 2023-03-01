<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPmcDateFieldToTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pmc_modules', function (Blueprint $table) {
            $table->date('pmc_date')->nullable()->after('pmc_trust_val_bal');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pmc_modules', function (Blueprint $table) {
            //
        });
    }
}
