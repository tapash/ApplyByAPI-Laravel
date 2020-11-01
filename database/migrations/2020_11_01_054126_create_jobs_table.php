<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->string('job_title', 100)->comment('ex. Senior JavaScript Developer');
            $table->boolean('is_remote')->default(0)->comment('0=office job 1=remote');
            $table->string('job_location', 100)->nullable()->comment('12 B Parth Av. Seatle');
            $table->integer('job_type')->default(1)->comment('1=full-time 2=part-time 3=contactual');
            $table->text('job_description');
            $table->string('required_skills', 100)->nullable()->comment('example:laravel php aws');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jobs');
    }
}
