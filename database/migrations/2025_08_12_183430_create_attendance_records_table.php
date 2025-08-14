<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttendanceRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attendance_records', function (Blueprint $table) {
            $table->id();
            $table->string('description');
            $table->bigInteger('employee_id')->unsigned();
            $table->date('upload_date');
            $table->date('att_date');
            $table->string('att_weekday', 20);
            $table->time('check_in_time');
            $table->time('check_out_time');
            $table->string('total_hours');
            $table->enum('location', ['Headquarters', 'Annex-Fafraha'])->default('Headquarters');
            $table->bigInteger('for_sorting')->unsigned();
            $table->bigInteger('created_by')->unsigned();
            $table->bigInteger('updated_by')->unsigned();
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
        Schema::dropIfExists('attendance_records');
    }
}
