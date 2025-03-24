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
        Schema::create('tbl_contacts', function (Blueprint $table) {
            $table->string("email");
            $table->string("fullName");
            $table->string("department");
            $table->string("phoneNumber");
            $table->string("jobTitle");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_contacts');
    }
};
