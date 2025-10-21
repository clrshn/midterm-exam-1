<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
  public function up(): void
{
    Schema::table('sale_items', function (Blueprint $table) {
        $table->decimal('price', 10, 2)->after('quantity');
    });
}

public function down(): void
{
    Schema::table('sale_items', function (Blueprint $table) {
        $table->dropColumn('price');
    });
}

};
