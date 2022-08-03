<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('bcategories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->nullOnDelete()->cascadeOnUpdate();
            $table->foreign('parent_id')->references('id')->on('bcategories')->nullOnDelete()->cascadeOnUpdate();
            $table->string('label');
            $table->string('slug');
            $table->timestamps();
        });

        Schema::create('bcategory_blog', function (Blueprint $table){
            $table->unsignedBigInteger('blog_id');
            $table->unsignedBigInteger('bcategory_id');
            $table->foreign('blog_id')->references('id')->on('blogs')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreign('bcategory_id')->references('id')->on('bcategories')->cascadeOnDelete()->cascadeOnUpdate();
            $table->primary(['blog_id', 'bcategory_id']);
        });
    }

    public function down()
    {
        $this->dropOther();
        Schema::dropIfExists('bcategories');
    }

    protected function dropOther(){
        Schema::dropIfExists('bcategory_blog');
    }
};
