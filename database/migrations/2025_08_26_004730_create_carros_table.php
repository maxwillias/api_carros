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
        Schema::create('cars', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('external_id')->unique(); // "id" do JSON (ex: 125306)

            $table->string('type')->nullable();          // tipo: carro, moto, etc
            $table->string('brand')->nullable();         // marca
            $table->string('model')->nullable();         // modelo
            $table->string('version')->nullable();       // versão

            // year (model/build)
            $table->string('year_model')->nullable();
            $table->string('year_build')->nullable();

            $table->json('optionals')->nullable();       // lista de opcionais
            $table->integer('doors')->nullable();        // número de portas
            $table->string('board')->nullable();         // placa
            $table->string('chassi')->nullable();        // chassi
            $table->string('transmission')->nullable();  // transmissão
            $table->integer('km')->nullable();           // quilometragem
            $table->longText('description')->nullable(); // descrição
            $table->dateTime('created_at_api')->nullable(); // campo created vindo do JSON
            $table->dateTime('updated_at_api')->nullable(); // campo updated vindo do JSON
            $table->boolean('sold')->default(false);     // vendido (0/1)
            $table->string('category')->nullable();      // categoria
            $table->string('url_car')->nullable();       // URL única do carro
            $table->decimal('old_price', 12, 2)->nullable();
            $table->decimal('price', 12, 2)->nullable();
            $table->string('color')->nullable();
            $table->string('fuel')->nullable();
            $table->json('fotos')->nullable();           // lista de fotos

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carros');
    }
};
