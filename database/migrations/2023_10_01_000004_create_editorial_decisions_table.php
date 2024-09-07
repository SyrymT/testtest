<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEditorialDecisionsTable extends Migration
{
    public function up()
    {
        Schema::create('editorial_decisions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('article_id')->constrained()->onDelete('cascade');
            $table->enum('decision', ['accepted', 'rejected', 'revisions_required']);
            $table->text('comments')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('editorial_decisions');
    }
}