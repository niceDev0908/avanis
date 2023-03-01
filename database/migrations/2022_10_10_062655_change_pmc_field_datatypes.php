<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangePmcFieldDatatypes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pmc_modules', function (Blueprint $table) {
            $table->float('pmc_asset_in', 11, 2)->nullable()->change();
            $table->float('pmc_asset_out', 11, 2)->nullable()->change();
            $table->float('pmc_cash_in', 11, 2)->nullable()->change();
            $table->float('pmc_cash_out', 11, 2)->nullable()->change();
            $table->float('pmc_trust_val_bal', 11, 2)->nullable()->change();
            $table->string('pmc_file_upload')->nullable()->change();
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
