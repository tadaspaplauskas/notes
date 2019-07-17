<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTagNoteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tag_note', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('note_id');
            $table->bigInteger('tag_id');
            $table->timestamps();
            $table->unique(['note_id', 'tag_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('note_tag');
    }
}
