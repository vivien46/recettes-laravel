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

        DB::statement("DO $$ BEGIN
        IF NOT EXISTS (SELECT 1 FROM pg_type WHERE typname = 'role_enum') THEN
            CREATE TYPE role_enum AS ENUM ('user', 'admin');
        END IF;
        END$$;");

        Schema::table('users', function (Blueprint $table) {
            $table->string('role')->after('mot_de_passe')->default('user');
        });
        
        DB::statement("ALTER TABLE users ALTER COLUMN role DROP DEFAULT");
        DB::statement("ALTER TABLE users ALTER COLUMN role TYPE role_enum USING role::role_enum");
        DB::statement("ALTER TABLE users ALTER COLUMN role SET DEFAULT 'user'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("ALTER TABLE users ALTER COLUMN role TYPE VARCHAR(255)");
        DB::statement("DROP TYPE IF EXISTS role_enum");
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('role');
        });

    }
};
