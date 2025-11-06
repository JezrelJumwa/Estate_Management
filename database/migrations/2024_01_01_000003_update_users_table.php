<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('id_number', 30)->unique()->after('id');
            $table->string('first_name', 30)->after('id_number');
            $table->string('last_name', 30)->after('first_name');
            $table->string('other_name', 30)->nullable()->after('last_name');
            $table->enum('gender', ['Male', 'Female'])->after('other_name');
            $table->foreignId('status_id')->default(1)->after('gender')->constrained('statuses');
            $table->foreignId('system_role_id')->default(3)->after('status_id')->constrained('system_roles');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['status_id']);
            $table->dropForeign(['system_role_id']);
            $table->dropColumn([
                'id_number', 
                'first_name', 
                'last_name', 
                'other_name', 
                'gender', 
                'status_id', 
                'system_role_id'
            ]);
        });
    }
};
