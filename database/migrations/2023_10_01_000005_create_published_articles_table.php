<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePublishedArticlesTable extends Migration
{
    public function up()
    {
        Schema::create('published_articles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('article_id')->constrained()->onDelete('cascade');
            $table->string('doi')->unique();
            $table->date('published_at');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('published_articles');
    }
}