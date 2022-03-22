<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assets', function (Blueprint $table) {
            $table->id();
            $table->string('type', 255)->nullable();
            $table->string('name', 255);
            $table->string('brand', 255)->nullable();
            $table->string('location', 255)->nullable();
            $table->string('condition', 255);
            $table->date('entry_date');
            $table->boolean('active')->default(true);
            $table->boolean('allocated')->default(false);
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
        Schema::dropIfExists('assets');
    }
}