<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');
            $table->string('category_id')->nullable();
            $table->string('content');
            $table->binary('img_post')->nullable();
               // Transformer binary en longblob pour supporter les url images (laravel ne supporte pas le format longblob en migration): 
                //mysql : ALTER TABLE posts MODIFY img_post longblob;
            $table->rememberToken();
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
        Schema::dropIfExists('posts');
    }
};
