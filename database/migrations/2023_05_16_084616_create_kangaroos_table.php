<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('kangaroos', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('nickname')->nullable();
            $table->float('weight');
            $table->float('height');
            $table->enum('gender', ['male', 'female']);
            $table->string('color')->nullable();
            $table->enum('friendliness', ['friendly', 'not friendly']);
            $table->date('birthday');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('kangaroos');
    }
};
