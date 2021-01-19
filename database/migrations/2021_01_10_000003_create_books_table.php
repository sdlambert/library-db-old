<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title', 256);
            $table->text('blurb')->nullable();
            $table->boolean('published_under_pseudonym')->default(false);
            $table->bigInteger('author_id');
            $table->bigInteger('edition_id');
            $table->foreign('author_id')->references('id')->on('authors');
            $table->foreign('edition_id')->references('id')->on('editions');
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
        Schema::dropIfExists('books');
    }
}
