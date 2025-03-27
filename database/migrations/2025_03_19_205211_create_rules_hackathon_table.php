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
            $table->timestamps();
            $table->foreignId('hackathon_id')->constrained('hackathon');
            $table->foreignId('rule_id')->constrained('rules');
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
