<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('communities', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('parish_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
        Schema::create('communityables', function (Blueprint $table) {
            $table->id();
            $table->foreignId('community_id')->constrained()->onDelete('cascade');
            $table->morphs('communityable');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('communityables');
        Schema::dropIfExists('communities');
    }
};
