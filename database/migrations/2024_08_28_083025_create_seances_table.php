<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Film;
use App\Models\Salle;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('seances', function (Blueprint $table) {
            $table->id();
            $table->datetime('date_heure');
            $table->bigInteger('prix');
            $table->foreignIdFor(Film::class)->onDelete('cascade');
            $table->foreignIdFor(Salle::class)->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seances');
    }
};
