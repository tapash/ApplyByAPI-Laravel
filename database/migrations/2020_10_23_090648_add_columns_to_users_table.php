<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('company_name')->after('password')->default('');
            $table->string('company_logo')->nullable()->after('company_name')->default('');
            $table->string('company_website')->nullable()->after('company_logo')->default('');
            $table->text('company_description')->nullable()->after('company_website')->default('');
            $table->text('company_address')->nullable()->after('company_description')->default('');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'company_name',
                'company_logo',
                'company_website',
                'company_description',
                'company_address',
            ]);
        });
    }
}
