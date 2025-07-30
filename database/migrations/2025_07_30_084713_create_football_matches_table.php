<?php

use App\Models\Team;
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
        Schema::create('football_matches', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Team::class, 'home_team_id');
            $table->foreignIdFor(Team::class, 'away_team_id');
            $table->integer('home_score')->default(0);
            $table->integer('away_score')->default(0);
            $table->enum('status', [
                'scheduled',
                'ongoing',
                'halftime',
                'finished',
            ])->default('finished');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('football_matches');
    }
};
