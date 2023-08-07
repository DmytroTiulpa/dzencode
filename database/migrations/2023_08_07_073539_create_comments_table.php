<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->integer('parent_id')->nullable();
            $table->string('user_name');
            $table->string('email');
            $table->string('home_page')->nullable();
            $table->string('comment');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        /*Schema::table('comments', function (Blueprint $table) {
            //
        });*/
        Schema::dropIfExists('comments');
    }
};
