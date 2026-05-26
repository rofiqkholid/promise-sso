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
        if (
            Schema::hasTable('users')
            && Schema::hasColumn('users', 'nik')
            && ! Schema::hasIndex('users', 'users_nik_index')
        ) {
            Schema::table('users', function (Blueprint $table) {
                $table->index('nik');
            });
        }

        if (
            Schema::hasTable('role_menu')
            && Schema::hasColumn('role_menu', 'user_id')
            && Schema::hasColumn('role_menu', 'can_view')
            && ! Schema::hasIndex('role_menu', 'role_menu_user_id_can_view_index')
        ) {
            Schema::table('role_menu', function (Blueprint $table) {
                $table->index(['user_id', 'can_view']);
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('users') && Schema::hasIndex('users', 'users_nik_index')) {
            Schema::table('users', function (Blueprint $table) {
                $table->dropIndex('users_nik_index');
            });
        }

        if (Schema::hasTable('role_menu') && Schema::hasIndex('role_menu', 'role_menu_user_id_can_view_index')) {
            Schema::table('role_menu', function (Blueprint $table) {
                $table->dropIndex('role_menu_user_id_can_view_index');
            });
        }
    }
};
