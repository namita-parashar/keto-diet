<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateRecipeIngredientTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('recipe_ingredient', function (Blueprint $table) {
            //
            $table->dropForeign('recipe_ingredient_product_id_foreign');
            $table->dropForeign('recipe_ingredient_recipe_id_foreign');
           $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('recipe_id')->references('id')->on('recipes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('recipe_ingredient', function (Blueprint $table) {
            //
        });
    }
}
