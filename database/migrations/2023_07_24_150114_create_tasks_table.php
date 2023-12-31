<?php

  use Illuminate\Database\Migrations\Migration;
  use Illuminate\Database\Schema\Blueprint;
  use Illuminate\Support\Facades\Schema;

  return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
      Schema::create('tasks', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->text('description');

        $table->date('start_date');
        $table->date('finish_date');

        $table->unsignedBigInteger('project');
        $table->foreign('project')->references('id')->on('projects');

        $table->unsignedBigInteger('status');
        $table->foreign('status')->references('id')->on('tasks_status');

        $table->timestamps();
      });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
      Schema::dropIfExists('tasks');
    }
  };
