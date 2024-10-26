<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // Policy Holders table
        Schema::create('policy_holders', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('city');
            $table->timestamps();
        });

        // Policies table
        Schema::create('policies', function (Blueprint $table) {
            $table->id();
            $table->string('policy_no')->unique();
            $table->string('status');
            $table->string('type');
            $table->date('effective_date');
            $table->date('expiration_date');
            $table->foreignId('policy_holder_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('policies');
        Schema::dropIfExists('policy_holders');
    }
};
