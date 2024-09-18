<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('recipes', function (Blueprint $table) {

            DB::statement("DO $$ BEGIN
            IF NOT EXISTS (SELECT 1 FROM pg_type WHERE typname = 'difficulte_enum') THEN 
                    CREATE TYPE difficulte_enum AS ENUM ('facile', 'moyenne', 'difficile');
                END IF;
            END $$;");

            DB::statement("DO $$ BEGIN
            IF NOT EXISTS (SELECT 1 FROM pg_type WHERE typname = 'type_enum') THEN
                CREATE TYPE type_enum AS ENUM('entree', 'plat', 'dessert', 'boisson', 'autre');
            END IF;
        END $$;");
            
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('titre');
            $table->text('description')->nullable();
            $table->integer('temps_preparation')->nullable();
            $table->integer('temps_cuisson')->nullable();
            $table->integer('temps_repos')->nullable();
            $table->integer('temps_total')->nullable();
            $table->integer('portion')->nullable();
            $table->string('difficulte')->default('facile');
            $table->string('type')->default('plat');
            $table->timestamps();
        });

        DB::statement("ALTER TABLE recipes ALTER COLUMN difficulte DROP DEFAULT");
        DB::statement("ALTER TABLE recipes ALTER COLUMN type DROP DEFAULT");

        DB::statement('ALTER TABLE recipes ALTER COLUMN difficulte TYPE difficulte_enum USING (difficulte::difficulte_enum)');
        DB::statement('ALTER TABLE recipes ALTER COLUMN type TYPE type_enum USING (type::type_enum)');

        DB::statement("ALTER TABLE recipes ALTER COLUMN difficulte SET DEFAULT 'facile'");
        DB::statement("ALTER TABLE recipes ALTER COLUMN type SET DEFAULT 'plat'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recipes');
        DB::statement('DROP TYPE IF EXISTS difficulte_enum');
        DB::statement('DROP TYPE IF EXISTS type_enum');
    }
};
