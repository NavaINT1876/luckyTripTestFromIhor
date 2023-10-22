<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('translations', function (Blueprint $table) {
            $table->id()->unsigned();
            $table->unsignedBigInteger('airport_id');

            $table->string('language', 2);
            $table->string('text')->index();

            $table->softDeletes();
            $table->timestamps();

            $table->foreign('airport_id')->references('id')->on('airports')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('translations');
    }
};
