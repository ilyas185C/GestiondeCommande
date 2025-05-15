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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');

            // Champs d'adresse
            $table->string('phone')->nullable()->comment('Numéro de téléphone');
            $table->string('address_line1')->nullable()->comment('Adresse ligne 1');
            $table->string('address_line2')->nullable()->comment('Adresse ligne 2 (complément)');
            $table->string('street')->nullable()->comment('Nom de la rue');
            $table->string('city')->nullable()->comment('Ville');
            $table->string('state')->nullable()->comment('État/Région');
            $table->string('zip_code')->nullable()->comment('Code postal');
            $table->string('country')->nullable()->default('France')->comment('Pays');

            // 5 champs supplémentaires utiles
            $table->date('birth_date')->nullable()->comment('Date de naissance');
            $table->string('gender')->nullable()->comment('Genre');
            $table->string('profession')->nullable()->comment('Profession');
            $table->text('notes')->nullable()->comment('Notes supplémentaires');
            $table->boolean('is_active')->default(true)->comment('Compte actif');

            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes(); // Ajout du soft delete
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
