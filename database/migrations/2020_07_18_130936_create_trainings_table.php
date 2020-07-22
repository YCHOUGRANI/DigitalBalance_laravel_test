<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrainingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {  
        Schema::create('training_types', function (Blueprint $table) {
        $table->bigIncrements('id');
        $table->string('name');
        $table->timestamps();
    });
        Schema::create('trainings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->foreignId('type_id');
            $table->text('description')->nullable();
            $table->string('filename')->nullable();
            $table->string('url')->nullable();
            $table->string('mime_type')->nullable();
            $table->string('original_name')->nullable();
            $table->string('size')->nullable();
            $table->foreign('type_id')->references('id')->on('training_types');
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
        Schema::dropIfExists('trainings');
        Schema::dropIfExists('types');
    }
}
