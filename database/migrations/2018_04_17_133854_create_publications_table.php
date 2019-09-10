<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePublicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('publications', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('type',['post','tutorial']);
            $table->string('imgpublication')->nullable();
            $table->decimal('price', 8,2)->nullable();
            $table->string('title')->required();
            $table->string('slug');
            $table->text('description')->nullable();
            $table->longText('content')->required();
            $table->string('goals')->nullable();
            $table->string('required')->nullable();
            $table->softDeletes();
            $table->timestamps();
            $table->unsignedInteger('category_id');
            $table->unsignedInteger('user_id');
            $table->foreign('category_id')->references('id')->on('categories');
            $table->foreign('user_id')->references('id')->on('users');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
