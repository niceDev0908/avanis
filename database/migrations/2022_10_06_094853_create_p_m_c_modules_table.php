<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePMCModulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pmc_modules', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id');
            $table->string('pmc_type');
            $table->text('pmc_description');
            $table->float('pmc_asset_in', 11, 2);
            $table->float('pmc_asset_out', 11, 2);
            $table->float('pmc_cash_in', 11, 2);
            $table->float('pmc_cash_out', 11, 2);
            $table->float('pmc_trust_val_bal', 11, 2);
            $table->string('pmc_file_upload');
            $table->softDeletes();
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
        Schema::dropIfExists('pmc_modules');
    }
}
