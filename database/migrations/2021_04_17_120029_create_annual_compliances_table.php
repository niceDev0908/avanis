<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnnualCompliancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('annual_compliances', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id');
            $table->date('dob')->nullable();
            $table->string('occupation')->nullable();
            $table->string('passport_driving_license')->nullable();
            $table->string('company_name')->nullable();
            $table->string('company_address')->nullable();
            $table->string('no_of_directors')->nullable();
            $table->string('no_of_shareholders')->nullable();
            $table->string('no_of_beneficial_owners')->nullable();
            $table->string('client_share_of_business')->nullable();
            $table->string('company_year_end')->nullable();
            $table->string('certificate_of_incorporation')->nullable();
            $table->string('memorandum_and_articles')->nullable();
            $table->string('current_appointments')->nullable();
            $table->string('latest_reports_and_accounts')->nullable();
            $table->string('pmc_name')->nullable();
            $table->string('pmc_address')->nullable();
            $table->string('pmc_bank_name')->nullable();
            $table->string('pmc_account_name')->nullable();
            $table->string('pmc_sort_code')->nullable();
            $table->string('pmc_account_number')->nullable();
            $table->string('pmc_certificate_of_incorporation')->nullable();
            $table->string('pmc_memorandum_and_articles')->nullable();
            $table->string('pmc_current_appointments')->nullable();
            $table->datetime('approved_date')->nullable();
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
        Schema::dropIfExists('annual_compliances');
    }
}
