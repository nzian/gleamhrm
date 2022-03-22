<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateSalaryBankInfoInSalariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('salaries', function (Blueprint $table) {
            // add three column after pf_deduction
            $table->string('bank_name')->after('pf_deduction')->nullable(); // bank_name default length nullable
            $table->string('branch_name')->after('bank_name')->nullable(); // branch_name default length nullable
            $table->string('account_number')->after('branch_name')->nullable(); //account_number default length nullable
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumns('salaries', ['bank_name', 'branch_name', 'account_number'])) {
            Schema::table('salaries', function (Blueprint $table) {
                // if has those column just remove those columns
                $table->dropColumn(['bank_name', 'branch_name', 'account_number']);
            });
        }
    }
}