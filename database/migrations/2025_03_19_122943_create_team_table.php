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
        Schema::create('team', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('hackathon_id')->constrained('hackathon');
            $table->foreignId('noter_id')->constrained('juries');
            $table->foreignId('aider_id')->constrained('juries');
            $table->foreignId('project_id')->nullable()->constrained('project');
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
        Schema::dropIfExists('team');
    }
};
