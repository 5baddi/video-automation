<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class VideosAutomation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Custom templates
        Schema::create('custom_templates', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('vau_id')->nullable(false);
            $table->string('name')->unique()->nullable(false);
            $table->string('package')->nullable();
            $table->string('version')->nullable();
            $table->string('rotation')->default('square');
            $table->string('preview_path')->nullable();
            $table->timestamps();
        });

        // Template medias
        Schema::create('template_medias', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('template_id');
            $table->string('name')->nullable(false);
            $table->string('type')->default('image');
            $table->string('color')->nullable();
            $table->string('default')->nullable();
            $table->smallInteger('position')->default(0);
            $table->foreign('template_id')->references('id')->on('custom_templates');
            $table->timestamps();
        });

        // Render jobs
        Schema::create('render_jobs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('template_id');
            $table->unsignedBigInteger('job_id');
            $table->string('status')->default('queued');
            $table->string('message')->default(null);
            $table->string('output_url')->default(null);
            $table->integer('progress')->default(0);
            $table->integer('left')->default(0);
            $table->foreign('template_id')->references('id')->on('custom_templates');
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
        Schema::dropIfExists('custom_templates');
        Schema::dropIfExists('template_medias');
        Schema::dropIfExists('render_jobs');
    }
}
