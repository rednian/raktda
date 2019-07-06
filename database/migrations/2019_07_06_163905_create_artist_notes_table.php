<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArtistNotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('artist_note', function (Blueprint $table) {
            $table->bigIncrements('artist_note_id');
            $table->unsignedBigInteger('permit_detail_id');
            $table->unsignedBigInteger('note_id');
            $table->foreign('permit_detail_id')->references('permit_detail_id')->on('permit_detail');
            $table->foreign('note_id')->references('note_id')->on('note');
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
        Schema::dropIfExists('artist_note');
    }
}
