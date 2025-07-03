<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddExtraFieldsToUsersTable extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedSmallInteger('role_id')->after('remember_token');
            $table->unsignedSmallInteger('user_group_id')->after('role_id');
            $table->text('img_main')->nullable()->after('user_group_id');
            $table->boolean('is_enabled')->default(true)->after('img_main');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['role_id', 'user_group_id', 'img_main', 'is_enabled']);
        });
    }
}
