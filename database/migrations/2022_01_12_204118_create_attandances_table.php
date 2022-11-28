<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttandancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attandances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id');
            $table->dateTime('att_in')->nullable();
            $table->dateTime('att_out')->nullable();
            $table->date('att_date');
            $table->string('lat')->nullable();
            $table->string('lng')->nullable();
            $table->float('distance')->nullable();
            $table->foreignId('attandancestatus_id');
            $table->string('notes')->nullable();
            $table->boolean('is_late')->nullable();
            $table->boolean('is_early')->nullable();
            $table->integer('late_time')->nullable();
            $table->integer('early_time')->nullable();
            $table->string('in_notes')->nullable();
            $table->string('out_notes')->nullable();
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
        Schema::dropIfExists('attandances');
    }
}
