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
            $table->bigInteger('isbn13')->nullable();
            $table->integer('isbn10')->nullable();
            $table->string('publisher')->nullable();
            $table->date('publish_date')->nullable();
            $table->smallInteger('pages')->nullable();
            $table->smallInteger('format')->default(EditionFormat::Hardcover);
            $table->integer('goodreads')->nullable();
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
