<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArtistDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('artist_document', function (Blueprint $table) {
            $table->bigIncrements('artist_doc_id');
            $table->string('artist_doc_name');
            $table->string('artist_doc_path');
            $table->string('artist_doc_issued_date');
            $table->string('artist_doc_expired_date');
            $table->unsignedBigInteger('artist_id');
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by');
            $table->unsignedBigInteger('deleted_by');
            $table->foreign('artist_id')->references('artist_id')->on('artist');
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
        Schema::dropIfExists('artist_document');
    }
}
