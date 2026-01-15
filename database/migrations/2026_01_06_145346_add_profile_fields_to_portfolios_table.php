<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('portfolios', function (Blueprint $table) {

            $table->text('skills')->nullable();
            $table->text('education')->nullable();
            $table->text('experience')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('portfolios', function (Blueprint $table) {

            $table->dropColumn([
                'skills',
                'education',
                'experience'
            ]);

           

            $table->dropColumn(['country_id', 'region_id', 'district_id']);
        });
    }
};
