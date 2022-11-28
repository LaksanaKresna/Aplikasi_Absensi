<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('nik');
            $table->string('name');
            $table->enum('gender', ['L', 'P']);
            $table->foreignId('jobtitle_id');
            $table->foreignId('status_id');
            $table->foreignId('maritalstatus_id');
            $table->string('pin')->nullable();
            $table->string('phone', 20)->nullable();
            $table->timestamps();

            $table->index('nik');
            $table->index('gender');
            $table->index('jobtitle_id');
            $table->index('status_id');
            $table->index('maritalstatus_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employees');
    }
}
