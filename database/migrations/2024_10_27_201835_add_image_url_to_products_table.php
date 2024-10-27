<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('products', function (Blueprint $table) {
        $table->string('image_url')->nullable(); // Agregar la columna image_url
        $table->string('category'); // Agregado para la categoría del producto
    });
}

public function down()
{
    Schema::table('products', function (Blueprint $table) {
        $table->dropColumn('image_url'); // Eliminar la columna image_url si se deshace la migración
        $table->dropColumn(['image_url', 'category']);
    });
}

};
