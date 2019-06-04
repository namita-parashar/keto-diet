<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecipesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recipes', function (Blueprint $table) {
            $table->Increments('id');
            $table->string('name');
            $table->string('time');
            // $table->string('image');
            $table->string('video')->nullable();
            // $table->string('steps');
            $table->tinyinteger('type')->comment('1:breakfat,2:brunch,3:lunch,4:dinner');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('recipes');
    }
}
