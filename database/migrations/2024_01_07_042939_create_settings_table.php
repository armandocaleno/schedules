<?php

use App\Models\Setting;
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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->unsignedInteger('total_days_month');
            $table->unsignedInteger('total_days_week');
            $table->unsignedInteger('total_days_recess_week');
            $table->enum('recess_days_consecutive', [Setting::CONSECUTIVE_RECESS_DAYS, Setting::NO_CONSECUTIVE_RECESS_DAYS])->defaultValue(Setting::CONSECUTIVE_RECESS_DAYS);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
