<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Custom templates
        Schema::create('templates', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->unique()->nullable(false);
            $table->string('rotation')->default('square');
            $table->string('preview_url')->nullable();
            $table->string('thumbnail_url')->nullable();
            $table->smallInteger('enabled')->default(1);
            $table->timestamps();
        });

        // Template medias
        Schema::create('template_medias', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('template_id');
            $table->unsignedBigInteger('scene')->nullable(false);
            $table->string('placeholder')->unique()->nullable(false);
            $table->string('type')->default('image');
            $table->string('color')->nullable();
            $table->string('default_value')->nullable();
            $table->string('thumbnail_path')->nullable();
            $table->smallInteger('position')->default(0);
            $table->foreign('template_id')->references('id')->on('custom_templates');
            $table->timestamps();
        });

        // Render jobs
        Schema::create('jobs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('template_id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('uid')->unique();
            $table->string('status')->default('queued');
            $table->string('message')->default(null);
            $table->string('output_name')->default(null);
            $table->string('output_url')->default(null);
            $table->integer('progress')->default(0);
            $table->foreign('template_id')->references('id')->on('custom_templates');
            $table->timestamps();
            $table->timestamp('finished_at')->nullable();
        });

        // Render medias
        Schema::create('job_medias', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('job_id')->unqiue();
            $table->unsignedBigInteger('media_id')->nullable(false);
            $table->string('value')->nullable(false);
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
        Schema::dropIfExists('templates');
        Schema::dropIfExists('template_medias');
        Schema::dropIfExists('jobs');
        Schema::dropIfExists('job_medias');
    }
}
