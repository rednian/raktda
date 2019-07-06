<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArtistPermitDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('artist_permit_document', function (Blueprint $table) {
            $table->bigIncrements('apd_id');
            $table->unsignedBigInteger('artist_doc_id');
            $table->unsignedBigInteger('cd_id');
            $table->unsignedBigInteger('artist_permit_id');
            $table->unsignedBigInteger('apd_status');
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by');
            $table->unsignedBigInteger('deleted_by');
            $table->foreign('artist_doc_id')->references('artist_doc_id')->on('artist_document');
            $table->foreign('artist_permit_id')->references('artist_permit_id')->on('artist_permit');
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
        Schema::dropIfExists('artist_permit_documents');
    }
}
