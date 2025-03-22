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
        Schema::create('rules_hackathon', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('hackathon_id')->constrained('hackathon')->onDelete('cascade');
            $table->foreignId('rule_id')->constrained('rules')->onDelete('cascade');
        });
    }
    

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rules_hackathon');
    }
};
