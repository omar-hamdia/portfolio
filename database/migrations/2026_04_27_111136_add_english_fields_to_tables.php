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
        Schema::table('projects', function (Blueprint $table) {
            $table->string('title_en')->nullable()->after('title');
            $table->text('description_en')->nullable()->after('description');
        });

        Schema::table('about', function (Blueprint $table) {
            $table->string('title_en')->nullable()->after('title');
            $table->text('content_en')->nullable()->after('content');
        });

        Schema::table('services', function (Blueprint $table) {
            $table->string('title_en')->nullable()->after('title');
            $table->text('description_en')->nullable()->after('description');
        });

        Schema::table('testimonials', function (Blueprint $table) {
            $table->string('name_en')->nullable()->after('name');
            $table->string('role_en')->nullable()->after('role');
            $table->text('message_en')->nullable()->after('message');
        });

        Schema::table('settings', function (Blueprint $table) {
            $table->string('site_name_en')->nullable()->after('site_name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn(['title_en', 'description_en']);
        });

        Schema::table('about', function (Blueprint $table) {
            $table->dropColumn(['title_en', 'content_en']);
        });

        Schema::table('services', function (Blueprint $table) {
            $table->dropColumn(['title_en', 'description_en']);
        });

        Schema::table('testimonials', function (Blueprint $table) {
            $table->dropColumn(['name_en', 'role_en', 'message_en']);
        });

        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn(['site_name_en']);
        });
    }
};
