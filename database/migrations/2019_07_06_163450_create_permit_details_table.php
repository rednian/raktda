<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePermitDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permit_detail', function (Blueprint $table) {
            $table->bigIncrements('permit_detail_id');
            $table->unsignedBigInteger('company_id');
            $table->unsignedBigInteger('permit_id');
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by');
            $table->unsignedBigInteger('deleted_by');
            $table->string('permit_number');
            $table->string('issued_date');
            $table->string('expired_date');
            $table->string('work_location');
            $table->foreign('permit_id')->references('permit_id')->on('permit');
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
        Schema::dropIfExists('permit_detail');
    }
}
