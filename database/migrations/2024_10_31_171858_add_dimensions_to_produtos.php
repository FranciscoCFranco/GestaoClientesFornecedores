<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDimensionsToProdutos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('produtos', function (Blueprint $table) {
            $table->decimal('comprimento', 8, 2)->nullable();
            $table->decimal('altura', 8, 2)->nullable();
            $table->decimal('largura', 8, 2)->nullable();
        });
    }

    public function down()
    {
        Schema::table('produtos', function (Blueprint $table) {
            $table->dropColumn(['comprimento', 'altura', 'largura']);
        });
    }
}
