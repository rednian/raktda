<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArtistPermitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('artist_permit', function (Blueprint $table) {
            $table->bigIncrements('artist_permit_id');
            $table->string('work_location');
            $table->string('person_code');
            $table->string('permit_status');
            $table->unsignedBigInteger('artist_id');
            $table->unsignedBigInteger('permit_detail_id');
            $table->unsignedBigInteger('prof_id');
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by');
            $table->unsignedBigInteger('deleted_by');
            $table->foreign('permit_detail_id')->references('permit_detail_id')->on('permit_detail');
            $table->foreign('artist_id')->references('artist_id')->on('artist');
            $table->foreign('prof_id')->references('prof_id')->on('profession');
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
        Schema::dropIfExists('artist_permits');
    }
}
