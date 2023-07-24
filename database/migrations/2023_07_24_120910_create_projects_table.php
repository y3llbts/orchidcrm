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
      Schema::create('projects', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->text('description');
        $table->string('key');
        $table->integer('price');
        $table->date('start_date');
        $table->date('finish_date');

        $table->unsignedBigInteger('org');
        $table->foreign('org')->references('id')->on('organizations');

        $table->timestamps();
      });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
      Schema::dropIfExists('projects');
    }
  };
