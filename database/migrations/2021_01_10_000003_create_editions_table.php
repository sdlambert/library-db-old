<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enums\EditionFormat;

class CreateEditionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('editions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('isbn13', 64)->nullable();
            $table->string('isbn10',64)->nullable();
            $table->unsignedInteger('publisher_id');
            $table->unsignedInteger('book_id');
            $table->string('publish_date', 64)->nullable();
            $table->smallInteger('pages')->nullable();
            $table->smallInteger('format')->default(EditionFormat::Hardcover);
            $table->string('goodreads', 64)->nullable();
            $table->string('openlibrary', 64)->nullable();
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
        Schema::dropIfExists('editions');
    }
}
