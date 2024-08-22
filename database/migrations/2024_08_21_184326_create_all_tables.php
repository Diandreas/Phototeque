<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        // Table `roles`
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->timestamps();
        });



        // Table `terms`
        Schema::create('terms', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->timestamps();
        });

        // Table `images`
        Schema::create('images', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->string('path', 45)->nullable();
            $table->string('size', 45)->nullable();
            $table->text('description')->nullable(); // Ajout de la description
            $table->timestamps();
        });

        // Table `comments`
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->string('description', 255);
            $table->unsignedBigInteger('image_id');
            $table->unsignedBigInteger('user_id');
            $table->foreign('image_id')->references('id')->on('images')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });


        // Table `term_has_images`
        Schema::create('term_has_images', function (Blueprint $table) {
            $table->foreignId('term_id')->constrained('terms')->onDelete('no action')->onUpdate('no action');
            $table->foreignId('image_id')->constrained('images')->onDelete('no action')->onUpdate('no action');
            $table->primary(['term_id', 'image_id']);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('term_has_images');
        Schema::dropIfExists('user_has_comments');
        Schema::dropIfExists('comments');
        Schema::dropIfExists('images');
        Schema::dropIfExists('terms');
        Schema::dropIfExists('users');
        Schema::dropIfExists('roles');
    }

};
